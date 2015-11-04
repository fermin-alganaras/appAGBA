(function() {
  'use strict';

  angular
    .module('club')
    .controller('clubesInfoController', clubInfo);

  clubInfo.$inject = ['clubService', 'clubPadronService', '$stateParams', '$modal'];

  function clubInfo(clubService, clubPadronService, $stateParams, $modal) {
    var clubInfo = this;

    clubInfo.clubNombre = $stateParams.club;
    clubInfo.club = clubPadronService.getSelected();
    clubInfo.isSelected = clubPadronService.isSelected;


    clubInfo.open = function(persona) {
      
      var modalInstance = $modal.open({
        templateUrl: 'app/frontEnd/ARPGBA/clubes/modal/modal.tmpl.html',
        controller: 'modalController as modalController',
        size: 'lg',
        resolve: {
          persona: function() {
            return persona
          }
        }
      });

      modalInstance.result.then(function(msg) {
        alert(msg);
      }, function() {});
    };

  }
})();
