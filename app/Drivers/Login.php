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
        $data = [
            "title" => "Login",
            "subtitle" => "Inicio de Sesion",
        ];
        $this->view("loginview", $data);
    }

    public function loginForgot()
    {   
        $errors = [];
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            //Recepcion de datos
            $EMAIL = $_POST["Correo"] ?? "";
            //validacion de datos
            if ($EMAIL == "") {
                array_push($errors, "El correo no puede estar vacio");
            }
            if (!filter_var($EMAIL, FILTER_VALIDATE_EMAIL)) {
                array_push($errors, "El correo no es válido");
            }
            //Proceso
            var_dump($errors);
            // Siempre muestra la vista después de la validación
            $data = [
                "title" => "Olvido de Contraseña",
                "subtitle" => "Olvidaste tu contraseña?",
                "errors" => $errors,
                "data" => []
            ];
            $this->view("loginForgot", $data);
        } else {
            $data = [
                "title" => "Olvido de Contraseña",
                "subtitle" => "Olvidaste tu contraseña?",
                "errors" => $errors,
                "data" => []
            ];
            $this->view("loginForgot", $data);
        }
    }
}