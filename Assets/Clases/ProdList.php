<?php

use DevSys\Funciones as DsFunciones;
use DevSys\Connection as DsConn;
use DevSys\SQL as DsSQL;

class ProdList {
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
        $prodList = "";

        $data = file_get_contents('Vista/ProdList.html', true);

        $prodList = self::getList();
        
        $data = preg_replace("/__PRODLIST__/", $prodList, $data);

        return  $data;
    }

    /**
	 * Funcion para el envío del titulo
	 */
	public  function getTitle()
	{
        return 'Listado de productos';
    }

    /**
	 * Funcion para hacer el llenado de la tabla de productos
	 */
    private function getList()
    {
        $prodList = "";

        $consCat = "SELECT * FROM cat_um";
        $psCat = DsSQL::setSimpleQuery($this->conn, $consCat);
        $sqlResultsCat = DsSQL::executeSimpleQuery($psCat, null, $consCat);
        $catUm = array();
        if ($sqlResultsCat){
            foreach($sqlResultsCat as $item)
            {
                $catUm[$item['id_um']] = $item['descripcion'];
            }
        }
        
        $consulta = "SELECT * FROM productos";
        $ps = DsSQL::setSimpleQuery($this->conn, $consulta);
        $params = array();
        $sqlResults = DsSQL::executeSimpleQuery($ps, null, $consulta);
        
        if ($sqlResults){
            foreach($sqlResults as $item){
                if (strlen($item['desc_larga']) > 70)
                {
                    $descLarga = substr($item['desc_larga'], 0, 70).'...';
                } else {
                    $descLarga = $item['desc_larga'];
                }



                $prodList .= '<tr>
                    <td>
                        <a href="#" class="btnEdit" data-id="'.$item['id_producto'].'">
                            <i class="fas fa-edit"></i>
                        </a>
                    </td>
                    <td>'.$item['codigo'].'</td>
                    <td>'.$item['desc_corta'].'</td>
                    <td>'.$descLarga.'</td>
                    <td>'.$catUm[$item['um']].'</td>
                    <td>'.$item['precio'].'</td>
                </tr>';
            }
        }

        return $prodList;
    }
}

?>
