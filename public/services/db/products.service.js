(function () {
    'use strict';

    angular.module("MyApp")
        .factory("ProductsSvc", ProductsSvc);

    ProductsSvc.$inject = ['$q', '$http', 'SettingSvc', 'Utils'];

    function ProductsSvc($q, $http, SettingSvc, Utils) {

        var service = {
            create: create,
            findById: findById,
            remove: remove,
            list: list,
            findByCategoryId: findByCategoryId,
            searchByName: searchByName,
            update: update,
            count: count,
            uploadImage: uploadImage,
            removeImage: removeImage,
            saveReply: saveReply
        }

        return service;

        function create(product) {
            var deferred = $q.defer();
            $http({
                method: "POST",
                data: product,
                url: SettingSvc.getRootUrl() + "/product/create",
                //headers: {'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'}
            }).then(function (result) {
                deferred.resolve(result);
            });
            return deferred.promise;
        }

        function findById(id) {
            var deferred = $q.defer();
            $http({
                method: "GET",
                url: SettingSvc.getRootUrl() + "/product/" + id,
                //headers: {'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'}
            }).then(function (result) {
                deferred.resolve(result);
            });
            return deferred.promise;
        }

        function remove(id) {
            var deferred = $q.defer();
            $http({
                method: "POST",
                url: SettingSvc.getRootUrl() + "/product/delete/" + id,
                //headers: {'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'}
            }).then(function (result) {
                deferred.resolve(result);
            });
            return deferred.promise;
        }

        function list(offset, limit) {
            var deferred = $q.defer();
            var products = Utils.getLocalStorage('products');
            if (products) {
                deferred.resolve(angular.fromJson(products));
            }
            else {
                $http({
                    method: "GET",
                    url: SettingSvc.getRootUrl() + "/product/list/" + offset + "/" + limit,
                    headers: {'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'}
                }).then(function (result) {
                    Utils.setLocalStorage("products", angular.toJson(result));
                    deferred.resolve(result);
                });
            }
            return deferred.promise;
        }

        function findByCategoryId(catId) {
            var deferred = $q.defer();
            $http({
                method: "GET",
                url: SettingSvc.getRootUrl() + "/api/products_category/" + catId,
                headers: {'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'}
            }).then(function (result) {
                deferred.resolve(result);
            });
            return deferred.promise;
        }

        function searchByName(search) {
            var deferred = $q.defer();
            $http({
                method: "GET",
                url: SettingSvc.getRootUrl() + "/api/search_products/" + "'" + search + "'",
                headers: {'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'}
            }).then(function (result) {
                deferred.resolve(result);
            });
            return deferred.promise;
        }

        function update(product, id) {
            var deferred = $q.defer();
            $http({
                method: "POST",
                data: product,
                url: SettingSvc.getRootUrl() + "/product/update/" + id,
                //headers: {'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'}
            }).then(function (result) {
                deferred.resolve(result);
            });
            return deferred.promise;
        }


        function count() {
            var deferred = $q.defer();
            $http({
                method: "GET",
                url: SettingSvc.getRootUrl() + "/product/count_products",
                headers: {'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'}
            }).then(function (result) {
                deferred.resolve(result);
            });
            return deferred.promise;
        }

        function uploadImage(fd, id) {
            var deferred = $q.defer();
            $http({
                method: "POST",
                url: SettingSvc.getRootUrl() + "/product/upload_image/" + id,
                data: fd,
                headers: {'Content-Type': undefined}
            }).then(function (result) {
                deferred.resolve(result);
            });
            return deferred.promise;
        }

        function removeImage(product_id, image_id) {
            var deferred = $q.defer();
            $http({
                method: "POST",
                url: SettingSvc.getRootUrl() + "/product/remove_image/" + product_id + "/" + image_id,
                //headers: {'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'}
            }).then(function (result) {
                deferred.resolve(result);
            });
            return deferred.promise;
        }

        function saveReply(reply, id) {
            var deferred = $q.defer();
            $http({
                method: "POST",
                data: reply,
                url: SettingSvc.getRootUrl() + "/product/save_review/" + id,
                //headers: {'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'}
            }).then(function (result) {
                deferred.resolve(result);
            });
            return deferred.promise;
        }


    }
})();