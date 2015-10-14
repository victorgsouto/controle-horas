'use strict';
// Declare app level module which depends on filters, and services
var app= angular.module('myApp', ['ngRoute', 'infinite-scroll']);
app.config(['$routeProvider', function($routeProvider) {
  
  $routeProvider.when('/login', {templateUrl: 'partials/login.html', controller: 'loginCtrl'});
  $routeProvider.when('/home', {templateUrl: 'partials/home.html', controller: 'homeCtrl'});
  $routeProvider.when('/relatorio', {templateUrl: 'partials/relatorio.html', controller: 'relatorioCtrl'});
  $routeProvider.when('/relatorio-consolidado', {templateUrl: 'partials/relatorio_consolidado.html', controller: 'relatorioConsolidadoCtrl'});
  $routeProvider.when('/alterar-senha', {templateUrl: 'partials/alterar-senha.html', controller: 'alterarSenhaCtrl'});
  $routeProvider.otherwise({redirectTo: '/login'});

}]);


app.run(function($rootScope, $location, loginService){
	var routespermission= ['/home'];

	$rootScope.$on('$routeChangeStart', function(){
		if( routespermission.indexOf($location.path()) !=-1 )
		{
			var connected=loginService.islogged();
			connected.then(function(msg){
				if(!msg.data) $location.path('/login');
			});
		}
	});

});