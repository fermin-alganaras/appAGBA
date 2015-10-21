(function() {
  'use strict';

  angular
    .module('delegados')
    .factory('Delegados', delegados);

  delegados.$inject = ['$http'];

  function delegados($http) {
    var service = {
      getDelegados: getDelegados,
      delegados: {}
    };

    var config = {
      url: 'app/servicios/Salidas/Padron/Delegado/listarDelegados.php',
      method: 'POST',
      data: "idClub=" + 0,
      headers: {
        'Content-Type': 'application/x-www-form-urlencoded'
      }
    }

    function getDelegados() {
      return $http(config);

    }
    return service;
  }
})();
