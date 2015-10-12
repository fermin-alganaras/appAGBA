(function() {
  'use strict';

  angular
    .module('club')
    .controller('clubesController', clubesController);

  clubesController.$inject = ['clubService', 'clubPadronService', '$scope', '$stateParams'];

  function clubesController(clubService, clubPadronService, $scope, $stateParams) {
    var clubesController = this;



    clubesController.clubesPadron = clubPadronService.clubPadron;
    clubesController.isSelected = clubPadronService.isSelected;
    clubesController.selectClub = selectClub;
      $scope.selectedClub = $stateParams.selectedClub;

    function selectClub(club) {
      clubPadronService.setSelected(club);
    }

  }
})();
