(function() {
  'use strict';

  angular
    .module('categorias')
    .factory('categoriasService', categoriasService);

  categoriasService.$inject = ['$http'];

  function categoriasService($http) {
    var service = {
      getCategoriasTecnicos: getCategoriasTecnicos,
      categoriasTecnicos: {},
      getCategoriasParejasDanza: getCategoriasParejasDanza,
      categoriasParejasDanza: {},
      getCategoriasParejasLibre: getCategoriasParejasLibre,
      categoriasParejasLibre: {},
      getCategoriasEscuelaLibre: getCategoriasEscuelaLibre,
      categoriasEscuelaYlibre: {},
      getCategoriasDanza: getCategoriasDanza,
      categoriasDanza: {},
    };

    function getCategoriasTecnicos() {
      var config = {
        url: 'app/servicios/Salidas/Varias/Categorias/listarCategoriasTecnicos.php',
        method: 'POST'
      }
      return $http(config).then(function(result) {
        service.categoriasTecnicos = result.data;
      })
    }

    function getCategoriasParejasDanza() {
      var config = {
        url: 'app/servicios/Salidas/Varias/Categorias/listarParejasDanza.php',
        method: 'POST'
      }
      return $http(config).then(function(result) {
        service.categoriasParejasDanza = result.data;
      })
    }

    function getCategoriasParejasLibre() {
      var config = {
        url: 'app/servicios/Salidas/Varias/Categorias/listarParejasLibre.php',
        method: 'POST'
      }
      return $http(config).then(function(result) {
        service.categoriasParejasLibre = result.data;
      })
    }

    function getCategoriasEscuelaLibre() {
      var config = {
        url: 'app/servicios/Salidas/Varias/Categorias/listarSolistaEscYlibre.php',
        method: 'POST'
      }
      return $http(config).then(function(result) {
        service.categoriasEscuelaYlibre = result.data;
      })
    }

    function getCategoriasDanza() {
      var config = {
        url: 'app/servicios/Salidas/Varias/Categorias/listarSolistasDanza.php',
        method: 'POST'
      }
      return $http(config).then(function(result) {
        service.categoriasDanza = result.data;
      })
    }
    return service;
  }
})();
