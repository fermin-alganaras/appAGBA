(function() {
  'use strict';

  angular
    .module('padron')
    .controller('padronController', padronController);

    padronController.$inject = ['Padron']

  function padronController(Padron) {
    var padronController = this;
    padronController.padron = Padron.padron;
    padronController.mergedPadron = Padron.mergePadronData();
  }

})();
