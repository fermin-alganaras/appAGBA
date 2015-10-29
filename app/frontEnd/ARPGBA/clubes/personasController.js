(function() {
  'use strict';

  angular
    .module('club')
    .controller('personasController', personasController);

  personasController.$inject = ['clubService', 'categoriasService', 'personasService', '$state'];

  function personasController(clubService, categoriasService, personasService, $state) {
    var personasController = this;

    personasController.clubes = clubService.clubes;
    personasController.patinadores = [];
    personasController.patinador = {};

    personasController.categoriasEscuelaYlibre = categoriasService.categoriasEscuelaYlibre;
    personasController.categoriasDanza = categoriasService.categoriasDanza;

    personasController.guardarYagregarPatinador = guardarYagregarPatinador;
    personasController.agregarPatinadores = agregarPatinadores;

    function guardarYagregarPatinador() {

      personasController.patinadores.push(personasController.patinador);
      personasController.patinador = {};
    }

    function agregarPatinadores(){
      personasController.patinadores.push(personasController.patinador);
      personasService.agregarPatinador(personasController.patinadores);
    }
  }
})();
