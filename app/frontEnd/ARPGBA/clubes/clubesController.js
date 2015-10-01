(function() {
    'use strict';

    angular
        .module('club')
        .controller('clubesController', clubesController);

        clubesController.$inject = ['clubService'];

    function clubesController(clubService) {
        var clubesController = this;

        clubesController.clubes = clubService.clubes;
    }
})();
