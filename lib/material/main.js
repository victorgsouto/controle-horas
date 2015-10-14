angular  
.module("myApp", ["satellizer"])
.config(function($authProvider) {
    // Parametros de configuración
    $authProvider.loginUrl = "http://api.com/auth/login";
    $authProvider.signupUrl = "http://api.com/auth/signup";
    $authProvider.tokenName = "token";
    $authProvider.tokenPrefix = "myApp",
});


  angular.module('MyApp')
    .controller('LoginCtrl', function($scope, $auth) {

      $scope.authenticate = function(provider) {
        $auth.authenticate(provider);
      };

    });