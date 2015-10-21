(function() {
  'use strict';

  angular
    .module('club')
    .factory('clubService', club);

  club.$inject = ['$http', 'CONSTANTS'];

  function club($http, CONSTANTS) {
    var service = {
      getClubes: getClubes,
      clubes: {},

    };

    function getClubes() {
      var config = {
        url: 'app/servicios/Salidas/Varias/Clubes/listarClubes.php',
        method: 'POST',

      }

      return $http(config).then(function(result){
        service.clubes = result.data;
      });

    }

    return service;
  }
})();
