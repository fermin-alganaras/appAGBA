(function() {
  'use strict';

  angular
    .module('club')
    .controller('clubesController', clubesController);

  clubesController.$inject = ['clubPadronService', '$scope', '$stateParams'];

  function clubesController(clubPadronService, $scope, $stateParams) {
    var clubesController = this;


    clubesController.clubesPadron = clubPadronService.clubesPadron;
    clubesController.isSelected = clubPadronService.isSelected;
    clubesController.selectClub = selectClub;
    $scope.selectedClub = $stateParams.selectedClub;

    function selectClub(club) {
      clubPadronService.setSelected(club);
    }
  }
})();
