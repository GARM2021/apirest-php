<?php 

class Conexion{//!C60

    static function conectar()
    {
        $link = new PDO("mysql:host=localhost;dbname=apirest",
         "root",
          "");

          $link->exec("set names utf8");

          return $link;

    }
}

