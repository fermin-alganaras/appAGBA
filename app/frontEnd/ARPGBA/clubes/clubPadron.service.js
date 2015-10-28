(function() {
  'use strict';

  angular
    .module('club')
    .factory('clubPadronService', clubPadronService);

  clubPadronService.$inject = ['$http', 'Padron', '$q','clubService'];

  function clubPadronService($http, Padron, $q, clubService) {
    var service = {
      getClubPadron: getClubPadron,
      clubesPadron: {},
      padron: {},
      selected: {},
      setSelected: setSelected,
      isSelected: isSelected,
      getSelected: getSelected

    };

    function setSelected(club) {
      service.selected = club;
    }

    function getSelected() {
      return service.selected;
    }

    function isSelected() {
      if (_.isEmpty(service.selected)) {
        return false
      } else {
        return true
      };
    }

    function getClubPadron() {
      var deferred = $q.defer();


      clubService.getClubes().then(function(result) {
        service.clubesPadron = _.cloneDeep(result.data);

        Padron.getPadron().then(function(padron) {
          service.padron = padron;
          _.each(service.clubesPadron, function(club) {
            _.each(service.padron, function(array, key) {
              club[key] = _.filter(array, {
                "club": club.idClub
              })
            })
          })
          deferred.resolve(service.clubesPadron);
        })
      });
      return deferred.promise;
    }



    return service;
  }
})();
