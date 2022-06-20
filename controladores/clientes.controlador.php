<?php

class  ControladorClientes
{

    public function create($datos) //!C59 OK
    {
        /*======================================================================================*/
        //!C63 Validando nombre                                                            
        /*======================================================================================*/
        if (isset($datos["nombre"]) && !preg_match('/^[a-zA-ZáéíóúÁÉÍÓÚñÑ ]+$/', $datos["nombre"])) {

            $json = array(
                "status" => 404,
                "detalle" => "Error en el campo nombre, solo letras "
            );



            echo '<pre>';
            print_r($json);
            echo '</pre>';
            $json = array(
                "detalle" => "estoy en registro CONTROLADOR clientes POST"
            );

            echo json_encode($json, true);

            return;
        }

        /*======================================================================================*/
        //!C63 Validando apellido                                                            
        /*======================================================================================*/
        if (isset($datos["apellido"]) && !preg_match('/^[a-zA-ZáéíóúÁÉÍÓÚñÑ ]+$/', $datos["apellido"])) {

            $json = array(
                "status" => 404,
                "detalle" => "Error en el campo apellido, solo letras "
            );



            echo '<pre>';
            print_r($json);
            echo '</pre>';
            $json = array(
                "detalle" => "estoy en registro CONTROLADOR clientes POST"
            );

            echo json_encode($json, true);

            return;
        }

        /*======================================================================================*/
        //!C63 Validando email                                                            
        /*======================================================================================*/
        if (isset($datos["email"]) && !preg_match('/^(([^<>()\[\]\\.,;:\s@”]+(\.[^<>()\[\]\\.,;:\s@”]+)*)|(“.+”))@((\[[0–9]{1,3}\.[0–9]{1,3}\.[0–9]{1,3}\.[0–9]{1,3}])|(([a-zA-Z\-0–9]+\.)+[a-zA-Z]{2,}))$/', $datos["email"])) {

            $json = array(
                "status" => 404,
                "detalle" => "Error en el campo email, formato no valido "
            );



            echo '<pre>';
            print_r($json);
            echo '</pre>';
            $json = array(
                "detalle" => "estoy en registro CONTROLADOR clientes POST"
            );

            echo json_encode($json, true);

            return;
        }

        $json = array(
            "detalle" => "estoy en registro CONTROLADOR clientes POST GUARDADO"
        );

        echo '<pre>'; print_r( $json ); echo '</pre>';

      
      
      
    }
}
