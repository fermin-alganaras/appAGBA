(function() {
  'use strict';

  angular
    .module('torneos', [])

  .config(function config($stateProvider) {
    function roleDefinition() {
      var roles = {
        'admin': {
          permiso: 'admin'
        },
        'club': {
          permiso: 'club'
        },
        'anonimo': {
          permiso: 'anonimo'
        }
      }
      return roles;
    }

    $stateProvider.state('ARPGBA.torneos', {
        url: '/torneos',
        resolve: {
          permiso: function(usuarioService, $state) {
            var roles = roleDefinition();
            var usuario = usuarioService.getUsuario();
            if (!(roles.admin.permiso === usuario.tipo)) {
              $state.go('login')
            }
          }
        },
        views: {
          'content@': {
            templateUrl: 'app/frontEnd/ARPGBA/admin/templates/torneos/torneosTemplate.html',
            controller: 'torneosController as torneosController'
          },
          'sideBar@': {
            templateUrl: 'app/frontEnd/ARPGBA/admin/templates/torneos/sideBarTorneosTemplate.html',
            controller: 'torneosController as torneosController'
          }
        }
      })
      .state('ARPGBA.torneos.nuevo', {
        url: '/nuevo',
        views: {
          'content@': {
            templateUrl: 'app/frontEnd/ARPGBA/admin/templates/torneos/nuevoTorneoTemplate.html',
            controller: 'nuevoTorneoController as nuevoTorneoController',
            resolve: {
              categorias: function(categoriasService) {
                  return categoriasService.getCategorias();
              }
            }
          }
        }

      })
  })
})();
