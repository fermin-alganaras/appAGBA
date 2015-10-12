(function() {
  'use strict';

  angular
    .module('padron')
    .controller('modalController', modalController);

  modalController.$inject = ['$modalInstance', 'persona'];

  function modalController($modalInstance, persona) {

    var modalController = this;
    modalController.persona = persona;

  }
})();
