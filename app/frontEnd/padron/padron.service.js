(function() {
    'use strict';

    angular
        .module('padron')
        .factory('Padron', Padron);

    Padron.$inject = ['$q', 'Patinadores'];

    function Padron($q, Patinadores) {
        var service = {
            getPadron: getPadron,
            padron: {}
        };

        return service;

        function getPadron() {
          var deferred = $q.defer();

          Patinadores.getPatinadores()
            .then(function(result)  {
              service.padron.patinadores = result.data.patinadores;
              deferred.resolve(service.padron);
            });

          return deferred.promise

        }
    }
})();
