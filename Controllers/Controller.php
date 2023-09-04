<?php
class Controlador{
    public $commandString='powershell.exe -ExecutionPolicy Bypass -NoProfile -Command "Set-Location \'C:\\xampp\\htdocs\\ScriptPhpWebscrapper\\WebscrapperOvh\'; webscrapp-moi\Scripts\activate; python -m pip install --trusted-host pypi.org --trusted-host pypi.python.org --trusted-host files.pythonhosted.org pip setuptools >> output.txt ;python -m pip install -r requirements.txt >> output.txt;"';

    function __construct(){}

    public function executeCommandGroup(){
        $output = shell_exec("$this->commandString 2>&1"); // Capture both standard output (1) and error output (2)
        $textoInstalacion=file_get_contents("../WebscrapperOvh/output.txt");
        file_put_contents("../WebscrapperOvh/installed.flag","1");
        return $textoInstalacion;
    }

}
?>
