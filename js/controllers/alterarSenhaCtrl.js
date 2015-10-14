'use strict';

app.controller('alterarSenhaCtrl', ['$scope','loginService','novaSenhaService', function ($scope,loginService, novaSenhaService) {
  
  $scope.logout=function(){
    loginService.logout();
  }

  $scope.newPass=function(data){
    

    novaSenhaService.resetar(data, $scope); 

  };

 

}]);