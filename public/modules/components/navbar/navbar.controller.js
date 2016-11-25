(function () {

    'use strict';

    angular.module('MyApp')
        .controller('NavbarController', NavbarController);

    NavbarController.$inject = ['$state', 'Utils', '$auth', 'toastr'];

    function NavbarController($state, Utils, $auth, toastr) {
        var vm = this;
        vm.isAuthenticated = function () {
            return $auth.isAuthenticated();
        };

        vm.logout = function () {
            if (!$auth.isAuthenticated()) {
                return;
            }
            $auth.logout()
                .then(function () {
                    toastr.success('You have been logged out');
                    Utils.removeCookie("user");
                    Utils.removeLocalStorage("user");
                    Utils.setUser(null);
                    $state.go('auth', {});
                });
        };

        vm.goTo = function (url) {
            $state.go(url);
        };
    }
})();
