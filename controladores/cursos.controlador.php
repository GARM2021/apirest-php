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



    public function create($datos) //!C69 OK
    {
        $clientes = ModeloClientes::index("clientes");

        if (isset($_SERVER['PHP_AUTH_USER']) && isset($_SERVER['PHP_AUTH_PW'])) {


            foreach ($clientes as $key => $valueClientes) {

                if ("Basic " . base64_encode($_SERVER['PHP_AUTH_USER'] . ":" . $_SERVER['PHP_AUTH_PW']) == "Basic " . base64_encode($valueClientes["id_cliente"] . ":" . $valueClientes["llave_secreta"])) {

                    /*======================================================================================*/
                    //!C69 Validar Datos                                                           
                    /*======================================================================================*/


                    // echo ' este es <pre>';
                    // print_r($datos);
                    // echo '</pre>';


                    /*======================================================================================*/
                    //!C63 Validando CAMPOS                                                          
                    /*======================================================================================*/

                    foreach ($datos as $key => $valueDatos) {
                        $clientes = ModeloClientes::index("clientes");

                        if (isset($_SERVER['PHP_AUTH_USER']) && isset($_SERVER['PHP_AUTH_PW'])) {


                            foreach ($clientes as $key => $valueClientes) {

                                if ("Basic " . base64_encode($_SERVER['PHP_AUTH_USER'] . ":" . $_SERVER['PHP_AUTH_PW']) ==
                                 "Basic " . base64_encode($valueClientes["id_cliente"] . ":" . $valueClientes["llave_secreta"])) {

                                    /*======================================================================================*/
                                    //!C69 Validar Datos                                                           
                                    /*======================================================================================*/


                                    echo ' este es <pre>';
                                    print_r($datos);
                                    echo '</pre>';


                                    /*======================================================================================*/
                                    //!C63 Validando CAMPOS                                                          
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
                                        "id_creador" => $valueClientes["id"],
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



                        ///////////////////////////////////////////////////////////////////////
                        $json = array(
                            "detalle" => "Estoy en CREATE   cursos Controlador.Cursos"
                        );

                        echo json_encode($json, true);

                        return;
                    }
                }
            }
        }
    }
    public function update($id, $datos) //!C70
    {


        echo '<pre> desde el controlador ';
        print_r($datos);
        echo '</pre>';

        // return;
        //>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>

        $clientes = ModeloClientes::index("clientes"); //!C70


       

        if (isset($_SERVER['PHP_AUTH_USER']) && isset($_SERVER['PHP_AUTH_PW'])) {

            echo '<pre> desde el controlador 3 ';
            print_r($datos);
            echo '</pre>';


            foreach ($clientes as $key => $valueClientes) {


                if ("Basic " . base64_encode($_SERVER['PHP_AUTH_USER'] . ":" . $_SERVER['PHP_AUTH_PW']) == "Basic " . base64_encode($valueClientes["id_cliente"] . ":" . $valueClientes["llave_secreta"])) {
                   
                   
                   
                   
                   


        
                    /*======================================================================================*/
                    //!C70 Validar Datos                                                           
                    /*======================================================================================*/




                    /*======================================================================================*/
                    //!C63 Validando CAMPOS                                                          
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
                //!C70 validar id_creador                                                          
                /*======================================================================================*/
                $curso = ModeloCursos:: show("cursos", $id);

                foreach ($curso as $key => $valueCurso) {

                    echo 'ID_CREADOR<pre>'; print_r( $valueCurso->id_creador ); echo '</pre>';

                    echo 'ID_CLIENTE<pre>'; print_r( $valueClientes["id"] ); echo '</pre>';

                    if ($valueCurso->id_creador == $valueClientes["id"]) {

                /*======================================================================================*/
                //!C70 Llevar  Datos al modelo modelo                                                          
                /*======================================================================================*/


                $datos = array(

                    "id" => $id,
                    "titulo" => $datos["titulo"],
                    "descripcion" => $datos["descripcion"],
                    "instructor" => $datos["instructor"],
                    "imagen" => $datos["imagen"],
                    "precio" => $datos["precio"],
                   "dupdated_at" => date('Y-m-d h:i:s')
                );

                $update = ModeloCursos::update ("cursos", $datos);
                if ($update == 'ok') {

                    $json = array(
                        "status" => 200,
                        "detalle" => "OKOKOK Registro exitoso, su curso actualizado",
                    );

                    echo json_encode($json, true);

                    return;

                    # code...
                } else {
                    $json = array(

                        "status" => 404,
                        "detalle" => "token no valido  " . $datos["titulo"]

                    );   

                        # code...
                    }
                    # code...
                }else {
                        
                    $json = array(

                        "status" => 404,
                        "detalle" => "El curso " . $id . "No  pertenece al cliente " . $valueClientes["id"]

                    );

                    echo json_encode($json, true);

                    return;
                    # code...
                }


                  

                    echo json_encode($json, true);

                    return;
                    # code...
                }


                }



                



                // return;

                // /*======================================================================================*/
                // //!C69 Validar Datos del modelo                                                          
                // /*======================================================================================*/





                // /*======================================================================================*/
                // //!C69 Respuesta  del modelo                                                          
                // /*======================================================================================*/

                // $cursos =   ModeloCursos::index("cursos"); //!C61


                // $json = array( //!C61
                //     "status" => "este es el ultimo 200",
                //     "total_registros" => count($cursos),
                //     "detalle" => $cursos
                // );
                // echo json_encode($json, true);

                // return;
            }

            # code...
        }
    }

    //<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<    




    public function     show($id) //!C59
    {


        $clientes = ModeloClientes::index("clientes");


        if (isset($_SERVER['PHP_AUTH_USER']) && isset($_SERVER['PHP_AUTH_PW'])) {


            foreach ($clientes as $key => $valueClientes) {

                /*======================================================================================*/
                //!C70                                                             
                /*======================================================================================*/

                if ("Basic " . base64_encode($_SERVER['PHP_AUTH_USER'] . ":" . $_SERVER['PHP_AUTH_PW']) == 
                "Basic " . base64_encode($valueClientes["id_cliente"] . ":" . $valueClientes["llave_secreta"])) {

                    /*======================================================================================*/
                    //! Mostrar todos el curso                                                            
                    /*======================================================================================*/

                    $curso =   ModeloCursos::show("cursos", $id); //!C70

                    if (!empty($curso)) {
                        $json = array( //!C70
                            "status" => 200,
                            "detalle" => $curso
                        );
                        echo json_encode($json, true);
                        return;
                    } else {

                        $json = array(

                            "status" => 202,
                            " total de registros " => 0,
                            "detalle" => "no hay ningun curso registrado"
                        );
                        echo json_encode($json, true);
                        return;
                        # code...
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
