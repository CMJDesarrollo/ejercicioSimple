$(document).ready(function() {
    $("#btnUpd").click(function(e){
        e.preventDefault();
        const codigo = $('#codigo').val();
        const desc_corta = $('#desc_corta').val();
        const desc_larga = $('#desc_larga').val();
        const um = $('#um').val();
        const precio = $('#precio').val();
        const idProd = $('#idProd').val();
        const arrVals = Array(codigo, desc_corta, desc_larga, um, precio);

        getDetailData(editProd, arrVals, idProd);
    });
});

/**
 * Hace la lalmada al controlador y printa resultados
 * @param {*} action 
 * @param {*} formParams    Parametros de los campos a insertar
 * @param {*} params        Parametros de la tabla
 * @param {*} tableParams   Parametros de la tabla que vienen desde la forma
 * @param {*} divId         Nombre del contenedor div donde se pintara el resultado
 */
 function getDetailData(action, formParams, params=null, tableParams = null,divId=null, globalParams = null) {
    $.ajax({
        url: "jqCont.php",
        type: "POST",
        async: true,
        data: { "class": "ProdEditController", "mode": action, "formParams": formParams, "params": params, "tableParams": tableParams, "globalParams":globalParams,"encrypt": 2 },
        beforeSend: function(objeto) {
            $("#headerLoader").show();
        },
        success: function(data, textStatus, jqXHR) {
            //Si no hay datos, mandamos mensaje de error
            if (!data || data == null || data == "") {
                notify("Error al editar seccion", "error");
                return false;
            }

            //Parseamos el resultado
            var data = jQuery.parseJSON(data);

            console.log(data);

            if (data.status == "false") {
                errorFlag = true;
                notify(data.value, "error");
                return false;
            }

            if (data.status == "delete") {
                errorFlag = true;
                return false;
            }

            if (data.status == "update") {
                errorFlag = true;
                notify(data.value, "success");
                return false;
            }

            //Pintamos el contenido del main
            if (data.content) 
            {
                $("#"+data.seccion).html(data.content);            
            }

            //Si existe algun mensaje
            if (data.message) {
                notify(data.message, data.type);
            }
            
            //Si existe return
            if (data.return) {
                $(location).attr('href', '?mod=');
            }

            return false;
        },

        error: function(jqXHR, textStatus, errorThrown) {
            notify("Error del servidor", "error");
        }
    });
}
