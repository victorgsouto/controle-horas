<?php
  date_default_timezone_set('America/Sao_Paulo');

  $conexao = new mysqli('localhost', 'root', '', 'cartao_ponto');

  if ($conexao->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  } 

  $user=json_decode(file_get_contents('php://input'));

  session_start();

  $obs = $user->obs;

  if(empty($obs)){
    $obs = '';
  }

  $sql = "select hora_chegada, inicio_intervalo, retorno_intervalo, hora_saida from cartao_ponto
            where data = CURRENT_DATE() and login = '".$_SESSION['uilogin']."'";
  
  $result = $conexao->query($sql);


  $row=mysqli_fetch_array($result,MYSQLI_NUM);
   
  if(empty($row[0])){
    $sql_hora = "INSERT INTO cartao_ponto (login, data, hora_chegada, obs) 
                 VALUES ('".$_SESSION['uilogin']."', CURRENT_DATE(), DATE_FORMAT(NOW(), '%H:%i:%s'), '$user->obs')";
    $conexao->query($sql_hora);

    echo "-- 0 --";
  }
  else {
    if(empty($row[1])){
      $sql_hora = "UPDATE cartao_ponto SET inicio_intervalo = DATE_FORMAT(NOW(), '%H:%i:%s'), obs = '$user->obs'
                   WHERE login = '".$_SESSION['uilogin']."' AND DATA = CURRENT_DATE()";
      $conexao->query($sql_hora);

      echo "-- 1 --";
    }  
    else {
      if(empty($row[2])){
        $sql_hora = "UPDATE cartao_ponto SET retorno_intervalo = DATE_FORMAT(NOW(), '%H:%i:%s'), obs = '$user->obs'
                     WHERE login = '".$_SESSION['uilogin']."' AND DATA = CURRENT_DATE()";
        $conexao->query($sql_hora);

        echo "-- 2 --";
      }
      else {
        if(empty($row[3])){

          $sql_hora = "UPDATE cartao_ponto SET hora_saida = DATE_FORMAT(NOW(), '%H:%i:%s'), obs = '$user->obs'
                       WHERE login = '".$_SESSION['uilogin']."' AND DATA = CURRENT_DATE()";

          $conexao->query($sql_hora);          
          
          $hora_saida_novo = date('H:i:s');

          $horas_trabalhadas = M_diferenca_hora($row[0], $hora_saida_novo, $row[1], $row[2]);
          
          if(substr($horas_trabalhadas,0,2) >= '08'){

            echo "---------" . $row[0] .  "---------" . $row[1] . "---------" . $row[2] . "---------" . $hora_saida_novo ;

            $hora_extra = M_diferenca_hora('08:00:00', $horas_trabalhadas);
            $horas_pagar = '';

            
          } else {
            $hora_extra = '';                
            $horas_pagar = M_diferenca_hora('08:00:00', $horas_trabalhadas);  
          }

         
          $sql_hora_rest = "UPDATE cartao_ponto SET 
                              hora_trabalhada = '$horas_trabalhadas', hora_extra = '$hora_extra',  hora_pagar = '$horas_pagar'
                            WHERE data = CURRENT_DATE() and login = '".$_SESSION['uilogin']."'";

          $conexao->query($sql_hora_rest);
              
          echo "-- 3 --";
        }       
        else {
          echo "ok";
        }
      }
    }
  }


  function M_diferenca_hora($hora_inicial, $hora_final="", $inicio_almoco="", $retorno_almoco=""){             
    
    $inicio = $hora_inicial;
    if(empty($hora_final)){
      $fim = date('H:i:s');
    }else{
      $fim = $hora_final; 
    }
    // Converte as duas datas para um objeto DateTime do PHP
    $inicio = DateTime::createFromFormat('H:i:s', $inicio);

    $fim = DateTime::createFromFormat('H:i:s', $fim);
    $intervalo = $inicio->diff($fim); //echo $intervalo->format('%H:%I:%S'); die(); // 09:00:00
    $intervalo = DateTime::createFromFormat('H:i:s', $intervalo->format('%H:%I:%S'));

    if(!empty($inicio_almoco)){
      $ini_intervalo = DateTime::createFromFormat('H:i:s', $inicio_almoco);
      $fim_intervalo = DateTime::createFromFormat('H:i:s', $retorno_almoco);
      $intervalo_almoco = $ini_intervalo->diff($fim_intervalo);  //echo $intervalo_almoco->format('%H:%I:%S'); die(); // 00:30:00              
      $intervalo_almoco = DateTime::createFromFormat('H:i:s', $intervalo_almoco->format('%H:%I:%S'));              
      $reset = $intervalo->diff($intervalo_almoco);
      $reset = DateTime::createFromFormat('H:i:s', $reset->format('%H:%I:%S'));              
      return $reset->format("H:i:s");
    }
    else{              
      return $intervalo->format("H:i:s");            
    }
   }
  

  $conexao->close();