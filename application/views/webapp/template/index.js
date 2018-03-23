/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

var app=angular.module("app",[]);
  
function PruebaController($scope,$http) {
    
    var config={
        method:"GET",
        url:"https://api.github.com/repos/angular/angular.js/issues"
    }
    
    var response=$http(config);
    
    response.then(function(resp){
        
        $scope.issues = resp.data;
        
    },function(resp){});
    
    $scope.provincias=[
        { id:46,nombre:"valencia",numlenguas:2 },
        { id:47,nombre:"castellon",numlenguas:3 },
        { id:48,nombre:"alicante",numlenguas:1 }
    ];
    
  
  $scope.mensaje="Hola Mundo";
  
  $scope.alergia=false;
   $scope.casado=false;
  
  $scope.cambiar=function() {
  $scope.mensaje="ADIOS";
  };
  
  $scope.cambiar2=function() {
  $scope.mensaje="HOLALALALALA ADIOS";
  
  var palabras = $scope.country.split("/");
  
  //alert("Palabras :" + palabras[3]);
  
  $scope.carpeta=palabras[3];
      
 // alert("La carpeta es "+ $scope.carpeta);
  
  if ( $scope.country === "http://test.aquaclean.com/BE_fr/")
        $scope.titulo_entrar="BELGICA";
   else
      $scope.titulo_entrar="DIFERENT";
  };
  
  
  $scope.cambiarSelect=function() {
  $scope.mensaje="ADIOS";
  };
  
  
  $scope.ordenar=function() {
  $scope.campoAOrdenar="id";
  };
  
  
  $scope.numhijos=0;
  $scope.calcular=function() {
  $scope.importe=1000+100*$scope.numhijos;
  
  if ($scope.funcionario)
      $scope.importe-=100;
  
  return $scope.importe;
  };
   
  $scope.limpiar=function() {
  $scope.importe=0;
  $scope.funcionario=false;
  
  };
  
  
  
}

app.controller("PruebaController",PruebaController);
