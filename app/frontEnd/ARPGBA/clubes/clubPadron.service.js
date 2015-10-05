(function() {
  'use strict';

  angular
    .module('club')
    .factory('clubPadronService', clubPadronService);

  clubPadronService.$inject = ['$http', 'CONSTANTS'];

  function clubPadronService($http, CONSTANTS) {
    var service = {
      getClubPadron: getClubPadron,
      clubPadron: {},
      selected: {},
      setSelected: setSelected,
      isSelected: isSelected,
      getSelected: getSelected
    };

    function setSelected(club) {
      service.selected = club;
    }

    function getSelected(){
      return service.selected;
    }

    function isSelected() {
       if(_.isEmpty(service.selected)){
        return false
      }else{
        return true
      };
    }

    function getClubPadron() {
      $http.get(CONSTANTS.SERVER_URL + 'padronClub.json').then(function (result){
        service.clubPadron = result.data.padronClubes;
      });
    }

    return service;
  }
})();
