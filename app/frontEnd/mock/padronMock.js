(function(){
  'use strict';

  angular
  .module('appAGBA')
  .controller('mockController', mockController);

  function mockController($scope){
    $scope.delegados = [
      {'dni': 1, 'nombre': 'alejandro', 'apellido': 'Torres', 'FechaNacimiento': 15/10/1991, 'sexo': 'M', 'nacionalidad': 'Argentina', 'domicilio': 'calle falsa 123', 'club': 'CA.Brillanté', 'licencia': false},
      {'dni': 2, 'nombre': 'Julia', 'apellido': 'Martines', 'FechaNacimiento': 15/10/1982, 'sexo': 'F', 'nacionalidad': 'Colombia', 'domicilio': 'calle verdadera 123', 'club': 'CA.Brillanté', 'licencia': false},
      {'dni': 3, 'nombre': 'Franco', 'apellido': 'Zuñiga', 'FechaNacimiento': 15/11/1985, 'sexo': 'M', 'nacionalidad': 'Chile', 'domicilio': 'M. de rosas 2323', 'club': 'El tomba puto', 'licencia': false},
      {'dni': 4, 'nombre': 'Erica', 'apellido': 'Vernouli', 'FechaNacimiento': 15/6/1991, 'sexo': 'F', 'nacionalidad': 'Japon', 'domicilio': 'P.Andes 723', 'club': 'El tomba puto', 'licencia': false},
      {'dni': 5, 'nombre': 'javier', 'apellido': 'Einstein', 'FechaNacimiento': 15/2/1991, 'sexo': 'M', 'nacionalidad': 'Brazil', 'domicilio': 'Austin Powers 555', 'club': 'C.A.B.J', 'licencia': false},
    ];

    $scope.patinadores = [
      {'dni': 1, 'nombre': 'Juan', 'apellido': 'Von Butajen', 'FechaNacimiento': 15/10/1991, 'sexo': 'M', 'nacionalidad': 'Argentina', 'domicilio': 'calle falsa 123', 'club': 'CA.Brillanté', 'licencia': false},
      {'dni': 2, 'nombre': 'Pedro', 'apellido': 'Ajenjo', 'FechaNacimiento': 15/10/1982, 'sexo': 'F', 'nacionalidad': 'Colombia', 'domicilio': 'calle verdadera 123', 'club': 'CA.Brillanté', 'licencia': false},
      {'dni': 3, 'nombre': 'Timon', 'apellido': 'Ernestino', 'FechaNacimiento': 15/11/1985, 'sexo': 'M', 'nacionalidad': 'Chile', 'domicilio': 'M. de rosas 2323', 'club': 'CA.Brillanté', 'licencia': false},
      {'dni': 4, 'nombre': 'Pumba', 'apellido': 'Lija', 'FechaNacimiento': 15/6/1991, 'sexo': 'F', 'nacionalidad': 'Japon', 'domicilio': 'P.Andes 723', 'club': 'C.A.B.J', 'licencia': false},
      {'dni': 5, 'nombre': 'Mufasa', 'apellido': 'Heinz', 'FechaNacimiento': 15/2/1991, 'sexo': 'M', 'nacionalidad': 'Brazil', 'domicilio': 'Austin Powers 555', 'club': 'C.A.B.J', 'licencia': false},
    ];

    $scope.tecnicos = [
      {'dni': 1, 'nombre': 'Gandalf', 'apellido': 'Gris', 'FechaNacimiento': 15/10/1991, 'sexo': 'M', 'nacionalidad': 'Tierra media', 'domicilio': 'calle falsa 123', 'club': 'CA.Brillanté', 'licencia': false},
      {'dni': 2, 'nombre': 'Miyagi', 'apellido': 'Wata', 'FechaNacimiento': 15/10/1982, 'sexo': 'M', 'nacionalidad': 'Japon', 'domicilio': 'calle verdadera 123', 'club': 'CA.Brillanté', 'licencia': false},
      {'dni': 3, 'nombre': 'Rafiki', 'apellido': 'FumaPorro', 'FechaNacimiento': 15/11/1985, 'sexo': 'M', 'nacionalidad': 'Sabana', 'domicilio': 'M. de rosas 2323', 'club': 'C.A.B.J', 'licencia': false},
    ];

    $scope.clubes = [
      {'id': 1, 'nombre': 'CA.Brillanté', 'domicilio': 'calle falsa 12233', 'presidente:': 'Adolf Von Richten', 'secretario': 'maria Helena de las Nieves'},
      {'id': 2, 'nombre': 'C.A.B.J', 'domicilio': 'River Putin al 1234', 'presidente:': 'Udrich Von sachen', 'secretario': 'maria Helena de las Montañas'},
      {'id': 3, 'nombre': 'El tomba puto', 'domicilio': 'calle Verdadera 12233', 'presidente:': 'Gustav Von sachertorten', 'secretario': 'maria Helena de las Mesetas'},
    ];

  }
})();
