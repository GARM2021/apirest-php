<?php

/*======================================================================================*/
//! Mostrar todos los registros                                                             
/*======================================================================================*/
class ControladorCursos
{
    public function index() //!C59 OK
    {
        $cursos =   ModeloCursos::index("cursos");//!C61


    $json = array(//!C61
    "status" => 200,
    "total_registros" => count($cursos),
    "detalle" => $cursos
    );          
              echo json_encode($json, true);

        return;
    }

    public function create()//!C59 OK
    {
        $json = array(
            "detalle" => "Estoy en CREATE   cursos Controlador.Cursos"
        );

        echo json_encode($json, true);

        return;
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
