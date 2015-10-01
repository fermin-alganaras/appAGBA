(function() {
  'use strict';

  angular
    .module('padron', [
      'padron.delegados',
      'padron.patinadores',
      'padron.tecnicos'
    ])
    .config(function config($stateProvider) {
      $stateProvider
        .state('ARPGBA.padron', {
          url: 'padron',
          views: {
            'content@': {
              templateUrl: 'app/frontEnd/ARPGBA/Admin/templates/padron/padron-tmpl.html',
              controller: 'padronController as padronController',
              resolve: {
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
