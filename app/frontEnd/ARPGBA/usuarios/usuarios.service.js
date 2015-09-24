(function() {
  'use strict';

  angular
    .module('usuarios.usuario')
    .factory('Usuario', Usuario);

  Usuario.$inject = ['$http', 'CONSTANTS'];

  function Usuario($q, $http, CONSTANTS) {
    var service = {
      getUsuario: getUsuario
    };

    function getUsuario() {
        return $http.get(CONSTANTS.SERVER_URL + usuarios.json);
    }
    return service

  }
})();
