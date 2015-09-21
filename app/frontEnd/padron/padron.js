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
      .state('padron', {
          url: '',
          views: {
            'padron@': {
              templateUrl: 'app/frontEnd/templates/padron-tmpl.html',
              controller: 'padronController as padronController',
              resolve: {
                padron: function(Padron) {
                  return Padron.getPadron()
                }
              }
            },
            'accionesPadron@': {
              templateUrl: 'app/frontEnd/templates/leftColumn.html',
              controller: 'padronController as padronController'
            }
          }
      })
  })
})();
