(function() {
  'use strict';

  angular
    .module('usuario')
    .factory('usuarioService', usuarioService);

  usuarioService.$inject = ['$http', '$state', 'CONSTANTS'];

  function usuarioService($http, $state, CONSTANTS) {
    var service = {
      getUsuario: getUsuario,
      usuario: {},
      iniciarSesion: iniciarSesion
    };

    function iniciarSesion(usuario) {
      var data = {'usuario':usuario};
      var config = {
        method: 'POST',
        url: 'app/servicios/Salidas/varias/Usuarios/login.php',
        data: data
      }
      $http(config).then(function (result){
        service.usuario = result.data.user;
        $state.go('ARPGBA')
      })
    }


    function getUsuario() {
      return $http.get(CONSTANTS.SERVER_URL + "ARPGBA.json");
    }
    return service

  }
})();
