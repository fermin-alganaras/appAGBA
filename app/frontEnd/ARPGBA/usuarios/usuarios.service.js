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
      var data = JSON.stringify(usuario);
      var config = {
        method: 'POST',
        url: 'app/servicios/Salidas/Varias/Usuarios/login.php',
        data: 'usuario=' + data,
        headers: {'Content-Type': 'application/x-www-form-urlencoded'}
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
