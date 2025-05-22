<?php

class MySQL
{
    private $host="localhost";
    private $user="root";  
    private $password="";
    private $db="clínica internacional";
    private $puerto = "";
    private $conexion;

    function __construct()
    {
        $this->conexion  = mysqli_connect($this->host, 
        $this->user, 
        $this->password, 
        $this->db);

        if(mysqli_connect_errno()){
            print "Error de conexion a la base de datos";
            exit();
        }else{
            //print "Conexion exitosa a la base de datos<br>";
        }

        if(mysqli_set_charset($this->conexion, "utf8")){
           // print "La codificacion de caracteres es utf8<br>";
        }else{
            print "Error al establecer la codificacion de caracteres";
            exit();
        }
    }
    public function query($sql= "")
    {
        $data =[];
        $r = mysqli_query($this->conexion, $sql);
        if($r){
            if(mysqli_num_rows($r)>0){
                $data = mysqli_fetch_assoc($r);
            }
        }
        return $data;
    }

    public function queryNoSelect($sql){
        return mysqli_query($this->conexion, $sql);
    }
}
?>
