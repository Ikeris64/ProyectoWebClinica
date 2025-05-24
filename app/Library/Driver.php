<?php

class Driver{

    function __construct(){}

    public function model($model = ""){
        require_once("../app/Models/" . $model . ".php");
        return new $model();
    }

    public function view($view="", $data = []){
        if (file_exists("../app/views/" . $view . ".php")) {
            require_once("../app/views/" . $view . ".php");
        } else {
            die("Error: No existe la vista " . $view);
        }
    }
    
}