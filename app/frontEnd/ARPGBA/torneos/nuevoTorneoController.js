(function() {
  'use strict';

  angular
    .module('torneos')
    .controller('nuevoTorneoController', nuevoTorneoController);

  nuevoTorneoController.$inject = ['categoriasService','$q']

  function nuevoTorneoController(categoriasService, $q) {
    var nuevoTorneoController = this;

    nuevoTorneoController.categorias = _.valuesIn(categoriasService.categorias.categorias[0]);
    nuevoTorneoController.categoriasSeleccionadas = [];
    nuevoTorneoController.tags = categoriasService.getCategoriasPromise;

    nuevoTorneoController.getTags = function(query) {
        var deferred = $q.defer();

        var resultado = _.filter(nuevoTorneoController.categorias, function(categoria) {
          var denominacion = categoria.Denominacion.toUpperCase()
          return denominacion.indexOf(query.toUpperCase()) != -1;
        });

        resultado = resultado.length > 0 ? resultado : nuevoTorneoController.categorias;

        deferred.resolve(resultado);

        return deferred.promise;
    }
  }
})();
