<?php

session_start();

include('conector.php');

$id = $_POST['id'];

$con = new ConectorBD('localhost','root','');

if($con->initConexion('agendaphp_db')=='OK'){
    $data['user_id']="'".$_SESSION['user_id']."'";

    $condicion = 'id="'.$id.'"';

    if($con->eliminarRegistro('eventos',$condicion)){
        $php_response= array("msg"=>'OK',"data"=>"2");
}else{
    $php_response=array("msg"=>"Error al eliminar el evento","data"=>"2");
}
echo json_encode($php_response,JSON_FORCE_OBJECT);
$con-> cerrarConexion();


}else{
    echo "No hubo conexión";
}

 ?>
