<?php
/**
 * Session maneja las sesiones de usuario
 */

class Session{
    private $login = false;
    private $user;

    function __construct(){
        session_start();
        if(isset($_SESSION["user"])){
            $this->user = $_SESSION["user"];
            $this->login = true;
        } else {
            unset($this->user);
            $this->login = false;
        }
    }
    public function startLogin($user){
        if($user){
            $this->user = $_SESSION["user"] = $user;
            $this->login = true;
        }
    }

    public function endLogin(){
        unset($_SESSION["user"]);
        unset($this->user);
        $this->login = false;
        session_destroy();
    }

    public function getLogin(){
        return $this->login;
    }

    public function getUser(){
        return $this->user;
    }
}
?>