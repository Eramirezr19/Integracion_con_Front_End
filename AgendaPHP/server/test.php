<?php

include('conector.php');

$datos = array(
'nombre' => 'Esteban',
'apellido' => 'Ramirez',
'email' => 'eramirez@gmail.com',
'psw' => password_hash("123456", PASSWORD_DEFAULT),
'fecha_nacimiento' => '1975-11-10');


  
  
$con = new ConectorBD('localhost','root','');
  $response['conexion'] = $con->initConexion('agendaphp_db');
  echo $response;

  if ($response['conexion']=='OK') {
    if($con->insertData('users', $data)){
      $response['msg']="Se ha registrado exitosamente";
    }else {
      $response['msg']= "Hubo un error y los datos no han sido cargados";
    }
  }else {
    $response['msg']= "No se pudo conectar a la base de datos";
  }

  echo json_encode($response);




 ?>
