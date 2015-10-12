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
            url: 'torneos',
            resolve: {
              permiso: function(usuarioService, $q, $state) {
                var deferred = $q.defer();
                var roles = roleDefinition();
                usuarioService.getUsuario().then(function(result) {
                  if (roles.admin.permiso === result.data.usuario.permiso) {
                    deferred.resolve();
                  } else {
                    deferred.reject();
                    $state.go('login')
                  }
                })
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
              url: 'torneos/nuevo',
              views: {
                'content@': {
                  templateUrl: 'app/frontEnd/ARPGBA/admin/templates/torneos/nuevoTorneoTemplate.html',
                  controller: 'torneosController as torneosController'
                }
              }

            })
    })
})();
