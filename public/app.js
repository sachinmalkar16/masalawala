(function () {

    'use strict';
    angular.module('MyApp', [
        'angularUtils.directives.dirPagination',
        'ngCookies',
        'ngResource',
        'ngMessages',
        'ngAnimate',
        'toastr',
        'ui.router',
        'satellizer',
        'mgcrea.ngStrap',
        'angularMoment',
        'ngFileUpload',
        'angular.filter'])
        .config(function ($httpProvider, $stateProvider, $urlRouterProvider, $authProvider) {

            //for cors
            $httpProvider.defaults.useXDomain = true;
            delete $httpProvider.defaults.headers.common['X-Requested-With'];
            //end

            /**
             * Helper auth functions
             */
            var skipIfLoggedIn = function ($q, $auth) {
                var deferred = $q.defer();
                if ($auth.isAuthenticated()) {
                    deferred.reject();
                } else {
                    deferred.resolve();
                }
                return deferred.promise;
            };

            var loginRequired = function ($q, $location, $auth) {
                var deferred = $q.defer();
                if ($auth.isAuthenticated()) {
                    deferred.resolve();
                } else {
                    $location.path('/login');
                }
                return deferred.promise;
            };

            /**
             * App routes
             */
            $stateProvider
                .state('home', {
                    url: '/',
                    controller: 'HomeController',
                    controllerAs: 'vm',
                    templateUrl: 'modules/home/home.html'
                })
                .state('login', {
                    url: '/login',
                    templateUrl: 'modules/account/login.html',
                    controller: 'LoginController',
                    controllerAs: 'vm',
                    resolve: {
                        skipIfLoggedIn: skipIfLoggedIn
                    }
                })
                .state('signup', {
                    url: '/signup',
                    templateUrl: 'modules/account/signup.html',
                    controller: 'SignupController',
                    controllerAs: 'vm',
                    resolve: {
                        skipIfLoggedIn: skipIfLoggedIn
                    }
                })
                .state('forgot', {
                    url: '/forgot',
                    templateUrl: 'modules/account/forgot.html',
                    controller: 'LoginController',
                    controllerAs: 'vm',
                    resolve: {
                        skipIfLoggedIn: skipIfLoggedIn
                    }
                })
                .state('search', {
                    url: '/products/search',
                    templateUrl: 'modules/search/filter.html',
                    controller: 'SearchController',
                    controllerAs: 'vm'
                })
                .state('search.list', {
                    url: '/list',
                    templateUrl: 'modules/search/list.html',
                    controller: 'SearchController',
                    controllerAs: 'vm'
                })
                .state('search.grid', {
                    url: '/grid',
                    templateUrl: 'modules/search/grid.html',
                    controller: 'SearchController',
                    controllerAs: 'vm'
                })
                .state('search.detail', {
                    url: '/detail',
                    templateUrl: 'modules/search/detail.html',
                    controller: 'SearchController',
                    controllerAs: 'vm',
                    resolve: {
                        skipIfLoggedIn: skipIfLoggedIn
                    }
                })
                .state('settings', {
                    url: '/setting',
                    templateUrl: 'modules/profile/settings.html',
                    controller: 'ProfileController',
                    controllerAs: 'vm',
                    resolve: {
                        loginRequired: loginRequired
                    }
                })
                .state('settings.profile', {
                    url: '/profile',
                    templateUrl: 'modules/profile/profile.html',
                    controller: 'ProfileController',
                    controllerAs: 'vm',
                    resolve: {
                        loginRequired: loginRequired
                    }
                }).state('products-list', {
                url: '/products-list',
                templateUrl: 'modules/products/products-list.html',
                controller: 'ProductsController',
                controllerAs: 'vm'
                })
                .state('products-edit', {
                    url: '/products-edit?pId',
                    templateUrl: 'modules/products/products-edit.html',
                    controller: 'ProductsEditController',
                    controllerAs: 'vm',
                    resolve: {
                        loginRequired: loginRequired
                    }
                });
            $urlRouterProvider.otherwise('/');

            /**
             *  Satellizer config
             */
            $authProvider.facebook({
                clientId: '319937498027323'
            });

            $authProvider.google({
                clientId: 'AIzaSyCNGGq4mix4kQZ3gYS5PkaovDTFmAwvAe4'
            });

            /*$authProvider.github({
             clientId: 'YOUR_GITHUB_CLIENT_ID'
             });

             $authProvider.linkedin({
             clientId: 'YOUR_LINKEDIN_CLIENT_ID'
             });

             $authProvider.instagram({
             clientId: 'YOUR_INSTAGRAM_CLIENT_ID'
             });

             $authProvider.yahoo({
             clientId: 'YOUR_YAHOO_CLIENT_ID'
             });

             $authProvider.live({
             clientId: 'YOUR_MICROSOFT_CLIENT_ID'
             });

             $authProvider.twitch({
             clientId: 'YOUR_TWITCH_CLIENT_ID'
             });

             $authProvider.bitbucket({
             clientId: 'YOUR_BITBUCKET_CLIENT_ID'
             });

             $authProvider.spotify({
             clientId: 'YOUR_SPOTIFY_CLIENT_ID'
             });

             $authProvider.twitter({
             url: '/auth/twitter'
             });

             $authProvider.oauth2({
             name: 'foursquare',
             url: '/auth/foursquare',
             clientId: 'MTCEJ3NGW2PNNB31WOSBFDSAD4MTHYVAZ1UKIULXZ2CVFC2K',
             redirectUri: window.location.origin || window.location.protocol + '//' + window.location.host,
             authorizationEndpoint: 'https://foursquare.com/oauth2/authenticate'
             });*/
        }).run(['$rootScope', "Utils", '$state', '$stateParams', '$cookieStore',
        function ($rootScope, Utils, $state, $stateParams, $cookieStore) {
            $rootScope.$on('$stateChangeSuccess', function (event, toState, toStateParams) {
                $rootScope.toState = toState;
                $rootScope.toStateParams = toStateParams;

                //Below code will pass user details to all the views
                /* console.log('service', Utils.getUser());
                 console.log('cookie', Utils.getCookie("user"));
                 console.log('localStorage', Utils.getLocalStorage("user"));
                 */
                /* if (Utils.getUser() == null) {

                 if (Utils.getLocalStorage("user") == null) {
                 $state.go('login');
                 }
                 else {
                 $rootScope.user = angular.fromJson(Utils.getLocalStorage("user"));
                 }
                 }
                 else {
                 $rootScope.user = Utils.getUser();
                 }*/
            });
        }
    ]);

})();
