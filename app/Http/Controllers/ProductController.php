<?php
namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use App\User;
use File;
use Storage;
use Config;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

use App\Product;
use App\ProductCategory;
use App\ProductPhoto;
use App\ProductRating;
use App\ProductReview;

class ProductController extends Controller
{

    public function __construct()
    {
        //$this->middleware('jwt.auth');
    }

    public function count(){
        $product= Product::get();
        return response()->json($product->count());
    }

    public function getProducts($offset,$limit){
        $product= Product::with('category')->with('photos')->with('reviews')->with('ratings')->orderBy('id')->get();
        return response()->json($product);
    }

    public function getProductById($id){
        $product=Product::findOrFail($id);
        $photos=ProductPhoto::where('product_id',$id)->get();
         $reviews=ProductReview::notReply()->with('user')->where('product_id',$id)->get();
            foreach ($reviews as $review) {
                $review->loadChild();
            }
         $rating=$product->rating();
        return response()->json(['product' => $product, 'photos' => $photos ,'reviews' => $reviews, 'rating' => $rating]);
    }

    public function create(Request $request){
        $input = $request->all();
        $validator = Validator::make($input, [
            'product_name' => 'bail|required|unique:product',
            'indian_name' => 'required',
            'description' => 'required',
            'unit' => 'required',
            'price' => 'required|numeric',
            'market_price' => 'required|numeric',
            'bulk_quantity' => 'required|numeric',
            'bulk_discount' => 'required|min:0|max:100|numeric',
            'product_category_id' => 'required'
        ]);
        $product= Product::create($input);
        return response()->json(['success' => true, 'message' => 'Product created successfully.', 'id' => $product.id]);
    }
    public function update($id,Request $request){

        $input = $request->all();
        $validator = Validator::make($input, [
            'product_name' => 'bail|required|unique:products,product_name',
            'indian_name' => 'required',
            'description' => 'required',
            'unit' => 'required',
            'price' => 'required|numeric',
            'market_price' => 'required|numeric',
            'bulk_quantity' => 'required|numeric',
            'bulk_discount' => 'required|min:0|max:100|numeric',
            'product_category_id' => 'required'            
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->messages()], 400);
        }


        Product::where("id",$id)->update($input);
        $product = Product::find($id);
        return response()->json(['success' => true, 'message' => 'Product updated successfully.']);

    }

    public function delete($id){
        $delete= Product::destroy($id);
        return response()->json(['success' => true, 'message' => 'Product deleted successfully.']);

    }

    public function reviews($id){
       $reviews= ProductReview::with('children', 'parent')->get();
        return response()->json($reviews);
    }

    public function uploadImage($id,Request $request){

        $file = Input::file('product_image');
        $random_name = $id .'_'. str_random(8);
        $destinationPath =  storage_path().'/app/public/products/'. $id;
        $extension = $file->getClientOriginalExtension();
        $filename=$random_name.'.'.$extension;

        if(!Storage::disk('image')->has( 'products/'.$id .'/'.$filename)){
           $status= Storage::disk('image')->put( 'products/'.$id .'/'.$filename, File::get($file ));
           if($status);{
                $product=Product::findOrFail($id);
                $photos = $product->photos()->create(array(
                    'image' => $filename,
                    'product_id' => $product->id
                ));

            }
        }

        /*$photos= new ProductPhoto();
        $photos->id =3;
        $photos->image ='1_2DgGbYxd.jpg';
        $photos->product_id = $id;*/

        return response()->json(['success' => true,'photo'=>$photos, 'message' => 'Product image uploaded successfully.']);

    }

    public function removeImage($product_id, $imageId){

        $photo= ProductPhoto::findOrFail($imageId);
        $status=[];
        if(Storage::disk('image')->has( 'products/'.$product_id .'/'.$photo->image )) {
            Storage::disk('image')->delete('products/'.$product_id .'/'.$photo->image );
            $status=['success' => true, 'message' => 'Product image deleted successfully.'];
            $photo->delete();
        }
        else
        {
            $status=['success' => true, 'message' => 'Product image does not exist.'];
        }

        return response()->json($status);
    }



    public function storeReviewForProduct($id,Request $request)
    {
        $review = $request->all();
        $product = Product::find($id);
        /*$user= User::find($review->user);
        $reply=new ProductReview();
        $reply->product=$product;
        //$this->user_id = Auth::user()->id;
        //$this->comment = $comment;
        //$this->rating = $rating;
        //$product->reviews()->save($review);*/

        $photos = $product->reviews()->create($review);
        return response()->json(['success' => true, 'message' => 'Reply updated successfully.']);

    }
}


//$product = new Product($request->all());
//$data = $request->all();
/*if(Request::ajax()){

}*/
/*$product = new Product();
$product->product_name =  $request->get('product_name');
$product->indian_name=  $request->get('indian_name');
$product->description=  $request->get('description');
$product->price=  $request->get('price');
$product->unit=  $request->get('unit');
$product->market_price=  $request->get('market_price');
$product->bulk_quantity=  $request->get('bulk_quantity');
$product->bulk_discount=  $request->get('bulk_discount');
$product->roasted=  $request->get('roasted');
$product->grinded=  $request->get('grinded');*/

// $product->save();

//$product=Product::findOrFail($id);
//$product=Product::findOrFail($id)->category;
//$product = "{ 'rating' :" . Product::findOrFail($id)->rating() ."}";
//$product = "{ 'review' :" . Product::findOrFail($id)->reviewCount() ."}";

//$product= ProductCategory::get();
//$product= ProductCategory::with('products')->get();
//$product= ProductCategory::find($id);
//$product= ProductCategory::find($id)->products;



//$product = ProductPhoto::get();
//$product = ProductPhoto::findOrFail($id)->product;

//$product = ProductRating::get();
//$product = ProductRating::find($id)->user;
//$product = ProductRating::find($id)->product;
//$product = ProductRating::find($id)->ratings;
//$product = ProductReview::get();
//$product = ProductReview::find($id)->user;
//$product = ProductReview::find($id)->product;