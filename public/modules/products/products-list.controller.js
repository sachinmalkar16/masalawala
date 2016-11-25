(function () {
    'use strict';

    angular
        .module('MyApp')
        .controller('ProductsController', ProductsController);

    ProductsController.$inject = ['$state', 'ProductsSvc', 'CategoriesSvc', 'SettingSvc'];

    function ProductsController($state, ProductsSvc, CategoriesSvc, SettingSvc) {
        // ProductsSvc, CategoriesSvc
        var vm = this;
        vm.url = SettingSvc.getPhotoUrl();
        vm.products = [];
        vm.count = 0;
        vm.categories = [];
        CategoriesSvc.list().then(function (result) {
            vm.categories = result.data;
        });
        ProductsSvc.count().then(function (result) {
            vm.count = result.data;
            ProductsSvc.list(0, vm.count).then(function (result_) {
                vm.products = result_.data;
            });
        });

        /*   vm.getProductList = function () {
         ProductsSvc.count().then(function (result) {
         vm.count = result.data;
         ProductsSvc.list(0, vm.count).then(function (result_) {
         vm.products = result_.data;
         });
         });
         };

         vm.getCategories = function () {
         CategoriesSvc.list().then(function (result) {
         vm.categories = result.data;
         });
         };
         */
        vm.goTo = function (url) {
            $state.go(url);
        }
    }

})();