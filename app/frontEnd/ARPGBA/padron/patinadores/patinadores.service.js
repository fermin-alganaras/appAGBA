(function() {
    'use strict';

    angular
        .module('patinadores')
        .factory('Patinadores', patinadores);

    patinadores.$inject = ['$http', 'CONSTANTS'];

    function patinadores($http, CONSTANTS) {
        var service = {
            getPatinadores: getPatinadores
        };


        function getPatinadores() {
          return $http.get(CONSTANTS.SERVER_URL + 'patinadores.json');
        }
        return service;
    }
})();
