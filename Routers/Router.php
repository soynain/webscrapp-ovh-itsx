<?php
require_once "./Controllers/Controller.php";
class Router{

    public $controllerInstancia;
    public function __construct(){}

    public function redirectToController(){
        $urlAnalizar=explode("/",$_SERVER['REQUEST_URI']);
        //$this->controllerInstancia->new Controlador();
        $this->controllerInstancia=new $urlAnalizar[2]();
        $metodoFinal=$urlAnalizar[3];
        $this->controllerInstancia->$metodoFinal();
       /*  echo "<pre>";
        print_r($_SERVER);
        echo "</pre>"; */
    }
}
?>


