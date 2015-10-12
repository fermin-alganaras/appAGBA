(function() {
  'use strict';

  angular
    .module('ARPGBA', [
      'permission',
      'ui.router',
      'ui.date',
      'ARPGBA.admin',
      'ARPGBA.usr',
      'padron',
      'club',
      'torneos',
      'usuario',
      'ui.bootstrap'
    ])

  .config(function config($stateProvider, $urlRouterProvider) {
    function roleDefinition(){
      var roles = {
        'admin': {permiso: 'admin'},
        'club': {permiso: 'club'},
        'anonimo': {permiso: null}
      }
      return roles;
    }

    $stateProvider
      .state('login',{
        url: '/',
        views:{
          'content':{
          templateUrl: 'app/frontEnd/ARPGBA/login/login.tmpl.html',
          controller: 'loginController as loginController'
          }
        }
      })

      .state('ARPGBA', {
        url: '/ARPGBA',
        resolve: {
          permiso: function (usuarioService, $q, $state){
            var deferred = $q.defer();
            var roles = roleDefinition();
            usuarioService.getUsuario().then(function(result){
              if(roles.admin.permiso === result.data.usuario.permiso){
                deferred.resolve();
              }else{
                deferred.reject();
                $state.go('login')
              }
            })
          }
        },
        views: {
          'navBar': {
            templateUrl: 'app/frontEnd/ARPGBA/templates/appNavBar.tmpl.html'
          },
          'sideBar': {
            templateUrl: 'app/frontEnd/ARPGBA/templates/sideBar.tmpl.html'
          },

          'content@': {
            templateUrl: 'app/frontEnd/ARPGBA/templates/content.tmpl.html'
          }
        }
      });

    $urlRouterProvider.otherwise('/');
    });



})();
