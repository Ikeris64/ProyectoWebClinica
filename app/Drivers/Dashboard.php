<?php
/**
 * 
 */

class Dashboard extends Driver{
    private $dashboardModel;

    function __construct(){
        $this->dashboardModel = $this->model("DashboardModel");
    }

    function Dashboard(){
        $session = new Session();
        if($session->getLogin()){

            $data = [
                "title" => "Bienvenido a tu Dashboard",
                "subtitle" => "Bienvenido a tu Dashboard",
                "menu" => true
            ];
            $this->view("dashboardStartView", $data);
        } else {
            header("Location:".ROUTE);
        }
    }
    public function logout(){
        session_start();
        if(isset($_SESSION['user'])) {
            $session = new Session();
            $session->endLogin();
        }
        header("Location:".ROUTE);
    }

    public function perfil(){
        $errors = [];
        if($_SERVER['REQUEST_METHOD'] == 'POST'){

        }
        // Lee datos del usuario
        session_start();
        if(isset($_SESSION['user'])){
            $data= $_SESSION['user'];
        } else {
            header("Location:".ROUTE);
        }
        $data = [
            "title" => "Perfil de Usuario",
            "subtitle" => "Perfil de Usuario",
            "menu" => true,
            "active" => "Perfil",
            "errors" => $errors,
            "data" => $data
        ];
        $this->view("dashboardPerfilView",$data);
    }
}
?>