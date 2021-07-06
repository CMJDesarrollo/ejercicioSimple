<?php

use DevSys\Funciones as DsFunciones;
use DevSys\Connection as DsConn;
use DevSys\SQL as DsSQL;


class ProdAddController
{
    private $conn = "";

    //Constructor de la clase
    function __construct()
    {
        $this->className = "ProdAdd";
        $this->conn = DsConn::getInstance()->conn;
    }

    public function getData()
    {
        $mode = DsFunciones::getPVariable("mode");
        
        switch ($mode) {
            case "addProd":
                $data = self::addProd();
                break;
            }

            return $data;
    }
    
    private function addProd()
    {
        $campos = DsFunciones::getPVariable("formParams", true, false);
        $table = 'productos';
        $fields = 'codigo, desc_corta, desc_larga, um, precio';
        $vals = '?,?,?,?,?';
        $params = [$campos[0],$campos[1],$campos[2],$campos[3],$campos[4]];
        $rs = DsSQL::insertData($this->conn, $table, $fields, $vals, $params);
        if ($rs) {
            $msg = "Registro insertado correctamente";
            $type = "success";
        } else {
            $msg = "Ocurrió un error al insertar";
            $type = "error";
        }

        $result = json_encode(array("status" => "true", "content" => "", "message" => $msg, "type" => $type, "seccion" => ""));
        return $result;
    }
}