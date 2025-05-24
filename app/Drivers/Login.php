<?php
/**
 * Login maneja el login de los usuarios
 * 
 */
class Login extends Control{

    private $loginModel;

    function __construct()
    {
        $this->loginModel = $this->model("LoginModel");
    }

    public function Dashboard()
    {
        if (isset($_COOKIE["data"])) {
            $data = Helper::decrypt($_COOKIE["data"]);
            $data_array = explode("|", $data);
            $user = $data_array[0];
            $password = $data_array[1];
            $data = [
                "user" => $user,
                "password" => $password,
                "recordar" => "ON"
            ];
        } else {
            $data = [];
        }
        $data = [
            "title" => "Login",
            "subtitle" => "Inicio de Sesion",
            "data" => $data,
        ];
        $this->view("loginview", $data);
    }

    public function loginForgot()
    {   
        // Inicializa el modelo si no está inicializado o si no es un objeto
        if (!is_object($this->loginModel)) {
            $this->loginModel = $this->model("LoginModel");
        }

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
            //Si no hay errores
            if (empty($errors)) {
                if ($this->loginModel->validarCorreo($EMAIL)) {
                    if ($this->loginModel->enviarCorreo($EMAIL)) {
                        $data = [
                        "title" => "Cambio de contraseña",
                        "menu" => false,
                        "errors" => [],
                        "data" => [],
                        "subtitle" => "Cambio de contraseña",
                        "text" => "Hemos enviado un correo a la dirección proporcionada. Por favor, revisa tu bandeja de entrada y sigue las instrucciones para restablecer tu contraseña.",
                        "color" => "warning",
                        "url" => "login",
                        "buttonColor" => "btn-secondary",
                        "buttonText" => "Atrás",
                        ];
                        $this->view("messageView", $data);
                        return;
                    } else {
                        array_push($errors, "El correo no fue enviado");
                    }
                    
                    
                } else {
                    //Enviamos el correo
                    array_push($errors, "El correo no existe");
                    $this->loginModel->validarCorreo($EMAIL);
                }
            }
        }
        if (!empty($errors)) {
            $data = [
            "title" => "Olvido de Contraseña",
            "subtitle" => "Olvidaste tu contraseña?",
            "errors" => $errors,
            "data" => []
        ];
        
        }
        $data = [
            "title" => "Olvido de Contraseña",
            "subtitle" => "Olvidaste tu contraseña?",
            "errors" => $errors,
            "data" => []
        ];
        $this->view("loginForgot", $data);
        
    }
    function Restablecer($id="")
    {
        $errors = [];
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $id = isset($_POST["id"]) ? $_POST["id"] : "";
            $password1 = isset($_POST["nueva_contrasena"]) ? $_POST["nueva_contrasena"] : "";
            $password2 = isset($_POST["repite_nueva_contrasena"]) ? $_POST["repite_nueva_contrasena"] : "";
            //validacion de datos
            if ($password1== "") {
                array_push($errors, "La contraseña no puede estar vacia");
            }
            if($password2== "") {
                array_push($errors, "La contraseña no puede estar vacia");
            }
            if ($password1 != $password2) {
                array_push($errors, "Las contraseñas no coinciden");
            }
            if(count($errors)){
                $data=[
                    "title" => "Cambio de Contraseña",
                    "subtitle" => "Nueva Contraseña",
                    "errors" => $errors,
                    "data" =>$id
                ];
                $this->view("loginRestablecer", $data);
            } else {
                //No hay errores
                if ($this->loginModel->cambiarPassword($id, $password1)){
                    $data = [
                        "title" => "Cambio de contraseña",
                        "menu" => false,
                        "errors" => [],
                        "data" => $id,
                        "subtitle" => "Cambio de contraseña",
                        "text" => "La contraseña ha sido cambiada con exito.",
                        "color" => "success",
                        "url" => "login",
                        "buttonColor" => "btn-secondary",
                        "buttonText" => "Atrás",
                    ];
                    $this->view("messageView", $data);    
                    } else {
                        $data = [
                            "title" => "Cambio de contraseña",
                            "menu" => false,
                            "errors" => [],
                            "data" => [],
                            "subtitle" => "Cambio de contraseña",
                            "text" => "No se pudo cambiar la contraseña.",
                            "color" => "danger",
                            "url" => "login",
                            "buttonColor" => "btn-secondary",
                            "buttonText" => "Atrás",
                        ];
                        $this->view("messageView", $data);
                    }
            }
            
        } else {
            $id= Helper::decrypt($id);
            var_dump($id);
                exit();
            $data = [
            "title" => "Cambio de Contraseña",
            "subtitle" => "Nueva Contraseña",
            "errors" => $errors,
            "data" =>$id
            ];
        $this->view("loginRestablecer", $data);
        
        }
    }

    public function validar(){
        $errors = [];
        if ($_SERVER['REQUEST_METHOD']== "POST"){
            $user = $_POST["usuario"] ?? "";
            $password = $_POST["Contraseña"] ?? "";
            $recordar = isset($_POST["recordar"])?"ON":"OFF";
            $errors = $this->loginModel->validar($user, $password);
            
            //Recuerdo de usuario
            $valor = $user."|".$password;
            $valor = Helper::encrypt($valor);
            if ($recordar == "ON") {
                $fecha = time() + (60 * 60 * 24 * 7); // 7 días
                
            } else {
                $fecha = time() -1;
            }
            setcookie("data", $valor, $fecha, ROUTE);

            //Validación
            if(empty($errors)){
                // inicio de sesión
                $data = $this->loginModel->getUsuarioCorreo($user);
                $session = new Session();
                $session->startLogin($data);

                header("Location: ".ROUTE."Dashboard");
            } else {
                $data = [
                    "title" => "Login",
                    "subtitle" => "Inicio de Sesion",
                    "menu" => false,
                    "errors" => $errors,
                ];
                $this->view("loginview", $data);
            }
        }
    }
}