'use strict';
var getPontos;

app.factory('novaSenhaService',function($http, $location, sessionService){
	return{	

		resetar: function(data,scope){

			var $promise = $http.post('data/nova_senha.php', data); 

			$promise.then(function(news){

				console.log(news);
								   
			});
		}
	}

});