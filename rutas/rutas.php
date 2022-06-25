<?php

use JetBrains\PhpStorm\Internal\ReturnTypeContract;



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

    return;
} else {

    /*======================================================================================*/
    //! Cuando se hace peticiones desde registro                                                             
    /*======================================================================================*/
    if (count(array_filter($arrayRutas)) == 2) {


        if ($arrRut2 == "registro") {

            /*======================================================================================*/
            //! Peticiones POST                                                             
            /*======================================================================================*/

            if (isset($_SERVER["REQUEST_METHOD"]) && $_SERVER["REQUEST_METHOD"] == "POST") { //!C59

                /*======================================================================================*/
                //!C62 CAPTURANDO DATOS                                                             
                /*======================================================================================*/

                $datos = array(
                    "nombre" => $_POST["nombre"],
                    "apellido" => $_POST["apellido"],
                    "email" => $_POST["email"]
                );

                $registro = new  ControladorClientes();
                $registro->create($datos); //!C62 
                return;

                $json = array(
                    "detalle" => "estoy en registro POST"
                );

                echo json_encode($json, true);

                return;
                # code...
            }


            # code...
        } elseif ($arrRut2 == "cursos") {

            /*======================================================================================*/
            //! Peticiones GET                                                            
            /*======================================================================================*/



            if (isset($_SERVER["REQUEST_METHOD"]) && $_SERVER["REQUEST_METHOD"] == "GET") { //!C59

                $cursos = new  ControladorCursos();
                $cursos->index();
                return;
                $json = array(
                    "detalle" => "estoy GET controlador  en cursos"
                );

                echo json_encode($json, true);

                return;
                # code...
            }

            if (isset($_SERVER["REQUEST_METHOD"]) && $_SERVER["REQUEST_METHOD"] == "POST") { //!C59

                /*======================================================================================*/
                //!C69 Capturar Datos                                                             
                /*======================================================================================*/

                $datos = array(
                    "titulo" => $_POST["titulo"],
                    "descripcion" => $_POST["descripcion"],
                    "instructor" => $_POST["instructor"],
                    "imagen" => $_POST["imagen"],
                    "precio" => $_POST["precio"]
                );


                $crearcursos = new  ControladorCursos();
                $crearcursos->create($datos);//!69 se incluyo $datos
                return;
                $json = array(
                    "detalle" => "estoy Controlador cursos en CREATE cursos"
                );

                echo json_encode($json, true);

                return;
                # code...
            }
        }
    } else {
        /*======================================================================================*/
        //! Cuando se hace peticiones desde un solo curso                                                             
        /*======================================================================================*/
        if (count($arrayRutas) > 3) {



            if ($arrRut2 == "cursos" &&  is_numeric(array_filter($arrayRutas)[3])) {

                if (isset($_SERVER["REQUEST_METHOD"]) && $_SERVER["REQUEST_METHOD"] == "PUT") { //!C59


                     /*======================================================================================*/
                                          //! C70 Captura de Datos.                                                             
                     /*======================================================================================*/

                    $datos = array();

                    parse_str(file_get_contents('php://input'), $datos);
                  //  $datosuno = file_get_contents('php://input'); //!C70 Muestra el contenido sin formato como string 

                   // echo 'PUT <pre>'; print_r( $datos ); echo '</pre>';

                   //return;

                    $actualizacurso = new  ControladorCursos();
                    $actualizacurso->update((array_filter($arrayRutas)[3]), $datos);//!C70 
                    return;

                  
                }
            }

            if ($arrRut2 == "cursos" &&  is_numeric(array_filter($arrayRutas)[3])) {

                if (isset($_SERVER["REQUEST_METHOD"]) && $_SERVER["REQUEST_METHOD"] == "GET") { //!C59

                  

                    $mostrarcurso = new  ControladorCursos();
                    $mostrarcurso->show((array_filter($arrayRutas)[3]));
                   // return;


                   
                }
            }

            if ($arrRut2 == "cursos" &&  is_numeric(array_filter($arrayRutas)[3])) {

                if (isset($_SERVER["REQUEST_METHOD"]) && $_SERVER["REQUEST_METHOD"] == "DELETE") { //!C59

                    $borrarcurso = new  ControladorCursos();
                    $borrarcurso->delete((array_filter($arrayRutas)[3]));
                    return;


                    $json = array(
                        "detalle" => "estoy en un solo  curso " . $arrayRutas[3]
                    );

                    echo json_encode($json, true);

                    return;
                }
            }
        
        
        
        
        
        
        
        
        
        
        
        
        }else {
            $json = array(

                "detalle" => "no encontrado"
            );

            echo json_encode($json, true);

            return;
        }
    }
}
