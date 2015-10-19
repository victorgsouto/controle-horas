'use strict';

app.controller('relatorioCtrl', ['$scope','loginService','pontoService', function ($scope,loginService, pontoService) {
  
  $scope.logout=function(){
    loginService.logout();
  }

  //$scope.pontos = getPontos;

  $scope.menosQue = function(item){
    if(item < '08:00:00'){
      return 'danger';
    };
  };
  
  var ab;

  pontoService.getSobre().success(function (data) {
   
      $scope.pontos = data;
      //console.log(ab.length);

  });   

  //console.log(ab);

  //$scope.myPagingFunction = function(){
    //console.log("a"); 

    //var last = $scope.pontos[$scope.pontos.length - 1];

    //console.log($scope.pontos[0]);
    // for(var i = 1; i <= 8; i++) {
    //   $scope.pontos.push(last + i);
    // }
  //}; 

}]);




// app.controller('relatorioCtrl', function($scope, Reddit) {
//   $scope.reddit = new Reddit();
// });

// // Reddit constructor function to encapsulate HTTP and pagination logic
// app.factory('Reddit', function($http) {
//   var Reddit = function() {
//     this.items = [];
//     this.busy = false;
//     this.after = '';
//   };

//   Reddit.prototype.nextPage = function() {
//     if (this.busy) return;
//     this.busy = true;


//     var url = "http://api.reddit.com/hot?after=" + this.after + "&jsonp=JSON_CALLBACK";

//     $http.jsonp(url).success(function(data) {
//       var items = data.data.children;
//       for (var i = 0; i < items.length; i++) {
//         this.items.push(items[i].data);
//       }
//       this.after = "t3_" + this.items[this.items.length - 1].id;
//       this.busy = false;
//     }.bind(this));

//   };


//   return Reddit;
// });