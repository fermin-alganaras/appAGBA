(function() {
    'use strict';

    angular
        .module('ARPGBA')
        .controller('loginController', loginController);

        loginController.$inject = ['usuarioService']

    function loginController(usuarioService) {
        var loginController = this;

        loginController.usuario = {};
        loginController.iniciarSesion = iniciarSesion;


        function iniciarSesion(){
          usuarioService.iniciarSesion(loginController.usuario);
        }
    }
})();
