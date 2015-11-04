(function() {
  'use strict';

  angular
    .module('club')
    .factory('personasService', personasService);

  personasService.$inject = ['$http'];

  function personasService($http) {
    var service = {
      agregarPatinador: agregarPatinador
    };

    function agregarPatinador(patinadores) {
      var data = JSON.stringify(patinadores);

      var config = {
        url: 'app/servicios/Salidas/Padron/Patinador/agregarPatinador.php',
        method: 'POST',
        data: 'patinadores='+data,
        headers: {
          'Content-Type': 'application/x-www-form-urlencoded'
        }
      }
      console.log(config.data);
      $http(config);

    }
    return service;
  }
})();
