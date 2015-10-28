(function() {
  'use strict';

  angular
    .module('club')
    .factory('clubService', club);

  club.$inject = ['$http', '$q'];

  function club($http, $q) {
    var service = {
      getClubes: getClubes,
      clubes: {},
      getClubById: _.memoize(getClubById)
    };

    function getClubes() {
      var config = {
        url: 'app/servicios/Salidas/Varias/Clubes/listarClubes.php',
        method: 'POST',

      }

      var deferred = $q.defer();


      $http(config).then(function(result){
        service.clubes = result.data;

        deferred.resolve(result);
      });

      return deferred.promise;
    }

      function getClubById(id){

        return _.findWhere(service.clubes, {"idClub": id});
      }

    return service;
  }
})();
