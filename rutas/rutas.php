<?php
$arrayRutas = explode("/", $_SERVER['REQUEST_URI']);
// echo '<pre>'; print_r( $arrayRutas ); echo '</pre>';
$arrRut2 = $arrayRutas[2];



if (($arrRut2) == "") {

    /*======================================================================================*/
    //! Cuando no se hace ninguna peticion a la API                                                             
    /*======================================================================================*/

    $json = array(

        "detalle" => "no encontrado"
    );

    echo json_encode($json, true);
} else {

    /*======================================================================================*/
    //! Cuando se hace peticiones desde registro                                                             
    /*======================================================================================*/

    if ($arrRut2 == "registro") {
        $json = array(
            "detalle" => "estoy en registro"
        );

        echo json_encode($json, true);
        # code...
    }

    if ($arrRut2 == "cursos") {
        $json = array(
            "detalle" => "estoy en cursos"
        );

        echo json_encode($json, true);
        # code...
    }
    /*======================================================================================*/
    //! Cuando se hace peticiones desde un solo curso                                                             
    /*======================================================================================*/
    if (count($arrayRutas) > 3) {

        if ($arrRut2 == "cursos" &&  is_numeric(array_filter($arrayRutas)[3])) {

            $json = array(
                "detalle" => "estoy en un solo  curso"
            );

            echo json_encode($json, true);
        }
     
    }
}
