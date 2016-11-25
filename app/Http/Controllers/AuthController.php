<?php namespace App\Http\Controllers;

use Hash;
use Config;
use Validator;
use Firebase\JWT\JWT;
use Illuminate\Http\Request;
use GuzzleHttp;
use GuzzleHttp\Subscriber\Oauth\Oauth1;
use App\User;

class AuthController extends Controller
{

    /**
     * Generate JSON Web Token.
     */
    protected function createToken($user)
    {
        $payload = [
            'sub' => $user->id,
            'iat' => time(),
            'exp' => time() + (2 * 7 * 24 * 60 * 60)
        ];
        return JWT::encode($payload, Config::get('app.token_secret'));
    }


    /**
     * Unlink provider.
     */
    public function unlink(Request $request, $provider)
    {
        $user = User::find($request['user']['sub']);

        if (!$user) {
            return response()->json(['message' => 'User not found']);
        }

        $user->$provider = '';
        $user->save();

        return response()->json(array('token' => $this->createToken($user)));
    }

    /**
     * Log in with Email and Password.
     */
    public function login(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');

        $user = User::where('email', '=', $email)->first();

        if (!$user) {
            return response()->json(['message' => 'Wrong email and/or password'], 401);
        }

        if (Hash::check($password, $user->password)) {
            unset($user->password);


            $token = $this->createToken($user);
            return response()->json(array('user' => $user, 'token' => $token));
        } else {
            return response()->json(['message' => 'Wrong email and/or password'], 401);
        }
    }

