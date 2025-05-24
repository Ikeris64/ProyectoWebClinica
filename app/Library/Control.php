<?php
/**
 * Control maneja y lanza procesos
 * primer parametro: controlador
 * segundo parametro: metodo
 * tercer parametro: parametros
 */
class Control extends Driver
{
    private $driver = "Login";
    private $method = "Dashboard";
    private $param = [1, 2, 3, 4, 5, 6];

    function __construct()
    {
        $url = $this->separarURL();
        if ($url != "" && file_exists("../app/drivers/" . ucwords($url[0]) . ".php")) {
            $this->driver = ucwords($url[0]);
            unset($url[0]);
        }
        // Comprobamos si existe el controlador
        require_once("../app/drivers/" . $this->driver . ".php");
        // Creamos la instancia
        $this->driver = new $this->driver;
        // Comprobamos si existe el metodo
        if (isset($url[1])) {
            if (method_exists($this->driver, $url[1])) {
                $this->method = $url[1];
                unset($url[1]);
            }
        }
        // Parametros
        $this->param = $url? array_values($url) : [];
        
        call_user_func_array([$this->driver, $this->method], $this->param);
    }

    public function separarURL()
    {
        $url = "";
        if (isset($_GET['url'])) {
            // Eliminamos caracteres finales y sanitizamos correctamente
            $url = rtrim($_GET['url'], "/\\");
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode("/", $url);
        }
        return $url;
    }
}
