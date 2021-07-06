<?php
namespace DevSys;

use DevSys\Funciones as DsFunciones;
use DevSys\Connection as DsConn;

class Main 
{
    private $className;
    private $defaultClass;
    private  $userName;
    private  $idProfile;

    public function __construct()
    {
        $this->className = "Main";
        $this->defaultClass = "ProdList";
    }

    public function getPageData()
    {
        //Variable del contenido final
        $cont = "";

        $conn = DsConn::getInstance()->conn;        

        // Vamos por el modulo a instanciar si no existe ponemos inicio de default        
        $modulo = DsFunciones::getGVariable("mod");

        // Valida que solo sean enviados números y letras para la variable modulo
        $regValidate = DsFunciones::validateData($modulo);

        //Si no tiene nada o falla la validacion, llamamos el inicio    
        $modulo == null;     
        if (!$modulo || $modulo == $this->defaultClass || $regValidate == false) 
        {
            $modulo = $this->defaultClass;
        }

        // Vamos por el template principal de la página
        $cont = file_get_contents('Vista/index.html', true);

         /**
         * Se cargan las hojas de estilo (css) para la clase que se manda a llamar
         * Si no existe, no pinta nada y se queda con el principal **
         */
        $moduleStyle = "";
        $cssFile =  $modulo;

        //error_log(SITECSSPATH . $cssFile . "Style.css");
        if (file_exists("Assets/css/" . $cssFile . "Style.css")) {
            $moduleStyle = $this->getTemplate("moduleStyle");
            $moduleStyle = preg_replace("/__STYLENAME__/", $cssFile, $moduleStyle);
        }
        $cont = preg_replace("/__STYLE__/", $moduleStyle, $cont);
        
        // Vamos por las librerias js del módulo, si no existe fisicamente , no traemos nada
        $moduleJs = "";
        
        $jsFile = "js" . ucfirst( $modulo);
        
        if (file_exists("Assets/js/" . $jsFile . ".js")) 
        {
            $moduleJs = $this->getTemplate("jsModule");
            $moduleJs = preg_replace("/__JSFILE__/", $jsFile . ".js", $moduleJs);
        
        }
        
        $cont = preg_replace("/__JS__/", $moduleJs, $cont);

        // Verificamos si existe físicamente la clase del modulo
        $classPath = "Assets/Clases/".ucfirst( $modulo).".php";
        if (file_exists($classPath))
        {
            //Ponemos en CamelCase el nombre
            $modName = ucfirst($modulo);
            //Instanciamos
            $class = new $modName();
            //Ejecutamos
            $mainData = $class->getData();
            $titleData = $class->getTitle();
            $initData = "";
            // Reemplazamos el resultado en el __CONTENT__
            $cont = preg_replace("/__CONTENTS__/", $mainData, $cont);
            $cont = preg_replace("/__TITLE__/", $titleData, $cont);
            $cont = preg_replace("/__INIT__/", $initData, $cont);
        } else {
            DsFunciones::setLogError('No existe la clase solicitada en la carpeta de librerias',  $modulo.".php");
            $cont = preg_replace("/__CONTENTS__/", DsFunciones::getErrorMessage("No existe la clase solicitada")." <a href= 'javascript:history.go(-1)' class = 'itemLink'>#_LBACK_#</a>", $cont);
            $cont = preg_replace("/__CLASE__/",  $modulo, $cont);
        }
        
        return $cont;
    }
    
    /**
     * Función encargada de contener el código html usado en la clase
     *
     * @param String $name
     *            Nombre del elemento html a buscar
     */
    private function getTemplate($name)
    {        
        $template["moduleStyle"] = <<< TEMP
<link href="Assets/css/__STYLENAME__Style.css" rel="stylesheet" type="text/css" />
TEMP;
        
        $template["jsModule"] = <<< TEMP
<script src="Assets/js/__JSFILE__" type="text/javascript"></script>
TEMP;
        
        return $template[$name];
    }
}
?>
