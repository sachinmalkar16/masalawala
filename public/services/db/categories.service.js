(function () {
    'use strict';

    angular.module("MyApp")
        .factory("CategoriesSvc", CategoriesSvc);

    CategoriesSvc.$inject = ['$q', '$http', 'SettingSvc'];

    function CategoriesSvc($q, $http, SettingSvc) {

        return {
            create: create,
            findById: findById,
            remove: remove,
            list: list,
            update: update,
        };

        function create(category) {
            var deferred = $q.defer();
            $http({
                method: "POST",
                data: category,
                url: SettingSvc.getRootUrl() + "/api/categories",
                headers: {'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'}
            }).then(function (result) {
                deferred.resolve(result);
            });
            return deferred.promise;
        }

        function findById(id) {
            var deferred = $q.defer();
            $http({
                method: "GET",
                url: SettingSvc.getRootUrl() + "/api/categories/" + id,
                headers: {'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'}
            }).then(function (result) {
                deferred.resolve(result);
            });
            return deferred.promise;
        }

        function remove(id) {
            var deferred = $q.defer();
            $http({
                method: "POST",
                url: SettingSvc.getRootUrl() + "/api/categories_delete/" + id,
                headers: {'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'}
            }).then(function (result) {
                deferred.resolve(result);
            });
            return deferred.promise;
        }

        function list() {
            var deferred = $q.defer();
            $http({
                method: "GET",
                url: SettingSvc.getRootUrl() + "/categories/list",
                headers: {'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'}
            }).then(function (result) {
                deferred.resolve(result);
            });
            return deferred.promise;
        }

        function update(category, id) {
            var deferred = $q.defer();
            $http({
                method: "POST",
                data: category,
                url: SettingSvc.getRootUrl() + "/api/categories_update/" + id,
                headers: {'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'}
            }).then(function (result) {
                deferred.resolve(result);
            });
            return deferred.promise;
        }
    }
})();