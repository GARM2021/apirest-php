<?php

/*======================================================================================*/
//! Mostrar todos los registros                                                             
/*======================================================================================*/
class ControladorCursos
{
    public function index() //!C59 OK
    {

        /*======================================================================================*/
        //!C68 Validando Credenciales del Cliente                                                              
        /*======================================================================================*/

        $clientes = ModeloClientes::index("clientes");


        if (isset($_SERVER['PHP_AUTH_USER']) && isset($_SERVER['PHP_AUTH_PW'])) {


            foreach ($clientes as $key => $valueClientes) {

                /*======================================================================================*/
                //!C68 OJO tenia dentro del foreach las dos condicioes del IF por eso cuando se detectaba el primer falso se cortaba :(                                                             
                /*======================================================================================*/

                if ("Basic " . base64_encode($_SERVER['PHP_AUTH_USER'] . ":" . $_SERVER['PHP_AUTH_PW']) == "Basic " . base64_encode($valueClientes["id_cliente"] . ":" . $valueClientes["llave_secreta"])) {

                    /*======================================================================================*/
                    //! Mostrar todos los cursos                                                             
                    /*======================================================================================*/

                    $cursos =   ModeloCursos::index("cursos"); //!C61


                    $json = array( //!C61
                        "status" => 200,
                        "total_registros" => count($cursos),
                        "detalle" => $cursos
                    );
                    echo json_encode($json, true);

                    return;
                }

                # code...
            }
        }

        $json = array(

            "estatus" => 404,
            "detalle" => "no autorizado"
        );

        echo json_encode($json, true);

        return;
    }



    public function create($datos) //!C59 OK
    {
        $clientes = ModeloClientes::index("clientes");

        if (isset($_SERVER['PHP_AUTH_USER']) && isset($_SERVER['PHP_AUTH_PW'])) {


            foreach ($clientes as $key => $valueClientes) {

                if ("Basic " . base64_encode($_SERVER['PHP_AUTH_USER'] . ":" . $_SERVER['PHP_AUTH_PW']) == "Basic " . base64_encode($valueClientes["id_cliente"] . ":" . $valueClientes["llave_secreta"])) {

                    /*======================================================================================*/
                    //!C69 Validar Datos                                                           
                    /*======================================================================================*/


                    echo ' este es <pre>';
                    print_r($datos);
                    echo '</pre>';


                    /*======================================================================================*/
                    //!C63 Validando nombre                                                            
                    /*======================================================================================*/

                    foreach ($datos as $key => $valueDatos) {



                        if (isset($valueDatos) && !preg_match('/^[[(\\)\\=\\&\\$\\;\\-\\_\\*\\"\\<\\>\\?\\¿\\!\\¡\\:\\,\\.\\0-9a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/', $valueDatos)) {
                            //if(isset($valueDatos) && preg_match('/^[\\+\\#]+$/', $valueDatos)){

                            $json = array(

                                "status" => 404,
                                "detalle" => "Error en el campo " . $key

                            );

                            echo json_encode($json, true);

                            return;
                        }
                    }





                    /*======================================================================================*/
                    //!C69 Validar que el titulo o la descripcion no este repetido                                                           
                    /*======================================================================================*/
                    $cursos = ModeloCursos::index("cursos");

                    foreach ($cursos as $key => $value) {

                        //!C69  normalmente usariamos $value["titulo"] pero como se ejecuto el query con PDO::FETCH_CLASS se utiliza la sintaxis con -> 

                        if ($value->titulo == $datos["titulo"]) {

                            $json = array(

                                "status" => 404,
                                "detalle" => "Titulo duplicado " . $value->titulo

                            );

                            echo json_encode($json, true);

                            return;
                            # code...
                        }

                        if ($value->descripcion == $datos["descripcion"]) {

                            $json = array(

                                "status" => 404,
                                "detalle" => "Descripcion duplicado " . $value->descripcion

                            );

                            echo json_encode($json, true);

                            return;
                            # code...
                        }
                    }

                    /*======================================================================================*/
                    //!C69 Llevar  Datos al modelo modelo                                                          
                    /*======================================================================================*/


                    $datos = array(
                        "titulo" => $datos["titulo"],
                        "descripcion" => $datos["descripcion"],
                        "instructor" => $datos["instructor"],
                        "imagen" => $datos["imagen"],
                        "precio" => $datos["precio"],
                        "id" => $valueClientes["id"],
                        "dcreated_at" => date('Y-m-d h:i:s'),
                        "dupdated_at" => date('Y-m-d h:i:s')
                    );

                    $create = ModeloCursos::create("cursos", $datos);
                    if ($create == 'ok') {

                        $json = array(
                            "status" => 200,
                            "detalle" => "Registro exitoso, su curso a sido dado de alta",
                        );

                        echo json_encode($json, true);

                        return;

                        # code...
                    } else {
                        $json = array(

                            "status" => 404,
                            "detalle" => "token no valido  " . $value->titulo

                        );

                        echo json_encode($json, true);

                        return;
                        # code...
                    }



                    return;

                    /*======================================================================================*/
                    //!C69 Validar Datos del modelo                                                          
                    /*======================================================================================*/





                    /*======================================================================================*/
                    //!C69 Respuesta  del modelo                                                          
                    /*======================================================================================*/

                    $cursos =   ModeloCursos::index("cursos"); //!C61


                    $json = array( //!C61
                        "status" => "este es el ultimo 200",
                        "total_registros" => count($cursos),
                        "detalle" => $cursos
                    );
                    echo json_encode($json, true);

                    return;
                }

                # code...
            }
        }

        // $json = array(

        //     "estatus" => 404,
        //     "detalle" => "no autorizado"
        // );

        // echo json_encode($json, true);

        // return;

        ///////////////////////////////////////////////////////////////////////
        $json = array(
            "detalle" => "Estoy en CREATE   cursos Controlador.Cursos"
        );

        echo json_encode($json, true);

        return;
        //////////////////////////////////////////////////////
    }


    public function update($id) //!C59
    {
        $json = array(
            "detalle" => "Estoy en UPDATE  curso ID " . $id
        );

        echo json_encode($json, true);

        return;
    }

    public function show($id) //!C59
    {
        $json = array(
            "detalle" => "Estoy en SHOW  curso ID " . $id
        );

        echo json_encode($json, true);

        return;
    }

    public function delete($id) //!C59
    {
        $json = array(
            "detalle" => "Se ha borrado el   curso ID " . $id
        );

        echo json_encode($json, true);

        return;
    }
}
