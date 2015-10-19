<?php 
  
  if($_SERVER['SERVER_NAME'] == 'localhost'){
    $conexao = new mysqli('localhost', 'root', '', 'cartao_ponto');
  }
  else{
    $conexao = new mysqli('localhost', 'root', 'quali!@#tc2011', 'qualimedia_cartao_ponto');
  }
  

  if ($conexao->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  } 

  
?>