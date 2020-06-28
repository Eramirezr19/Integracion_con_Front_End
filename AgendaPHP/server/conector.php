<?php


  class ConectorBD
  {
    //variables para ingreso a base de datos phpmyadmin
    private $host;
    private $user;
    private $password;
    private $conexion;


    //constructor para usar conector de base de datos
    function __construct($host, $user, $password){
      $this->host = $host;
      $this->user = $user;
      $this->password = $password;
    }
    //función para inicio de conexión
    function initConexion($nombre_db){
      $this->conexion = new mysqli($this->host, $this->user, $this->password, $nombre_db);
      if ($this->conexion->connect_error) {
        return "Error:" . $this->conexion->connect_error;
      }else {
        return "OK";
      }
    }
    //funcion para chequear datos de usuario
    function datosUsuario($email){
      $sql="SELECT * FROM usuarios WHERE correo='".$email."'";
      return $this->ejecutarQuery($sql);
    }



    //función para creación de nueva tabla, se indica la misma y los campos correspondientes
    function newTable($nombre_tbl, $campos){
      $sql = 'CREATE TABLE '.$nombre_tbl.' (';
      $length_array = count($campos);
      $i = 1;
      foreach ($campos as $key => $value) {
        $sql .= $key.' '.$value;
        if ($i!= $length_array) {
          $sql .= ', ';
        }else {
          $sql .= ');';
        }
        $i++;
      }
      //ejecuta el sql query en base de datos
      return $this->ejecutarQuery($sql);
    }
    //función definida para ejecutar querys en base de datos
    function ejecutarQuery($query){
      return $this->conexion->query($query);
    }
    //función definida para cerrar la conexión
    function cerrarConexion(){
      $this->conexion->close();
    }
    //función para definir las restricciones en las tablas ADD PRIMARY KEY, por ejemplo
    function nuevaRestriccion($tabla, $restriccion){
      $sql = 'ALTER TABLE '.$tabla.' '.$restriccion;
      return $this->ejecutarQuery($sql);
    }
    //función para crear las relaciones con llaves foráneas de tabla a tabla y de campo a campo
    function nuevaRelacion($from_tbl, $to_tbl, $from_field, $to_field){
      $sql = 'ALTER TABLE '.$from_tbl.' ADD FOREIGN KEY ('.$from_field.') REFERENCES '.$to_tbl.'('.$to_field.');';
      return $this->ejecutarQuery($sql);
    }
    //función para insertar valores en las tablas
    function insertData($tabla, $data){
      $sql = 'INSERT INTO '.$tabla.' (';
      $i = 1;
      foreach ($data as $key => $value) {
        $sql .= $key;
        if ($i<count($data)) {
          $sql .= ', ';
        }else $sql .= ')';
        $i++;
      }
      $sql .= ' VALUES (';
      $i = 1;
      foreach ($data as $key => $value) {
        $sql .= $value;
        if ($i<count($data)) {
          $sql .= ', ';
        }else $sql .= ');';
        $i++;
      }
      return $this->ejecutarQuery($sql);

    }
    //función para conectarse al servidor
    function getConexion(){
      return $this->conexion;
    }
    //función para actualizar registros
    function actualizarRegistro($tabla, $data, $condicion){
      $sql = 'UPDATE '.$tabla.' SET ';
      $i=1;
      foreach ($data as $key => $value) {
        $sql .= $key.'='.$value;
        if ($i<sizeof($data)) {
          $sql .= ', ';
        }else $sql .= ' WHERE '.$condicion.';';
        $i++;
      }
      return $this->ejecutarQuery($sql);
    }
    //función para eliminar registros en tablas
    function eliminarRegistro($tabla, $condicion){
      $sql = "DELETE FROM ".$tabla." WHERE ".$condicion.";";
      return $this->ejecutarQuery($sql);
    }
    //Función para consultas en tablas
    function consultar($tablas, $campos, $condicion = ""){
      $sql = "SELECT ";
      $a = array_keys($campos);
      $ultima_key = end($a);
      foreach ($campos as $key => $value) {
        $sql .= $value;
        if ($key!=$ultima_key) {
          $sql.=", ";
        }else $sql .=" FROM ";
      }

      $b = array_keys($tablas);
      $ultima_key = end($b);
      foreach ($tablas as $key => $value) {
        $sql .= $value;
        if ($key!=$ultima_key) {
          $sql.=", ";
        }else $sql .= " ";
      }

      if ($condicion == "") {
        $sql .= ";";
      }else {
        $sql .= $condicion.";";
      }
      return $this->ejecutarQuery($sql);
    }

    
    



  }





 ?>
