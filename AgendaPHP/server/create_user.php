<?php

include('conector.php');

  $data['nombre'] = "'".$_POST['nombre']."'";
  $data['apellido'] = "'".$_POST['apellido']."'";
  $data['email'] = "'".$_POST['email']."'";
  $data['psw'] = "'".password_hash($_POST['psw'], PASSWORD_DEFAULT)."'";
  $data['fecha_nacimiento'] = "'".$_POST['fecha_nacimiento']."'";

  
  
$con = new ConectorBD('localhost','root','');
  $response['conexion'] = $con->initConexion('agendaphp_db');
  

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
