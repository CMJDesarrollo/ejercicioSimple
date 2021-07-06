<?php

use DevSys\Funciones as DsFunciones;
use DevSys\Connection as DsConn;
use DevSys\SQL as DsSQL;

class ProdAdd {
    private $conn;
    private $className;

    //Constructor de la clase
    function __construct()
    {
        $this->className = __CLASS__;
        $this->conn = DsConn::getInstance()->conn;
    }

    /**
	 * Funcion principal de la clase, decide qu se ejecuta dependiendo de los parametros
	 */
	
	public  function getData()
	{
        $data = "";
        $umList = "";

        $data = file_get_contents('Vista/ProdAdd.html', true);

        $umList = self::getList();
        
        $data = preg_replace("/__OPT_UM__/", $umList, $data);

        return  $data;
    }

    public  function getTitle()
	{
        return 'Agregar producto';
    }

    /**
	 * Funcion para hacer el llenado de las unidades de medida
	 */
    private function getList()
    {
        $prodList = "";

        $consCat = "SELECT * FROM cat_um";
        $psCat = DsSQL::setSimpleQuery($this->conn, $consCat);
        $sqlResultsCat = DsSQL::executeSimpleQuery($psCat, null, $consCat);
        if ($sqlResultsCat){
            foreach($sqlResultsCat as $item)
            {
                $prodList .= "<option value='".$item['id_um']."'>".$item['descripcion']."</option>";
            }
        }

        return $prodList;
    }
}

?>