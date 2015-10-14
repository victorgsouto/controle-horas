'use strict';
app.controller('homeCtrl', function($scope, loginService, marcarPontoService, $location){  

    $scope.logout=function(){
      loginService.logout();
    }

    $scope.marcarPonto = function (enviaHora) {
      
      marcarPontoService.savePonto(enviaHora).success(function (data) {
          
        //console.log(data);
        if(data = 'ok'){
          $location.path("/relatorio");
        }

        $location.path("/relatorio");

      });
    };

});

