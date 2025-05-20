<?php
/**
 * Login maneja el login de los usuarios
 * 
 */
class Login extends Control{

    private $model;
    function __construct()
    {
        $this->model = $this->model("LoginModel");
    }

    public function Portada()
    {
        $data = [];
        // Correct the view file name to match the actual file
        $this->view("loginview", $data);
    }

    
}