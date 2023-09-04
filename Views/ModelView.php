<?php
require_once "../Controllers/Controller.php";
class ModelView{
    public $controladorInstancia;

    public function __construct()
    {
       $this->controladorInstancia=new Controlador(); 
    }

    public function returnInputCommandsFormatted(){
        $textoAFormatear=$this->controladorInstancia->executeCommandGroup();
        $textoAFormatear="<pre>".$textoAFormatear."</pre>";
        echo $textoAFormatear;
    }

    public function verifyInstallation(){
        $contentsOfTheFile=file_get_contents("../WebscrapperOvh/installed.flag");
        if($contentsOfTheFile=="1" || $contentsOfTheFile==1){
            echo "Los modulos de pip han sido instalados";
        }
    }

    public function runFile(){
        
    }
}

$modelPrint=new ModelView();
$modelPrint->returnInputCommandsFormatted();

?>