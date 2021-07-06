<?php

use DevSys\Funciones as DsFunciones;
use DevSys\Connection as DsConn;
use DevSys\SQL as DsSQL;

class ProdEdit {
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
        $id = DsFunciones::getGVariable('id');

        $vals = self::getValues($id);

        $data = file_get_contents('Vista/ProdEdit.html', true);

        $umList = self::getList($vals['um']);
        
        
        $data = preg_replace("/__CODIGO__/", $vals['codigo'], $data);
        $data = preg_replace("/__DESC_CORTA__/", $vals['desc_corta'], $data);
        $data = preg_replace("/__DESC_LARGA__/", $vals['desc_larga'], $data);
        $data = preg_replace("/__OPT_UM__/", $umList, $data);
        $data = preg_replace("/__ID_PROD__/", $id, $data);
        $data = preg_replace("/__PRECIO__/", $vals['precio'], $data);

        return  $data;
    }

    public  function getTitle()
	{
        return 'Editar producto';
    }

    /**
	 * Funcion para hacer el llenado de las unidades de medida
	 */
    private function getList($id)
    {
        $prodList = "";

        $consCat = "SELECT * FROM cat_um";
        $psCat = DsSQL::setSimpleQuery($this->conn, $consCat);
        $sqlResultsCat = DsSQL::executeSimpleQuery($psCat, null, $consCat);
        if ($sqlResultsCat){
            foreach($sqlResultsCat as $item)
            {
                $selected = ($item['id_um'] === $id)? 'selected' : '';
                $prodList .= "<option value='".$item['id_um']."' ".$selected.">".$item['descripcion']."</option>";
            }
        }

        return $prodList;
    }

    private function getValues($id)
    {
        $values = array();

        $cons = "SELECT * FROM `productos` WHERE `id_producto` = " . $id;
        $ps = DsSQL::setSimpleQuery($this->conn, $cons);
        $sqlResults = DsSQL::executeSimpleQuery($ps, null, $cons);
        if ($sqlResults)
            $values = $sqlResults[0];

        return $values;
    }
}

?>