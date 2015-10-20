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
        service.usuario = result.data;
        if (service.usuario.tipo === 'admin') {
          $state.go('ARPGBA')
        }else if (service.usuario.tipo === 'club') {
          $state.go('login')
        }else {
          $state.go('login')
        }
      })
    }


    function getUsuario() {
      return service.usuario;
    }
    return service

  }
})();
