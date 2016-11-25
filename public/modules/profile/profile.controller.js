(function () {

    'use strict';
    angular.module('MyApp')
        .controller('ProfileController', ProfileController);

    ProfileController.$inject = ['$scope', '$state', '$auth', 'toastr','Utils', 'AccountSvc'];

    function ProfileController($scope, $state, $auth, toastr,Utils, AccountSvc) {

        var vm = this;


        vm.genderChange= function(gender){
            vm.user.gender= gender;
        }

        vm.getProfile = function () {
            AccountSvc.getProfile()
                .then(function (response) {
                    vm.user = response.data;
                })
                .catch(function (response) {
                    toastr.error(response.data.message, response.status);
                });
        };
        vm.updateProfile = function () {
            AccountSvc.updateProfile(vm.user)
                .then(function () {
                    toastr.success('Profile has been updated');
                })
                .catch(function (response) {
                    toastr.error(response.data.message, response.status);
                });
        };
        vm.link = function (provider) {
            $auth.link(provider)
                .then(function () {
                    toastr.success('You have successfully linked a ' + provider + ' account');
                    $scope.getProfile();
                })
                .catch(function (response) {
                    toastr.error(response.data.message, response.status);
                });
        };
        vm.unlink = function (provider) {
            $auth.unlink(provider)
                .then(function () {
                    toastr.info('You have unlinked a ' + provider + ' account');
                    $scope.getProfile();
                })
                .catch(function (response) {
                    toastr.error(response.data ? response.data.message : 'Could not unlink ' + provider + ' account', response.status);
                });
        };

        vm.getProfile();
    }
})();