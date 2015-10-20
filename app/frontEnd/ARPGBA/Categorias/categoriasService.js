(function() {
    'use strict';

    angular
        .module('categorias')
        .factory('categoriasService', categoriasService);

    categoriasService.$inject = ['$http', 'CONSTANTS'];

    function categoriasService($http, CONSTANTS) {
        var service = {
            getCategoriasPromise: getCategoriasPromise,
            getCategorias: getCategorias,
            categorias: {}
        };

        return service;

        function getCategoriasPromise() {
          return $http.get(CONSTANTS.SERVER_URL + 'categorias.json')
          }
        function getCategorias(){
          getCategoriasPromise().then(function(result){
            service.categorias = result.data;
          })
        }
    }
})();
