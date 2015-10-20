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
                clubPadron: function(clubPadronService) {
                  return clubPadronService.getClubPadron();
                }
              }
            },
            'sideBar@': {
              templateUrl: 'app/frontEnd/ARPGBA/Admin/templates/clubes/sideBar.clubes.html',
              controller: 'clubesController as clubesController',
              resolve: {
                clubes: function(clubService) {
                  return clubService.getClubes()
                }
              }
            }
          }
        })
            .state('ARPGBA.club.patinadores', {
              url: 'clubes/info/patinadores/:selectedClub',
              views: {
                'content@': {
                  templateUrl: 'app/frontEnd/ARPGBA/Admin/templates/clubes/clubInfoPatinadores.tmpl.html',
                  controller: 'clubesInfoController as clubInfo',
                  resolve: {
                    clubPadron: function(clubPadronService) {
                      return clubPadronService.getClubPadron();
                    }
                  }
                }
              }
            })
            .state('ARPGBA.club.delegados', {
              url: 'clubes/info/delegados/:selectedClub',
              views: {
                'content@': {
                  templateUrl: 'app/frontEnd/ARPGBA/Admin/templates/clubes/clubInfoDelegados.tmpl.html',
                  controller: 'clubesInfoController as clubInfo',
                  resolve: {
                    clubPadron: function(clubPadronService) {
                      return clubPadronService.getClubPadron();
                    }
                  }
                }
              }
            })
            .state('ARPGBA.club.tecnicos', {
              url: 'clubes/info/tecnicos/:selectedClub',
              views: {
                'content@': {
                  templateUrl: 'app/frontEnd/ARPGBA/Admin/templates/clubes/clubInfoTecnicos.tmpl.html',
                  controller: 'clubesInfoController as clubInfo',
                  resolve: {
                    clubPadron: function(clubPadronService) {
                      return clubPadronService.getClubPadron();
                    }
                  }
                }
              }
            })
        })
})();