    /**
     * Create Email and Password Account.
     */
    public function signup(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'email' => 'required|email|unique:users,email',
            'mobile' => 'required|min:11|numeric|unique:users',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->messages()], 400);
        }

        $user = new User();
        $user->username = $request->input('username');
        $user->email = $request->input('email');
        $user->mobile = $request->input('mobile');
        $user->password = Hash::make($request->input('password'));
        $user->save();


        $token = $this->createToken($user);
        return response()->json(array('user' => $user, 'token' => $token));

    }

    /**
     * Login with Facebook.
     */
    public function facebook(Request $request)
    {
        $client = new GuzzleHttp\Client();

        $params = [
            'code' => $request->input('code'),
            'client_id' => $request->input('clientId'),
            'redirect_uri' => $request->input('redirectUri'),
            'client_secret' => Config::get('app.facebook_secret')
        ];

        // Step 1. Exchange authorization code for access token.
        $accessTokenResponse = $client->request('GET', 'https://graph.facebook.com/v2.5/oauth/access_token', [
            'query' => $params
        ]);
        $accessToken = json_decode($accessTokenResponse->getBody(), true);

        // Step 2. Retrieve profile information about the current user.
        $fields = 'id,email,first_name,last_name,birthday,link,gender,verified';
        $profileResponse = $client->request('GET', 'https://graph.facebook.com/v2.5/me', [
            'query' => [
                'access_token' => $accessToken['access_token'],
                'fields' => $fields
            ]
        ]);
        $profile = json_decode($profileResponse->getBody(), true);

        // Step 3a. If user is already signed in then link accounts.
        if ($request->header('Authorization')) {
            //$user = User::where('provider_id', '=', $profile['id']);
            $user = User::providerId($profile['id'])->provider('facebook');
            if ($user->first()) {
                return response()->json(['message' => 'There is already a Facebook account that belongs to you'], 409);
            }

            $token = explode(' ', $request->header('Authorization'))[1];
            $payload = (array)JWT::decode($token, Config::get('app.token_secret'), array('HS256'));

            $user = User::find($payload['sub']);
            $user->provider_id = $profile['id'];
            $user->provider = 'facebook';
            $user->email = $user->email ?: $profile['email'];
            $user->displayName = $user->displayName ?: $profile['name'];
            $user->save();

            $token = $this->createToken($user);
            return response()->json(array('user' => $user, 'token' => $token));
        } // Step 3b. Create a new user account or return an existing one.
        else {
            $user = User::providerId($profile['id'])->provider('facebook');

            if ($user->first()) {
                //return response()->json(['token' => $this->createToken($user->first())]);

                $token = $this->createToken($user->first());
                return response()->json(array('user' => $user->first(), 'token' => $token));
            }

            $user = new User;
            $user->provider_id = $profile['id'];
            $user->provider = 'facebook';
            $user->email = $profile['email'];
            $user->username = $profile['name'];
            $user->save();

            $token = $this->createToken($user);
            return response()->json(array('user' => $user, 'token' => $token));
        }
    }

    /**
     * Login with Google.
     */
    public function google(Request $request)
    {
        $client = new GuzzleHttp\Client();

        $params = [
            'code' => $request->input('code'),
            'client_id' => $request->input('clientId'),
            'client_secret' => Config::get('app.google_secret'),
            'redirect_uri' => $request->input('redirectUri'),
            'grant_type' => 'authorization_code',
        ];

        // Step 1. Exchange authorization code for access token.
        $accessTokenResponse = $client->request('POST', 'https://accounts.google.com/o/oauth2/token', [
            'form_params' => $params
        ]);
        $accessToken = json_decode($accessTokenResponse->getBody(), true);

        // Step 2. Retrieve profile information about the current user.
        $profileResponse = $client->request('GET', 'https://www.googleapis.com/plus/v1/people/me/openIdConnect', [
            'headers' => array('Authorization' => 'Bearer ' . $accessToken['access_token'])
        ]);
        $profile = json_decode($profileResponse->getBody(), true);

        // Step 3a. If user is already signed in then link accounts.
        if ($request->header('Authorization')) {
            $user = User::where('google', '=', $profile['sub']);

            if ($user->first()) {
                return response()->json(['message' => 'There is already a Google account that belongs to you'], 409);
            }

            $token = explode(' ', $request->header('Authorization'))[1];
            $payload = (array)JWT::decode($token, Config::get('app.token_secret'), array('HS256'));

            $user = User::find($payload['sub']);
            $user->google = $profile['sub'];
            $user->displayName = $user->displayName ?: $profile['name'];
            $user->save();

            $token = $this->createToken($user);
            return response()->json(array('user' => $user, 'token' => $token));
        } // Step 3b. Create a new user account or return an existing one.
        else {
            $user = User::where('google', '=', $profile['sub']);

            if ($user->first()) {
                return response()->json(['token' => $this->createToken($user->first())]);
            }

            $user = new User;
            $user->google = $profile['sub'];
            $user->displayName = $profile['name'];
            $user->picture = $profile['picture'];
            $user->email = $profile['email'];
            $user->save();

            $token = $this->createToken($user);
            return response()->json(array('user' => $user, 'token' => $token));
        }
    }

    /**
     * Login with LinkedIn.
     */
    public function linkedin(Request $request)
    {
        $client = new GuzzleHttp\Client();

        $params = [
            'code' => $request->input('code'),
            'client_id' => $request->input('clientId'),
            'client_secret' => Config::get('app.linkedin_secret'),
            'redirect_uri' => $request->input('redirectUri'),
            'grant_type' => 'authorization_code',
        ];

        // Step 1. Exchange authorization code for access token.
        $accessTokenResponse = $client->request('POST', 'https://www.linkedin.com/uas/oauth2/accessToken', [
            'form_params' => $params
        ]);
        $accessToken = json_decode($accessTokenResponse->getBody(), true);

        // Step 2. Retrieve profile information about the current user.
        $profileResponse = $client->request('GET', 'https://api.linkedin.com/v1/people/~:(id,first-name,last-name,email-address)', [
            'query' => [
                'oauth2_access_token' => $accessToken['access_token'],
                'format' => 'json'
            ]
        ]);
        $profile = json_decode($profileResponse->getBody(), true);

        // Step 3a. If user is already signed in then link accounts.
        if ($request->header('Authorization')) {
            $user = User::where('linkedin', '=', $profile['id']);

            if ($user->first()) {
                return response()->json(['message' => 'There is already a LinkedIn account that belongs to you'], 409);
            }

            $token = explode(' ', $request->header('Authorization'))[1];
            $payload = (array)JWT::decode($token, Config::get('app.token_secret'), array('HS256'));

            $user = User::find($payload['sub']);
            $user->linkedin = $profile['id'];
            $user->displayName = $user->displayName ?: $profile['firstName'] . ' ' . $profile['lastName'];
            $user->save();

            $token = $this->createToken($user);
            return response()->json(array('user' => $user, 'token' => $token));
        } // Step 3b. Create a new user account or return an existing one.
        else {
            $user = User::where('linkedin', '=', $profile['id']);

            if ($user->first()) {
                return response()->json(['token' => $this->createToken($user->first())]);
            }

            $user = new User;
            $user->linkedin = $profile['id'];
            $user->displayName = $profile['firstName'] . ' ' . $profile['lastName'];
            $user->save();

            $token = $this->createToken($user);
            return response()->json(array('user' => $user, 'token' => $token));
        }
    }

    /**
     * Login with Twitter.
     */
    public function twitter(Request $request)
    {
        $stack = GuzzleHttp\HandlerStack::create();

        // Part 1 of 2: Initial request from Satellizer.
        if (!$request->input('oauth_token') || !$request->input('oauth_verifier')) {
            $stack = GuzzleHttp\HandlerStack::create();

            $requestTokenOauth = new Oauth1([
                'consumer_key' => Config::get('app.twitter_key'),
                'consumer_secret' => Config::get('app.twitter_secret'),
                'callback' => $request->input('redirectUri'),
                'token' => '',
                'token_secret' => ''
            ]);
            $stack->push($requestTokenOauth);

            $client = new GuzzleHttp\Client([
                'handler' => $stack
            ]);

            // Step 1. Obtain request token for the authorization popup.
            $requestTokenResponse = $client->request('POST', 'https://api.twitter.com/oauth/request_token', [
                'auth' => 'oauth'
            ]);

            $oauthToken = array();
            parse_str($requestTokenResponse->getBody(), $oauthToken);

            // Step 2. Send OAuth token back to open the authorization screen.
            return response()->json($oauthToken);

        } // Part 2 of 2: Second request after Authorize app is clicked.
        else {
            $accessTokenOauth = new Oauth1([
                'consumer_key' => Config::get('app.twitter_key'),
                'consumer_secret' => Config::get('app.twitter_secret'),
                'token' => $request->input('oauth_token'),
                'verifier' => $request->input('oauth_verifier'),
                'token_secret' => ''
            ]);
            $stack->push($accessTokenOauth);

            $client = new GuzzleHttp\Client([
                'handler' => $stack
            ]);

            // Step 3. Exchange oauth token and oauth verifier for access token.
            $accessTokenResponse = $client->request('POST', 'https://api.twitter.com/oauth/access_token', [
                'auth' => 'oauth'
            ]);

            $accessToken = array();
            parse_str($accessTokenResponse->getBody(), $accessToken);

            $profileOauth = new Oauth1([
                'consumer_key' => Config::get('app.twitter_key'),
                'consumer_secret' => Config::get('app.twitter_secret'),
                'oauth_token' => $accessToken['oauth_token'],
                'token_secret' => ''
            ]);
            $stack->push($profileOauth);

            $client = new GuzzleHttp\Client([
                'handler' => $stack
            ]);

            // Step 4. Retrieve profile information about the current user.
            $profileResponse = $client->request('GET', 'https://api.twitter.com/1.1/users/show.json?screen_name=' . $accessToken['screen_name'], [
                'auth' => 'oauth'
            ]);
            $profile = json_decode($profileResponse->getBody(), true);

            // Step 5a. Link user accounts.
            if ($request->header('Authorization')) {
                $user = User::where('twitter', '=', $profile['id']);
                if ($user->first()) {
                    return response()->json(['message' => 'There is already a Twitter account that belongs to you'], 409);
                }

                $token = explode(' ', $request->header('Authorization'))[1];
                $payload = (array)JWT::decode($token, Config::get('app.token_secret'), array('HS256'));

                $user = User::find($payload['sub']);
                $user->twitter = $profile['id'];
                $user->displayName = $user->displayName ?: $profile['screen_name'];
                $user->save();

                return response()->json(['token' => $this->createToken($user)]);
            } // Step 5b. Create a new user account or return an existing one.
            else {
                $user = User::where('twitter', '=', $profile['id']);

                if ($user->first()) {
                    return response()->json(['token' => $this->createToken($user->first())]);
                }

                $user = new User;
                $user->twitter = $profile['id'];
                $user->displayName = $profile['screen_name'];
                $user->save();

                return response()->json(['token' => $this->createToken($user)]);
            }
        }
    }


    /**
     * Login with Instagram.
     */
    public function instagram(Request $request)
    {
        $client = new GuzzleHttp\Client();

        $params = [
            'code' => $request->input('code'),
            'client_id' => $request->input('clientId'),
            'client_secret' => Config::get('app.instagram_secret'),
            'redirect_uri' => $request->input('redirectUri'),
            'grant_type' => 'authorization_code',
        ];

        // Step 1. Exchange authorization code for access token.
        $accessTokenResponse = $client->request('POST', 'https://api.instagram.com/oauth/access_token', [
            'body' => $params
        ]);
        $accessToken = json_decode($accessTokenResponse->getBody(), true);

        // Step 2a. If user is already signed in then link accounts.
        if ($request->header('Authorization')) {
            $user = User::where('instagram', '=', $accessToken['user']['id']);
            if ($user->first()) {
                return response()->json(array('message' => 'There is already an Instagram account that belongs to you'), 409);
            }

            $token = explode(' ', $request->header('Authorization'))[1];
            $payload = (array)JWT::decode($token, Config::get('app.token_secret'), array('HS256'));

            $user = User::find($payload['sub']);
            $user->instagram = $accessToken['user']['id'];
            $user->displayName = $user->displayName ?: $accessToken['user']['username'];
            $user->save();

            return response()->json(['token' => $this->createToken($user)]);
        } // Step 2b. Create a new user account or return an existing one.
        else {
            $user = User::where('instagram', '=', $accessToken['user']['id']);

            if ($user->first()) {
                return response()->json(['token' => $this->createToken($user->first())]);
            }

            $user = new User;
            $user->instagram = $accessToken['user']['id'];
            $user->displayName = $accessToken['user']['username'];
            $user->save();

            return response()->json(['token' => $this->createToken($user)]);
        }
    }

}
