<?php
/**
 * CONFIGURACIONES
 * @author hypn
 * @version 0.1
 */
// BASE DE DATOS
DEFINE("DB_USER","torneos");
DEFINE("DB_PASS","pes09");
DEFINE("DB_HOST","localhost");
DEFINE("DB_NAME","torneos");

// DIRECTORIOS
DEFINE("HOME_DIR","/home/hypn/www/torneos");
DEFINE("TPL_DIR",HOME_DIR . "/tpl");
DEFINE("MOD_DIR",HOME_DIR . "/modules");
DEFINE("DEFAULT_PAGE", TPL_DIR . "/main.html");

// RUTAS
DEFINE("HOME_PATH","/");
DEFINE("CSS_PATH", HOME_PATH . "css");
DEFINE("IMG_PATH", HOME_PATH . "images");
DEFINE("JSC_PATH", HOME_PATH . "js");


// Arrays fijos
$event_types = array("Real Time", "On-Line", "LAN");
?>