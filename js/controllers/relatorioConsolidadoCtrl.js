'use strict';

app.controller('relatorioConsolidadoCtrl', ['$scope','loginService','pontoConsolidadoService', function ($scope,loginService, pontoConsolidadoService) {
  
  $scope.logout=function(){
    loginService.logout();
  }

  $scope.pontos = getPontos;

  
  pontoConsolidadoService.getSobre().success(function (data) {
   
      $scope.pontos = data;

  });   

  


 

}]);