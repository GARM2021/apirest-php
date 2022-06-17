<?php 

class  ControladorClientes{

    public function create()//!C59 OK
    {
        $json = array(
            "detalle" => "estoy en registro CONTROLADOR clientes POST"
        );

        echo json_encode($json, true);

        return;
    }



}