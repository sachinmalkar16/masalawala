(function () {
    'use strict';

    angular
        .module('MyApp')
        .controller('SearchController', SearchController);

    SearchController.$inject = ['$state', 'ProductsSvc', 'CategoriesSvc', 'SettingSvc'];

    function SearchController($state, ProductsSvc, CategoriesSvc, SettingSvc) {
        // ProductsSvc, CategoriesSvc
        var vm = this;

        vm.url = SettingSvc.getPhotoUrl();
        vm.products = [];
        vm.count = 0;
        vm.categories = [];
        vm.page = [10, 25, 20, 25, 30];
        vm.pageSize = 20;
        vm.sortByType = [{'value': 'product_name', 'display': 'Name'},
                        {'value': 'price', 'display': 'Price'},
                        {'value': 'rating', 'display': 'Rating'},
                        {'value': 'category', 'display': 'Category'}
                        ];
        vm.sortBy = "product_name";

        CategoriesSvc.list().then(function (result) {
            vm.categories = result.data;
        });

        ProductsSvc.count().then(function (result) {
            vm.count = result.data;
            ProductsSvc.list(0, vm.count).then(function (result_) {
                vm.products = result_.data;
            });
        });

        vm.goTo = function (url) {
            $state.go(url);
        }
    }

})();