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
      $http.get(CONSTANTS.SERVER_URL + 'clubes.json').then(function(result) {
        service.clubes =
          result.data.clubes;
      });
    }

    return service;
  }
})();
