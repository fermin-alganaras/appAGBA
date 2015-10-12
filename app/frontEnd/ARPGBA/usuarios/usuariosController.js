(function() {
    'use strict';

    angular
        .module('usuario')
        .controller('usuarioController', usuarioController);

    usuarioController.$inject = ['UsuarioService'];

    function usuarioController(UsuarioService) {
        var usuarioController = this;

        usuarioController.usuario = UsuarioService.getUsuario;
        console.log(usuarioController.usuario);


    }
})();
