(function() {

    'use strict';

    angular
        .module('MyApp')
        .controller('PasswordController', PasswordController);


    PasswordController.$inject = [ '$auth', '$state', 'Utils'];
    function PasswordController($auth, $state ,Utils) {

        var vm = this;



    }

})();