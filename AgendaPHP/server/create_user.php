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


    $resultado_consulta = $con->consultar(['users'],
    ['id', 'email','psw'], 'WHERE email="'.$_POST['email'].'"');

    if ($resultado_consulta->num_rows != 0) {
        $response['msg']= 'El usuario ya existe. Use index.html';
      
      }else {
       
        if($con->insertData('users', $data)){
          $response['msg']="Se ha registrado exitosamente";
        }else {
          $response['msg']= "Hubo un error y los datos no han sido cargados";
        }
      }
        



      }
    

    

  echo json_encode($response);

  $con->cerrarConexion();


 ?>
