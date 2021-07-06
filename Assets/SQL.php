<?php
namespace DevSys;

use DevSys\Funciones as DsFunciones;

/**
 * Clase que se encarga de generar y ejecutar los querys por medio de PDO
 *
 */
class Sql 
{
    /**
     * Prepara la consulta para ser ejecutada
     * @param connObj  Objeto de la conexión
     * @param String 	Consulta a ejecutar
     * @return Objeto  prepareStatement
     */
    public static function setSimpleQuery($conn, $consulta)
    {
        $ps = null;
        $ps = $conn->prepare($consulta);
        
        //Si no se genera avisamos
        if ($ps == null)
        {
            DsFunciones::setLogError("Error al crear el prepareStatement", __CLASS__);
        }
        return $ps;
    }


    /**
     * Función que ejecuta el query almacenado en el prepareStatement
     * @param prepareStatement	  $ps			  PrepareStatement a ejecutar
     * @param Array				      $params		Parámetros del query a ejecutar 
     * @param String			        $query		Query a ejecutar
     * @param Array				      $types		Array con los tipos de datos que se espera recibir 
     * @param Boolean			      $iup		  Bandera para saber si se ejecuta un insert, update o delete
     * @return Array asociativo y numérico con los resultados del query
     */
    public static function executeSimpleQuery($ps, $params = null, $query = "",  $iup = false, $cursor = false,  $debug = true)
    {
        $results = null;
        try
        {
            //Ejecutamos el bind para cada parametro del query
            $cont = 1;
        
            if($params)
            {
                foreach ($params as $param)
                {
                    $ps->bindValue($cont, $param);
                    $cont++;
                }
            }
            
            //  Para debug
            if ($iup)
            {
                $result = $ps->execute();
                if($cursor)
                {
                    $ps->closeCursor();
                }
                return $result;
            }
            
            $ps->execute();
            
            //Hacemos el fetch para los resultados
            //Por default genera un array asociativo
            $results = $ps->fetchAll();
        
            if($cursor)
            {
                $ps->closeCursor();
            }
        
            //Si no trae datos y no manda excepción, avisamos
            if (!$results && $debug)
            {
                DsFunciones::setLogError("El query no regreso ningún resultado", __CLASS__);
            }
        }
        catch (PDOException $e)
        {
            //Vamos y pintamos el error que se genera
            $error = $ps->errorInfo ();
            DsFunciones::setLogError("Error al ejecutar el query", __CLASS__);
        }
    
        if($cursor)
        {
            $ps->closeCursor();
        }
        
        return $results;
    }

    /**
     *Función encargada de generar el query para insertar a la base de datos
     * @param Connection	    $connection     Conexión a la base
     * @param String			$tabla 			Tabla donde se inserta 
     * @param String			$fields			String con los campos a insertar
     * @param String			$datos			String con los '?' por cada elemento insertado
     * @param Array				$params			Array on los valores a insertar		
     */
    public static function insertData($conn, $tabla, $fields, $datos, $params)
    {
        
        $consulta = "INSERT INTO  $tabla ($fields) values ($datos) ";      
        $ps = Self::setSimpleQuery ( $conn, $consulta );        
        $sqlResult = Self::executeSimpleQuery ( $ps, $params, $consulta, true );        
        return $sqlResult;    
    }

    /**
     * Función que hace un update a la tabla con los valores dados
     * @param Object	$conn		Conexión al javaBridge
     * @param String	$tabla				Tabla que recibe los cambios
     * @param Array		$datos				Array con los datos a cambiar
     * @param Array		$keyFields		Array con las llaves de la tabla
     */
    public static function updateData($conn, $tabla, $datos, $keyFields)
    {
        $consulta = "UPDATE $tabla SET ";
        $params = array ();
        
        $x = 0;
        
        foreach ( $datos as $key => $value )
        {
            if ($x > 0)
            {
                $consulta .= ", ";
            }
            
            if (strstr ( $value, "to_date" ))
            {
                $valueAux = explode ( "//", $value );
                $value = $valueAux [1];
                $consulta .= "$key = $valueAux[0]";
            }
            else
            {
                $consulta .= "$key = ? ";
            }
            $params [] = $value;
            $x ++;
        }
        
        $consulta .= " WHERE ";
        
        $x = 0;
        foreach ( $keyFields as $field => $value )
        {
            if ($x > 0)
            {
                $consulta .= " AND ";
            }
            
            if (strstr ( $value, "to_date" ))
            {
                $valueAux = explode ( "//", $value );
                $value = $valueAux [1];
                $consulta .= "$field = $valueAux[0]";
            }
            else
            {
                $consulta .= " $field = ? ";
            }
            $params [] = $value;
            $x ++;
        }
        
        $ps =self::setSimpleQuery ( $conn, $consulta );
        
        $sqlResult = self::executeSimpleQuery ( $ps, $params, $consulta,  true );
        
        return $sqlResult;
    }
}

?>
