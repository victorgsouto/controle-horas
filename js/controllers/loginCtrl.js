'use strict';
var saveLogin;

app.controller('loginCtrl', ['$scope','loginService', function ($scope,loginService) {
	
  $scope.msgtxt='';

  $scope.login=function(data){
    
		loginService.login(data, $scope); 

    saveLogin = data.mail;

	};



 

}]);