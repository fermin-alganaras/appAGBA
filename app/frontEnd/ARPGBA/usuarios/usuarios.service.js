(function() {
  'use strict';

  angular
    .module('usuario')
    .factory('usuarioService', usuarioService);

  usuarioService.$inject = ['$http', 'CONSTANTS'];

  function usuarioService($http, CONSTANTS) {
    var service = {
      getUsuario: getUsuario,
      usuario: {}
    };

    function getUsuario() {
        return $http.get(CONSTANTS.SERVER_URL + "ARPGBA.json");
    }
    return service

  }
})();
