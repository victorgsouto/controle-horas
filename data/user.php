<?php 
  
  $conexao = new mysqli('localhost', 'root', '', 'cartao_ponto');

  if ($conexao->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  } 

  //recebe valores do js e transforma em objeto
  $user=json_decode(file_get_contents('php://input'));


  $sql = "SELECT login, pswd FROM sec_users Where login = '$user->mail' and pswd = md5('$user->pass')";

  $result = $conexao->query($sql);


  if ($result->num_rows > 0) { 

        session_start();
        $_SESSION['uid']=uniqid('ang_');
        $_SESSION['uilogin'] = $user->mail;

        echo $_SESSION['uid'];

  } else {
    echo "Usuário Inválido";
  }
 
  $conexao->close();

 
?>