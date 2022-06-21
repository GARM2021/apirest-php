<?php

require_once "conexion.php";

class ModeloClientes
{

    /*======================================================================================*/
    //! Mostrar todos los registros                                                             
    /*======================================================================================*/

    static function index($tabla)
    {
        $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla"); //!C64

        $stmt->execute();

        return $stmt->fetchAll(); //!C64

    }

    /*======================================================================================*/
    //!C66 Crear un registro                                                             
    /*======================================================================================*/

    static function create($tabla,  $datos) //!C66
    {
        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(primer_nombre, primer_apellido, email, id_cliente, llave_secreta, created_at, updated_at) VALUES (:nombre, :apellido, :email, :id_cliente, :llave_secreta, :created_at, :updated_at)");

		$stmt -> bindParam(':nombre', $datos["nombre"], PDO::PARAM_STR);//!C65 el nombre del parametro aqui no hacia match con los del INSERT INTO TONTO
		$stmt -> bindParam(':apellido', $datos["apellido"], PDO::PARAM_STR);
		$stmt -> bindParam(':email', $datos["demail"], PDO::PARAM_STR);
		$stmt -> bindParam(':id_cliente', $datos["did_cliente"], PDO::PARAM_STR);
		$stmt -> bindParam(':llave_secreta', $datos["dllave_secreta"], PDO::PARAM_STR);
		$stmt -> bindParam(':created_at', $datos["dcreated_at"], PDO::PARAM_STR);
		$stmt -> bindParam(':updated_at', $datos["dupdated_at"], PDO::PARAM_STR);

		if($stmt -> execute()){

			return "ok";

		}else{

			print_r(Conexion::conectar()->errorInfo());

		}

    }
        
        
    
}
