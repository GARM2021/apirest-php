<?php 

require_once "conexion.php";

class ModeloClientes{

     /*======================================================================================*/
                          //! Mostrar todos los registros                                                             
     /*======================================================================================*/

    static function index($tabla)
     {
        $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");//!C64

        $stmt -> execute();

        return $stmt-> fetchAll();//!C64
       
     }
}