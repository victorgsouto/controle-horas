<?php

  include_once("conexao.php");

  $user=json_decode(file_get_contents('php://input'));

  session_start();

  //$sql = "SELECT * FROM cartao_ponto WHERE login = '".$_SESSION['uilogin']."' ";

  $sql = "SELECT 
          YEAR(DATA),
          MONTH(DATA),
          COUNT(DATA),
          SEC_TO_TIME( SUM( TIME_TO_SEC( hora_trabalhada ) ) ),
          SEC_TO_TIME( SUM( TIME_TO_SEC( hora_extra ) ) ) ,
          SEC_TO_TIME( SUM( TIME_TO_SEC( hora_pagar ) ) )
          FROM cartao_ponto WHERE login = '".$_SESSION['uilogin']."' GROUP BY MONTH(DATA) ORDER BY DATA DESC";


  $result = $conexao->query($sql);


  if ($result->num_rows > 0) { 

      $cont = 0;     

      while($row = $result->fetch_array()) {

        for ($i=0; $i < $result->field_count; $i++) { 
          $arr[$cont][] = $row[$i];
        }
        

        $cont++;
      }
  } else {
    echo "0 results";
  }  

  echo json_encode($arr);
  
  $conexao->close();