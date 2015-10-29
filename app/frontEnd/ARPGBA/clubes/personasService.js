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

    function agregarPatinador(patinadorEs) {
      var config = {
        url: 'app/servicios/Salidas/Padron/Patinador/agregarPatinador.php',
        method: 'POST',
        data: patinadorEs,
      }
      $http(config);

    }
    return service;
  }
})();
