<?php 

require_once "controladores/rutas.controlador.php";
require_once "controladores/clientes.controlador.php";//!C59
require_once "controladores/cursos.controlador.php";//!C59
require_once "modelos/cursos.modelo.php";//!C61
require_once "modelos/clientes.modelo.php";//!C61


$rutas = new ControladorRutas();

$rutas -> index();