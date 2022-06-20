<?php 

require_once "conexion.php";

class ModeloCursos{

    static function index($tabla)
    {
        $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");//!C61

        $stmt -> execute();

        return $stmt-> fetchAll(PDO::FETCH_CLASS);

        //  $stmt -> close();

        // $stmt = null;




    }


}
