<?php

  include_once("conexao.php");

  $user = json_decode(file_get_contents('php://input'));

  $sql = "SELECT login, pswd FROM sec_users Where login = 'victor' and pswd = md5('$user->oldpass')";

  $result = $conexao->query($sql);

  if(!$sql){
    return "ok"
  }

  die();
  
  $conexao->close();