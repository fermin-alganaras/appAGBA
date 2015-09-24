(function() {
    'use strict';

    angular
        .module('delegados')
        .factory('Delegados', delegados);

        delegados.$inject = ['$http', 'CONSTANTS'];

    function delegados($http, CONSTANTS) {
        var service = {
            getDelegados: getDelegados
        };


        function getDelegados() {
          return $http.get(CONSTANTS.SERVER_URL + 'delegados.json')

        }
        return service;
    }
})();
