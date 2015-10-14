'use strict';
var getPontos;

app.factory('loginService',function($http, $location, sessionService){
	return{	

		login: function(data,scope){

			var $promise=$http.post('data/user.php', data); 			

			$promise.then(function(msg){
				var uid=msg.data;
				if(uid){
					sessionService.set('uid',uid);
					$location.path('/home');
				}	       
				else{
					scope.msgtxt = 'Usuário Inválido';
					$location.path('/login');					
				}	
			});


			var $promise2 = $http.post('data/lista_ponto.php', data); 
			$promise2.then(function(news){

				getPontos = news.data;
								   
			});

		},


		logout: function(){
			sessionService.destroy('uid');
			$location.path('/login');
		},
		islogged: function(){
			var $checkSessionServer=$http.post('data/check_session.php');
			return $checkSessionServer;
		}
	}

});