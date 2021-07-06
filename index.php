<?php
namespace DevSys;

use DevSys\Funciones as DsFunciones;
error_reporting(E_ALL);
//ini_set('error_log','logs/logFile.log');
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

include_once 'main.php';
$pr = new Main;
$mainData = $pr->getPageData();

echo $mainData;

?>