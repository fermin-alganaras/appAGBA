(function() {
  'use strict';

  angular
    .module('club', [])
    .config(function config($stateProvider) {
      function roleDefinition(){
        var roles = {
          'admin': {permiso: 'admin'},
          'club': {permiso: 'club'},
          'anonimo': {permiso: 'anonimo'}
        }
        return roles;
      }
      $stateProvider
        .state('ARPGBA.club', {
          url: '/clubes',
          views: {
            'content@': {
              templateUrl: 'app/frontEnd/ARPGBA/Admin/templates/clubes/clubes.tmpl.html',
              controller: 'clubesController as clubesController',
              resolve: {
                permiso: function (usuarioService, $q, $state){
                  var deferred = $q.defer();
                  var roles = roleDefinition();
                  usuarioService.getUsuario().then(function(result){
                    if(roles.admin.permiso === result.data.usuario.permiso){
                      deferred.resolve();
                    }else{
                      deferred.reject();
                      $state.go('login')
                    }
                  })
                },
                clubesPadron: function(clubPadronService) {
                  return clubPadronService.getClubPadron();
                },
                clubes: function(clubService) {
                  return clubService.getClubes().then(function(result){
                    clubService.clubes = result.data;
                  })
                }
              }
            },
            'sideBar@': {
              templateUrl: 'app/frontEnd/ARPGBA/Admin/templates/clubes/sideBar.clubes.html',
              controller: 'clubesController as clubesController',
              resolve: {
                clubesPadron: function(clubPadronService) {
                  return clubPadronService.getClubPadron();
                }
              }
            }
          }
        })
            .state('ARPGBA.club.patinadores', {
              url: '/info/patinadores/:selectedClub',
              views: {
                'content@': {
                  templateUrl: 'app/frontEnd/ARPGBA/Admin/templates/clubes/clubInfoPatinadores.tmpl.html',
                  controller: 'clubesInfoController as clubInfo',
                }
              }
            })
            .state('ARPGBA.club.delegados', {
              url: '/info/delegados/:selectedClub',
              views: {
                'content@': {
                  templateUrl: 'app/frontEnd/ARPGBA/Admin/templates/clubes/clubInfoDelegados.tmpl.html',
                  controller: 'clubesInfoController as clubInfo',
                }
              }
            })
            .state('ARPGBA.club.tecnicos', {
              url: '/info/tecnicos/:selectedClub',
              views: {
                'content@': {
                  templateUrl: 'app/frontEnd/ARPGBA/Admin/templates/clubes/clubInfoTecnicos.tmpl.html',
                  controller: 'clubesInfoController as clubInfo',
                }
              }
            })
            .state('ARPGBA.club.nuevoPatinador', {
              url: '/NuevoPatinador',
              views: {
                'content@':{
                  templateUrl: 'app/frontEnd/ARPGBA/admin/templates/clubes/nuevoPatinador.tmpl.html',
                  controller: 'personasController as personasController'
                }
              }
            })
            .state('ARPGBA.club.nuevaDelegado', {
              url: '/NuevoDelegado',
              views: {
                'content@':{
                  templateUrl: 'app/frontEnd/ARPGBA/admin/templates/clubes/nuevoDelegado.tmpl.html',
                  controller: 'personasController as personasController'
                }
              }
            })
            .state('ARPGBA.club.nuevoTecnico', {
              url: '/NuevoTecnico',
              views: {
                'content@':{
                  templateUrl: 'app/frontEnd/ARPGBA/admin/templates/clubes/nuevTecnico.tmpl.html',
                  controller: 'personasController as personasController'
                }
              }
            })
        })
})();
