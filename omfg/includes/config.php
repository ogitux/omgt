<?php
/**
 * CONFIGURATION
 * @author hypn
 * @version 0.1
 */
// DATABASE INFO
DEFINE("DB_USER","torneos");
DEFINE("DB_PASS","pes09");
DEFINE("DB_HOST","localhost");
DEFINE("DB_NAME","torneos");

// DIRECTORIES FOR URL'S
DEFINE("HOME_DIR","/home/hypn/www/torneos");
DEFINE("TPL_DIR",HOME_DIR . "/tpl");
DEFINE("MOD_DIR",HOME_DIR . "/modules");
DEFINE("DEFAULT_PAGE", TPL_DIR . "/main.html");

// PATHS FOR FILE INCLUTIONS
DEFINE("HOME_PATH","/");
DEFINE("CSS_PATH", HOME_PATH . "css");
DEFINE("IMG_PATH", HOME_PATH . "images");
DEFINE("JSC_PATH", HOME_PATH . "js");


// Arrays fijos
$event_types	= array("Real Time", "On-Line", "LAN");
$game_formats	= array("1 on 1","Team vs Team");
?>