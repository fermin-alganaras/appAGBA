(function() {
  'use strict';

  angular
    .module('ARPGBA', [
      'ui.router',
      'ui.date',
      'ARPGBA.admin',
      'ARPGBA.usr',
      'padron',
      'club',
      'torneos',
      'usuario',
      'categorias',
      'ui.bootstrap',
      'ngTagsInput'
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
          permiso: function (usuarioService, $state){
            var roles = roleDefinition();
            var usuario = usuarioService.getUsuario();
              if(!(roles.admin.permiso === usuario.tipo)){
                $state.go('login')
              }
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
