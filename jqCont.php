<?php
namespace DevSys;

use DevSys\Funciones as DsFunciones;
error_reporting(E_ALL);
date_default_timezone_set('America/Mexico_City');

spl_autoload_register(
	function($name)
	{
		if(strpos($name, "DevSys") !== false)
		{
			$name = explode("\\", $name);
    		$name = $name[1];
			include_once "Assets/$name.php";
		} else {
			include_once "Assets/Clases/$name.php";
		}
	}
);

$debug = DsFunciones::getGVariable("debug");

$mc = new jqCont;
$mainData = $mc->getData();

/**
 *
 * Clase encargada de administrar las llamadas a clases por medio de jquery
 * Se cargan todos los objetos nuevamente
 *
 */

class JqCont
{
    //Constructor de la clase
    function __construct ()
    {
        $this->className = "jqCont";
    }

    public static function getData()
    {
        $encrypt = DsFunciones::getPVariable("encrypt");
        
        //La clase a la que nos dirigimos
        $clase = DsFunciones::getPVariable("class");
        
        //Verificamos si existe físicamente, sino mandamos error al log
        if(file_exists("Assets/Controladores/".$clase.".php"))
        {
            include_once("Assets/Controladores/".$clase.".php");
            $moduleData = new $clase;
            $data = $moduleData->getData();
            echo $data;
        }
        //Si no existe fisicamente, mandamos error pero solo por medio del log
        else
        {
            DsFunciones::setLogError("No existe el controlador solicitado", __CLASS__. ":: $clase");
            return json_encode(array("status" => "false",  "message" => "No existe la clase solicitada $clase", "type" => "error"));
        }
    }
}

?>