(function() {
  'use strict';

  angular
    .module('patinadores')
    .factory('Patinadores', patinadores);

  patinadores.$inject = ['$http'];

  function patinadores($http) {
    var service = {
      getPatinadores: getPatinadores,
      patinadores: {}
    };


    function getPatinadores() {
      var config = {
        url: 'app/servicios/Salidas/Padron/Patinador/listarPatinadores.php',
        method: 'POST',
        data: "idClub=" + 0,
        headers: {
          'Content-Type': 'application/x-www-form-urlencoded'
        }
      }

      return $http(config);
    }
    return service;
  }
})();
