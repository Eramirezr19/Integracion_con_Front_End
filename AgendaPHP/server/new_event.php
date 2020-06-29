<?php
  require_once('../server/conector.php');
  session_start();

  $titulo = $_POST['titulo'];
  $start_date=$_POST['start_date'];
  $end_date=$_POST['end_date'];
  $end_hour=$_POST['end_hour'];
  $start_hour=$_POST['start_hour'];

$con = new ConectorBD('localhost','root','');

 if($con-> initConexion('agendaphp_db')=='OK'){
     $data['user_id']="'".$_SESSION['user_id']."'";
     $data['titulo']="'".$titulo."'";
     $data['fecha_inicio']="'".$start_date."'";
     $data['fecha_final']="'".$end_date."'";
     $data['hora_inicio']="'".$start_hour."'";
     $data['hora_final']="'".$end_hour."'";

    if($con->insertData('eventos',$data)){
        $php_response = array("msg"=>"OK","data"=>"2");
    }else{
        $php_response=array("msg"=>"Error al registrar el evento","data"=>"2");
    }
    echo json_encode($php_response,JSON_FORCE_OBJECT);
    $con->cerrarConexion();

 } else{
     echo "No hubo conexión";
 }


 ?>
