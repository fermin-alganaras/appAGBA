(function() {
  'use strict';

  angular
    .module('padron')
    .controller('padronController', padronController);

  padronController.$inject = ['Padron', '$modal']

  function padronController(Padron, $modal) {
    var padronController = this;
    padronController.padron = Padron.padron;
    padronController.mergedPadron = Padron.mergePadronData();


    padronController.open = function(persona) {

      var modalInstance = $modal.open({
        templateUrl: 'app/frontEnd/ARPGBA/padron/modal/modal.tmpl.html',
        controller: 'modalController as modalController',
        size: 'lg',
        resolve: {
          persona: function(){
            return persona
          }
        }
      });

      modalInstance.result.then(function(msg) {
        alert(msg);
      }, function() {
      });
    };

  }

})();
