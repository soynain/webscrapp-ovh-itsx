<?php
class Controlador
{
    public $commandString = 'powershell.exe -ExecutionPolicy Bypass -NoProfile -Command "Set-Location \'C:\\xampp\\htdocs\\ScriptPhpWebscrapper\\WebscrapperOvh\'; webscrapp-moi\Scripts\activate; python -m pip install --trusted-host pypi.org --trusted-host pypi.python.org --trusted-host files.pythonhosted.org pip setuptools >> output.txt ;python -m pip install -r requirements.txt >> output.txt; pyinstaller --onefile main.py >> output.txt 2>&1;"';

    //public $commandString2='powershell.exe -ExecutionPolicy Bypass -NoProfile -Command ""';
    function __construct()
    {
    }

    public function install()
    {
        $output = shell_exec("$this->commandString 2>&1"); // Capture both standard output (1) and error output (2)
        $textoInstalacion = file_get_contents("./WebscrapperOvh/output.txt");
        file_put_contents("./WebscrapperOvh/installed.flag", "1");
        file_put_contents("./WebscrapperOvh/startFromPhp.bat", "@echo off\n\"C:\\xampp\\htdocs\\ScriptPhpWebscrapper\\WebscrapperOvh\\dist\\main.exe\"");
        echo "<pre>" . $textoInstalacion . "</pre>";
    }

    public function check_install()
    {
        if (file_exists("./WebscrapperOvh/installed.flag")) {
            $banderaInstalacion = file_get_contents("./WebscrapperOvh/installed.flag");
            //echo "YA ENTRAMOS DENTRO DE LA CONDICIONAL ".gettype($banderaInstalacion);
            if ($banderaInstalacion === "1") {
                echo "EJECUTABLE YA GENERADO";
            } else {
                echo "NO TIENE CONTENIDO EL ARCHIVO";
            }
        } else {
            echo "EJECUTABLE NO HA SIDO GENERADO AUN";
        }
    }


    public function run()
    {
        if (file_exists(realpath("./WebscrapperOvh/startFromPhp.bat"))) {
            $descriptorspec = array(
                0 => ['pipe', 'r'],  // stdin is a pipe that the child process will read from
                1 => ['pipe', 'w'],  // stdout is a pipe that the child process will write to
                2 => ['pipe', 'w'],  // stderr is a pipe that the child process will write to
            );

            $comando = 'powershell.exe -ExecutionPolicy Bypass -NoProfile -NoLogo -Command "Set-Location \'C:\\xampp\\htdocs\\ScriptPhpWebscrapper\\WebscrapperOvh\';Start-Process -FilePath \'C:\\xampp\\htdocs\\ScriptPhpWebscrapper\\WebscrapperOvh\\startFromPhp.bat\'" -NoNewWindow >> outputWebscrapp.txt outputWebscrapp.txt 2>&1;"';

            $process = proc_open($comando, $descriptorspec, $pipes);

            if (is_resource($process)) {
                // Close the stdin, stdout, and stderr pipes since we don't need them
                fclose($pipes[0]);
                fclose($pipes[1]);
                fclose($pipes[2]);

                // Do not wait for the process to finish; it will run independently
                proc_close($process);

                echo 'Batch file started successfully.';
            }
        } else {
            echo "NO PUEDES EJECUTAR EL ARCHIVO BAT";
        }
    }
}
