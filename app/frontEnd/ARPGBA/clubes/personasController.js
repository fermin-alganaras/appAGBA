(function() {
  'use strict';

  angular
    .module('club')
    .controller('personasController', personasController);

  personasController.$inject = ['clubService'];

  function personasController(clubService) {
    var personasController = this;

    personasController.clubes = clubService.clubes;
    personasController.Patinadores = [];


  }
})();
