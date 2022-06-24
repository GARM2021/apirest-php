<?php

require_once "conexion.php";

class ModeloCursos
{

    static public function index($tabla)
    {
        $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla"); //!C61

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_CLASS);

        //  $stmt -> close();

        // $stmt = null;
    }
     /*======================================================================================*/
                          //!C69                                                              
     /*======================================================================================*/
    static public function create($table, $datos)
    {



        $stmt = Conexion::conectar()->prepare("INSERT INTO $table( titulo,  descripcion,  instructor,  imagen,  precio,  id_creador,  created_at,  updated_at ) VALUES (:titulo,  :descripcion, :instructor,  :imagen, :precio,  :id_creador,  :created_at,  :updated_at)"); //!C69


        $stmt->bindParam(':titulo', $datos["titulo"], PDO::PARAM_STR);
        $stmt->bindParam(':descripcion', $datos["descripcion"], PDO::PARAM_STR);
        $stmt->bindParam(':instructor',  $datos["instructor"], PDO::PARAM_STR);
        $stmt->bindParam(':imagen', $datos["imagen"], PDO::PARAM_STR);
        $stmt->bindParam(':precio', $datos["precio"], PDO::PARAM_STR);
        $stmt->bindParam(':id_creador', $datos["id_creador"], PDO::PARAM_STR);
        $stmt->bindParam(':created_at', $datos["dcreated_at"], PDO::PARAM_STR);
        $stmt->bindParam(':updated_at', $datos["dupdated_at"], PDO::PARAM_STR);


        if ($stmt->execute()) {

            return "ok";
            # code...
        }else {
            echo '<pre>'; print_r(Conexion::conectar()->errorInfo() ); echo '</pre>';
                    }

               $stmt->closeCursor();
               $stmt = null;   

      
        
        # code...
    }

    static public function show($tabla, $id)
    {

        $json = array(
            "detalle" => "estoy en SHOW  Modelo  de Cursos " . $id
        );

        echo json_encode($json, true);

    
        $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE id = :id"); //!C70


        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_CLASS);

        //  $stmt -> close();

        // $stmt = null;
    }
}
