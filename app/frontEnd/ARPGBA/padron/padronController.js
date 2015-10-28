(function() {
    'use strict';

    angular
      .module('padron')
      .controller('padronController', padronController);

    padronController.$inject = ['clubPadronService', 'Padron', 'clubService']

    function padronController(clubPadronService, Padron, clubService) {
      var padronController = this;
      //padronController.padron = clubPadronService.clubesPadron;
      padronController.padron = Padron.padron;
      console.log('hola');
      padronController.mergedPadron = mergePadronData();

      function mergePadronData() {
        var mergedPadron = [];
        _.each(padronController.padron, function(personas) {
          _.each(personas, function(persona) {
            persona.club = clubService.getClubById(persona.club);
            mergedPadron.push(persona);
          })
        })
        return mergedPadron;
      }
  }

})();
