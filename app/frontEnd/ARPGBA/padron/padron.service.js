(function() {
    'use strict';

    angular
        .module('padron')
        .factory('Padron', Padron);

    Padron.$inject = ['$q', 'Patinadores', 'Delegados', 'Tecnicos'];

    function Padron($q, Patinadores, Delegados, Tecnicos) {
        var service = {
            getPadron: getPadron,
            mergePadronData: mergePadronData,
            padron: {}
        };



        function getPadron() {
          $q.all([Tecnicos.getTecnicos(), Delegados.getDelegados(), Patinadores.getPatinadores()]).then(function(results){
            _.forEach(results, function(result){
              service.padron[_.keys(result.data)[0]] = result.data[_.keys(result.data)[0]];
            })
          });
        }

        function mergePadronData(){
          return _.union(service.padron.tecnicos, service.padron.delegados, service.padron.patinadores);
        }

        return service;
    }
})();
