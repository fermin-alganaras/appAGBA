(function() {
  'use strict';

  angular
    .module('club')
    .factory('clubPadronService', clubPadronService);

  clubPadronService.$inject = ['$http', 'Padron'];

  function clubPadronService($http, Padron) {
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
      var config = {
        url: 'app/servicios/Salidas/Varias/Clubes/listarClubes.php',
        method: 'POST',

      }

      return $http(config).then(function(result) {
        service.clubesPadron = result.data;

        Padron.getPadron().then(function(padron) {
          service.padron = padron;

          _.forEach(service.clubesPadron, function(club) {
            _.mapKeys(service.padron, function(key) {
              _.forEach(key, function(persona) {
                if (club.idClub === persona.club.id) {
                  service.clubesPadron.club.key = service.padron.persona;
                }
              })
            })
          })

        })

      });
    }

    return service;
  }
})();
