<?php
namespace DevSys;
use DevSys\Funciones as DsFunciones;

class Connection
{		
 	public $conn;
	private static $instance;

    public static function getInstance()
    {
		$dataBase = 1;
    	
    	$dbParams = array(
			"type" => "pdo_mysql",
			"username" => 'root',
			"password" => '',
			"host" => 'localhost',
			"db" => "productos"
		);

    	if(!$dbParams)
    	{
    		DsFunciones::setLogError("Base de datos inválida");
    		return false;    		
    	}

		$dbType = $dbParams["type"];				
		if(!extension_loaded($dbType))
		{
			DsFunciones::setLogError("La librería no está cargada", $dbType);
			return null;
		}				

		$dbUsername = $dbParams["username"];				
		$dbPassword = $dbParams["password"];				
		$dbCadena = "mysql:host=".$dbParams["host"].";dbname=".$dbParams["db"];
		$options = array(\PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES  'UTF8'");

    	if (!isset(self::$instance[$dataBase]))
		{
		    self::$instance[$dataBase] = new Connection;		
			try 
			{
				self::$instance[$dataBase]->conn = new \PDO($dbCadena,$dbUsername,$dbPassword, $options);
				self::$instance[$dataBase]->conn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION); 	

			}
			catch (PDOException $e)
			{
				DsFunciones::setLogError("Existe un error al hacer la conexión a la base", $e->getMessage());
				return null;
			}		
		}

		 return self::$instance[$dataBase];
    }

	public function getConnection() {
		return $this->conn;
	}
}
?>