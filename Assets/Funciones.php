<?php
namespace DevSys;

class Funciones
{
    public static function getVardumpLog()
    {
        $data = "";
        //Tomamos el numero de argumentos que pasamos
        $numArgs = func_num_args () - 1;
        
        //Asignamos los argumentos a una variable
        $argList = func_get_args ();
        
        ob_start ();
        foreach ( $argList as $item )
        {
            var_dump ( $item );
        }
        
        $data = ob_get_clean ();
        error_log ( $data );
    }
    
    public static function setLogError($errorMessage, $extra="")
    {
        $errorTxt = $errorMessage ." => ". $extra;

        error_log( $errorTxt );
    }

    /**
     * 
     * Trae una variable enviada por GET, por default hace un strip_tags() para evitar que ingresen codigo html o php
     * 
     * @param String	$varName	  	  Nombre de la variable a buscar
     * @param Boolean	$basicfilter  	  Aplica el filtro basico para reemplazar comillas simples y el signo de #. Por default viene activado
     * @param Boolean	$stripfilter	  Aplica el filtro para evitar el ingreso de tags html y php. Por default está activado
     * @param Array		$personalFilter	  Array con los caracteres no permitidos, debe enviar $personalReplace
     * @param Array		$personalReplace  Array con los caracteres que se van a reemplazar, si no se envia se reemplaza por default con espacio en blanco 
     * 
     */
    public static function getGVariable($varName, $basicfilter = true, $stripfilter = true, $personalFilter = false, $personalReplace = false)
    {
        /**
         * Ejemplos de uso, se envia la variable mode=<div>aaxxaaaaa'</div> por GET
         * $personalFilter = array("x", "'");
         * $personalReplace = array("b", "");
         * $variable = $this->funciones->getGVariable("mode", false, true, $personalFilter, $personalReplace);
         * Regresa:: aabbaaaaa
         */
        
        $var = null;
        if (isset ( $_GET [$varName] ))
        {
            $var = $_GET [$varName];
            
            //Quitamos las etiquetas html y php
            if ($stripfilter == true)
            {
                $var = strip_tags ( $var );
            }
            
            //Se aplica si tiene activado el filtro básico
            if ($basicfilter == true)
            {
                $chars = array ("'", "#" );
                $replace = array ("''", "" );
                $var = str_replace ( $chars, $replace, $var );
            }
            
            // Se activa si se activa el filtro personalizado			
            if ($personalFilter)
            {
                if (is_array ( $personalFilter ))
                {
                    $chars = $personalFilter;
                    $replace = array ("" );
                    
                    if ($personalReplace != null && is_array ( $personalReplace ))
                    {
                        $replace = $personalReplace;
                    }
                    
                    $var = str_replace ( $chars, $replace, $var );
                }
                else
                {
                    self::setLogError(11, $varName);
                }
            }
        }
        
        return $var;
    }

    /**
     * 
     * Función que valida la entrada de datos al sistema por medio de expresiones regulares
     * @param Integer   $id             Id de la validación
     * @param String    $variable       Variable a verificar
     */
    public static function validateData($variable, $id = 1)
    {
        $result = false;
        switch ($id)
        {
            //Valida que contenga solo numeros y letras
            case 1 :
                $result = preg_match ( '/^[a-zA-Z0-9]*$/', $variable );
                break;
        }
        return $result;
    }

    /**
     * Lista de errores conocidos en el sistema
     * @param Integer $number Número de error para mostrar
     */
    public static function getErrorMessage($errorTxt)
    {
        if ($errorTxt){
            return $errorTxt;
        } else {
            error_log("No se encuentra el error a mostrar");
        }
    }

    /**
     * 
     * Trae una variable enviada por POST, por default hace un strip_tags() para evitar que ingresen codigo html o php
     * 
     * @param String	$varName	  	  Nombre de la variable a buscar
     * @param Boolean	$basicfilter  	  Aplica el filtro basico para reemplazar comillas simples y el signo de #. Por default viene activado
     * @param Boolean	$stripfilter	  Aplica el filtro para evitar el ingreso de tags html y php. Por default está activado
     * @param Array		$personalFilter	  Array con los caracteres no permitidos, debe enviar $personalReplace
     * @param Array		$personalReplace  Array con los caracteres que se van a reemplazar, si no se envia se reemplaza por default con espacio en blanco 
     * 
     */
    public static function getPVariable($varName, $basicfilter = true, $stripfilter = true, $personalFilter = null, $personalReplace = null)
    {
        /**
         * Ejemplos de uso, se envia la variable mode=<div>aaxxaaaaa'</div> por POST
         * $personalFilter = array("x", "'");
         * $personalReplace = array("b", "");
         * $variable = $this->funciones->getGVariable("mode", false, true, $personalFilter, $personalReplace);
         * Regresa:: aabbaaaaa
         */
        
        $var = null;
        if (isset ( $_POST [$varName] ))
        {
            $var = $_POST [$varName];

            //Quito las etiquetas html y php
            if ($stripfilter == true)
            {
                $var = strip_tags ( $var );
            }
            
            //Se aplica si tiene activado el filtro básico
            if ($basicfilter == true)
            {
                $chars = array ("'", "#" );
                $replace = array ("''", "" );
                $var = str_replace ( $chars, $replace, $var );
            }
            
            if ($personalFilter)
            {
                if (is_array ( $personalFilter ))
                {
                    $chars = $personalFilter;
                    $replace = array ("");
                    
                    if ($personalReplace != null && is_array ( $personalReplace ))
                    {
                        $replace = $personalReplace;
                    }
                    
                    $var = str_replace ( $chars, $replace, $var );
                }
                else
                {
                    self::setLogError("El filtro para la variable POST debe de ser un Array", $varName);
                }
            }
        }
        return $var;
    }
}
    
?>