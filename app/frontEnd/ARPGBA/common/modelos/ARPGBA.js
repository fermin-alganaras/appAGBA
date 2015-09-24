(function(){
  'use strict';

  angular
  .module('ARPGBA', [
    'ui.router',
    'permission',
    'ARPGBA.admin',
    'ARPGBA.usr',
    'padron',
    'club'
  ])

  .config(function config($stateProvider, $urlRouterProvider){
    $stateProvider
      .state('ARPGBA',{
        url: '/',
        views:{
          'navBar': {
            templateUrl: 'app/frontEnd/ARPGBA/templates/appNavBAr.tmpl.html'
          },
          'sideBar': {
            templateUrl: 'app/frontEnd/ARPGBA/templates/sideBar.tmpl.html'
          },

          'content':{
            templateUrl: 'app/frontEnd/ARPGBA/templates/content.tmpl.html'
          }
        }
      });

      $urlRouterProvider.otherwise('/');

  })

})();
