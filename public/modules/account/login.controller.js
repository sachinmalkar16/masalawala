(function () {

    'use strict';
    angular.module('MyApp')
        .controller('LoginController', LoginController);

    LoginController.$inject = [ '$auth', '$state', 'Utils','toastr','$scope', '$location'];

    function LoginController ($auth, $state ,Utils,toastr,$scope, $location) {

        var vm = this;
        vm.login = function () {

            $auth.login(vm.user)
                .then(function (response) {
                    toastr.success('You have successfully signed in!');
                    vm.user=response.data.user;
                    Utils.setLocalStorage("user",angular.toJson(vm.user));
                    Utils.setUser(vm.user);
                    //$location.path('/');
                    vm.goTo('home', {});
                })
                .catch(function (error) {
                    toastr.error(error.data.message, error.status);
                });
        };

        vm.authenticate = function (provider) {
            $auth.authenticate(provider)
                .then(function (response) {
                    toastr.success('You have successfully signed in with ' + provider + '!');
                    // $location.path('/');
                    vm.user=response.data.user;
                    Utils.setLocalStorage("user",angular.toJson(vm.user));
                    Utils.setUser(vm.user);
                    vm.goTo('home', {});
                })
                .catch(function (error) {
                    if (error.message) {
                        // Satellizer promise reject error.
                        toastr.error(error.message);
                    } else if (error.data) {
                        // HTTP response error from server
                        toastr.error(error.data.message, error.status);
                    } else {
                        toastr.error(error);
                    }
                });
        };

        vm.goTo = function (url) {
            $state.go(url);
        }
    }
})();
