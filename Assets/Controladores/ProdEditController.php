<?php

use DevSys\Funciones as DsFunciones;
use DevSys\Connection as DsConn;
use DevSys\SQL as DsSQL;


class ProdEditController
{
    private $conn = "";

    //Constructor de la clase
    function __construct()
    {
        $this->className = "ProdEdit";
        $this->conn = DsConn::getInstance()->conn;
    }

    public function getData()
    {
        $mode = DsFunciones::getPVariable("mode");
        
        switch ($mode) {
            case "editProd":
                $data = self::editProd();
                break;
            }

            return $data;
    }
    
    private function editProd()
    {
        $campos = DsFunciones::getPVariable("formParams", true, false);
        $id = DsFunciones::getPVariable("params");

        $table = 'productos';
        $datos = array(
            'codigo'     => $campos[0], 
            'desc_corta' => $campos[1],
            'desc_larga' => $campos[2],
            'um'         => $campos[3],
            'precio'     => $campos[4]
        );
        $key = array(
            'id_producto' => $id
        );
        $rs = DsSQL::updateData($this->conn, $table, $datos, $key);
        if ($rs) {
            $msg = "Registro actualizado correctamente";
            $type = "success";
            $return = true;
        } else {
            $msg = "Ocurrió un error al actualizar";
            $type = "error";
            $return = false;
        }

        $result = json_encode(array("status" => "true", "message" => $msg, "type" => $type, "return" => $return));
        return $result;
    }
}