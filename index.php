<?php
set_time_limit(5000);
require_once "../ScriptPhpWebscrapper/Routers/Router.php";
class ModelView{
    public $controladorInstancia;

    public function __construct()
    {
       $this->controladorInstancia=new Router();
    }

    public function executeRouter(){
        $this->controladorInstancia->redirectToController();
    }
}

$modelPrint=new ModelView();
$modelPrint->executeRouter();
