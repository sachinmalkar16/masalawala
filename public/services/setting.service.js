(function () {
    'use strict';

    angular.module("MyApp")
        .factory("SettingSvc", SettingSvc);

    SettingSvc.$inject = [];

    function SettingSvc() {
        //Your Website URL
        var url = 'http://localhost:8000';

        return {
            getRootUrl: getRootUrl,
            getPhotoUrl: getPhotoUrl
        };

        function getRootUrl() {
            return url + '/api';
        }

        function getPhotoUrl() {
            return url + '/images';
        }
    }
})();