(function () {
    angular.module('MyApp')
        .factory("Utils", Utils);

    Utils.$inject = ['$window', '$cookieStore','$auth'];

    function Utils($window, $cookieStore,$auth) {

        var user;

        return {
            setLocalStorage: setLocalStorage,
            getLocalStorage: getLocalStorage,
            removeLocalStorage: removeLocalStorage,
            setCookie: setCookie,
            getCookie: getCookie,
            removeCookie: removeCookie,
            getUser: getUser,
            setUser: setUser
        };

        function setUser(user){
            user= user;
        }
        function getUser(){

            if (!$auth.isAuthenticated()) { return; }
            if(user == null) {
                if (getCookie("user") == null) {
                    if (getLocalStorage("user") == null) {
                        return;
                    }
                    else {
                        user = angular.fromJson(getLocalStorage("user"));
                    }
                }
                else {
                    user = angular.fromJson(getCookie("user"));
                }
            }
            return user;
        }
        function setCookie(name, value) {
            return $cookieStore.put(name, value);
        }

        function getCookie(name) {
            return $cookieStore.get(name);
        }

        function removeCookie(name) {
            return $cookieStore.remove(name);
        }

        function setLocalStorage(name, value) {
            return $window.localStorage.setItem(name, value);
        }

        function getLocalStorage(name) {
            return $window.localStorage.getItem(name);
        }

        function removeLocalStorage(name) {
            return $window.localStorage.removeItem(name);
        }

    }
})();