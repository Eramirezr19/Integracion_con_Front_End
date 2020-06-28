<?php

include('conector.php');

$data['email'] = "'".$_POST['email']."'";
$data['psw'] = "'".password_hash($_POST['psw'], PASSWORD_DEFAULT)."'";

  $con = new ConectorBD('localhost','root','');

  $response['conexion'] = $con->initConexion('agendaphp_db');

  if ($response['conexion']=='OK') {
    $resultado_consulta = $con->consultar(['users'],
    ['id', 'email','psw'], 'WHERE email="'.$_POST['email'].'"');

    if ($resultado_consulta->num_rows != 0) {
      $fila = $resultado_consulta->fetch_assoc();
      if (password_verify($_POST['psw'], $fila['psw'])) {
        $response['acceso'] = 'concedido';
        session_start();
        $_SESSION['user_id']=$fila['id'];
        $_SESSION['email']=$fila['email'];
      }else {
        $response['motivo'] = 'Contraseña incorrecta';
        $response['acceso'] = 'rechazado';
      }
    }else{
      $response['motivo'] = 'Email incorrecto';
      $response['acceso'] = 'rechazado';
    }
  }

  echo json_encode($response);

  $con->cerrarConexion();





 ?>
