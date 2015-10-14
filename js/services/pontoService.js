'use strict';

app.service("pontoService", function ($http, $location, sessionService) {
  this.getSobre = function () {
    return $http.get('data/lista_ponto.php');
  };
});