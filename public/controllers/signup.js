(function () {

    'use strict';

    angular.module('MyApp')
        .controller('SignupController', SignupController);

    SignupController.$inject = ['$scope', '$auth', '$state', 'Utils','toastr'];
    function SignupController ($scope,$auth,$state,Utils, toastr) {

        var vm= this;
        $scope.formErrors = {};
        //this is for testing
        /*vm.user={};
        vm.user.username='sachin';
        vm.user.email ='sachinmalkar16@gmail.com';
        vm.user.mobile='9967247394';
        vm.user.password="Pass@123";
        vm.confirmPassword='Pass@123';*/

        vm.signup = function () {
            $auth.signup(vm.user)
                .then(function (response) {
                    $auth.setToken(response.data.token);
                    vm.user=response.data.user;
                    Utils.setLocalStorage("user",angular.toJson(vm.user));
                    Utils.setUser(vm.user);
                    vm.goTo('home', {});
                    toastr.info('You have successfully created a new account and have been signed-in');
                })
                .catch(function (response) {
                    $scope.serverErrors = response.data.errors;
                    toastr.error("test");
                });
        };

        vm.goTo = function (url) {
            $state.go(url);
        };
    }

})();