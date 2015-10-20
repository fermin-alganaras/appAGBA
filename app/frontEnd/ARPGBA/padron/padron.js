(function() {
  'use strict';

  angular
    .module('padron', [
      'padron.delegados',
      'padron.patinadores',
      'padron.tecnicos'
    ])
    .config(function config($stateProvider) {
      function roleDefinition(){
        var roles = {
          'admin': {permiso: 'admin'},
          'club': {permiso: 'club'},
          'anonimo': {permiso: 'anonimo'}
        }
        return roles;
      }

      $stateProvider
        .state('ARPGBA.padron', {
          url: '/padron',
          views: {
            'content@': {
              templateUrl: 'app/frontEnd/ARPGBA/Admin/templates/padron/padron-tmpl.html',
              controller: 'padronController as padronController',
              resolve: {
                permiso: function (usuarioService, $q, $state){
                  var deferred = $q.defer();
                  var roles = roleDefinition();
                  usuarioService.getUsuario().then(function(result){
                    if(roles.clubes.permiso === result.data.usuario.permiso){
                      deferred.resolve();
                    }else{
                      deferred.reject();
                      $state.go('login')
                    }
                  })
                },
                padron: function(Padron) {
                  return Padron.getPadron()
                }
              }
            },
            'sideBar@': {
              templateUrl: 'app/frontEnd/ARPGBA/Admin/templates/padron/sideBar.padron.html',
              controller: 'padronController as padronController'
            }
          }
        })
        .state('ARPGBA.padron.licencias', {
          url: '^/licencias',
          views: {
            'content@': {
              templateUrl: 'app/frontEnd/ARPGBA/Admin/templates/padron/padron.licencias.tmpl.html',
              controller: 'padronController as padronController',
              resolve: {
                padron: function(Padron) {
                  return Padron.getPadron()
                }
              }
            }
          }
        })

    })
})();
