(function() {
    'use strict';

    angular
        .module('tecnicos')
        .factory('Tecnicos', tecnicos);

    tecnicos.$inject = ['$http', 'CONSTANTS'];

    function tecnicos($http, CONSTANTS) {
        var service = {
            getTecnicos: getTecnicos
        };


        function getTecnicos() {
          return $http.get(CONSTANTS.SERVER_URL + 'tecnicos.json')
        }
        return service;
    }
})();
