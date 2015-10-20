(function() {
    'use strict';

    angular
        .module('patinadores')
        .factory('Patinadores', patinadores);

    patinadores.$inject = ['$http', 'CONSTANTS'];

    function patinadores($http, CONSTANTS) {
        var service = {
            getPatinadores: getPatinadores,
            patinadores:{}
        };

        var config = {
          method: 'POST',
          url: 'app/servicios/Salidas/Padron/Patinador/listarPatinadores.php',
          data: {idClub: '0'}
        }
        function getPatinadores() {
          return $http(config).then(function(result){
            service.patinadores = result.data;
          })
        }
        return service;
    }
})();
