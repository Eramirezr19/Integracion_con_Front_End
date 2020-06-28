<?php
session_start();
include_once('conector.php');

$con = new ConectorBD('localhost','root','');
$respuesta['msg'] = $con->initConexion('agendaphp_db');

if ($respuesta['msg']== 'OK') {
    $consultaAgenda = $con->consultar(['eventos'],['eventos.*'],'INNER JOIN users ON users.id=eventos.user_id AND users.id ='.$_SESSION['user_id']);

    if($consultaAgenda->num_rows <=0){
        $respuesta['eventos'] = [];
    }else{
        $eventos = array();
        while($fila = $consultaAgenda->fetch_assoc() ){
            $evento = array(
                'id' =>$fila['id'],
                'user_id'=>$fila['user_id'],
                'tittle'=>$fila['titulo'],
                'start' =>$fila['fecha_inicio'].' '.$fila['hora_inicio'],
                'end' =>$fila['fecha_final'].' '.$fila['hora_final'],
                'allday'=>$fila['dia_completo']);
                array_push($eventos,$evento);
        }
        $respuesta['eventos'] = $eventos;
    }

}else{
    $respuesta['estado'] = "Error";
}

$con->cerrarConexion();
echo json_encode($respuesta);



 ?>
