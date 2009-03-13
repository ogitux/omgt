<?php
/**
 * TORNEOS PES
 */
// Configuraciones
include("includes/config.php");
require_once("includes/omg.class.php");
require_once("includes/functions.php");


// Clase
$MyPes = new Omg();
$MyPes->LoadModules();

// Variables
$section = $_GET["s"];
$action  = $_GET["a"];

// Incluyo el header
include(TPL_DIR . "/index.html");

?>