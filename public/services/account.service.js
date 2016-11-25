(function () {
    'use strict';
    angular.module('MyApp')
        .factory('AccountSvc', AccountSvc);

    AccountSvc.$inject =['$http'];

    function AccountSvc ($http) {
        return {
            getProfile: getProfile ,
            updateProfile: updateProfile
        };

        function getProfile() {
            return $http.get('/api/me');
        }
        function updateProfile(profileData) {
            return $http.put('/api/me', profileData);
        }
    }
})();