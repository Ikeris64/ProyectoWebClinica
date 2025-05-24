<?php
//Login maneja el login de los usuarios
class LoginModel{

    function __construct()
    {
        $this->db = new MySQL();
    }

    public function validarCorreo($email)
    {
        $sql = "SELECT * FROM admin  WHERE correo = '".$email."'";
        $data = $this->db->query($sql);
        return (count ($data)==0) ?false:true;
    }

    public function enviarCorreo($email="")
    {
        $data = [];
        if ($email == ""){
            return false;
        } else {
            $data = $this->getUsuarioCorreo($email);
            if (!empty($data)) {
                $id = Helper :: encrypt($data["id"]);
                
                $nombre = $data["nombre"];
                //
                $msg = $nombre . " hemos recibido una solicitud para restablecer tu contraseña. \n";
                $msg .= "Para restablecer tu contraseña, haz clic en el siguiente enlace: \n";
                $msg .= "<a href='" . ROUTE . "Login/Restablecer/" . $id . "'>Restablecer contraseña</a>";
                


                var_dump($msg);
                exit(9);

                $headers = "Mime-Version: 1.0" . "\r\n";
                $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                $headers .= "From: <".$email.">" . "\r\n";
                $headers .= "Reply-To: <".$email.">" . "\r\n";

                $asunto = "Restablecer contraseña";
                
                return @mail($email, $asunto, $msg, $headers);
                
            } else {
                return false;
            }
            
            }
        }
    public function getUsuarioCorreo($email)
    {
        $sql = "SELECT * FROM admin WHERE Correo = '".$email."'";
        $data = $this->db->query($sql);
        return $data;
    
    }

    public function cambiarPassword($id,$password)
    {
        $r = false;
        $password = hash_hmac("sha256", $password,KEY );
        $sql = "UPDATE admin SET ";
        $sql .= "contraseña = '".$password."' ";
        $sql .= "WHERE id = '".$id."' ";
        $r = $this->db->queryNoSelect($sql);
        return $r;
    }

    public function validar($user,$password){
        $errors = array();
        $sql = "SELECT * FROM admin WHERE correo = '".$user."'";
        $password = hash_hmac("sha256", $password,KEY );
        $password = substr($password, 0, 200);
        //consulta si existe el usuario
        $data = $this->db->query($sql);
        //validamos si existe el usuario
        if(empty($data)){
            array_push($errors, "El usuario no existe");
        }else if($password !=$data["contraseña"]){
            array_push($errors, "La contraseña es incorrecta");
            }
            return $errors;
        }
        
    }
