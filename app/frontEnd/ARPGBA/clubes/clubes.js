(function() {
    'use strict';

    angular
        .module('club', [])
        .config(function config($stateProvider){
          $stateProvider
          .state('ARPGBA.club', {
            url: 'clubes',
            views: {
              'content@':{
                templateUrl: 'app/frontEnd/ARPGBA/Admin/templates/clubes/clubes.tmpl.html',
                controller: 'clubesController as clubesController'
              },
              'sideBar@':{
                templateUrl: 'app/frontEnd/ARPGBA/Admin/templates/clubes/sideBar.clubes.html',
                controller: 'clubesController as clubesController'
              }
            }
          })
        })
})();
