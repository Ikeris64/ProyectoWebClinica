<?php
//Login maneja el login de los usuarios
class LoginModel{

    function __construct()
    {
        $this->db = new MySQL();
    }
}