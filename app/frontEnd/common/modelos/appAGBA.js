(function(){
  'use strict';

  angular
  .module('appAGBA', [
    'ui.router',
    'padron'
  ])

  .config(function config($stateProvider, $urlRouterProvider){
    $stateProvider
      .state('appAGBA',{
        url: '',
        abstract: true
      });

      $urlRouterProvider.otherwise('');

  })

})();
