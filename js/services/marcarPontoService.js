'use strict';

app.service("marcarPontoService", function ($http, $location, sessionService) {

  var _savePonto = function (ponto) {
    
    return $http.post('data/marcar_ponto.php', ponto);
  };

  return {
    savePonto: _savePonto
  };
 
});