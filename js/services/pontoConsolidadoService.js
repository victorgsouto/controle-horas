'use strict';

app.service("pontoConsolidadoService", function ($http, $location, sessionService) {
  this.getSobre = function () {
    return $http.get('data/lista_ponto_consolidado.php');
  };
});