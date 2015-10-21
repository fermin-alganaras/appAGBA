(function() {
    'use strict';

    angular
        .module('tecnicos')
        .factory('Tecnicos', tecnicos);

    tecnicos.$inject = ['$http'];

    function tecnicos($http) {
        var service = {
            getTecnicos: getTecnicos,
            tecnicos: {}
        };

        function getTecnicos() {
          var config = {
            url:  'app/servicios/Salidas/Padron/Tecnico/listarTecnicos.php',
            method: 'POST',
            data: "idClub=" + 0,
            headers: {
              'Content-Type': 'application/x-www-form-urlencoded'
            }
          }

          return $http(config);
      }
        return service;
    }
})();
