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
          return $q.all([Tecnicos.getTecnicos(), Delegados.getDelegados(), Patinadores.getPatinadores()]).then(function(results){
            _.forEach(results, function(result){

              if(_.has(result.data[0], 'idTecnico')){
                service.padron.tecnicos = result.data;

              }else if (_.has(result.data[0], 'idDelegado')) {
                service.padron.delegados = result.data;
              }else{
                service.padron.patinadores = result.data;
              }

            })
          });
        }

        function mergePadronData(){
          return _.union(service.padron.tecnicos, service.padron.delegados, service.padron.patinadores);
        }

        return service;
    }
})();
