<?php
/**
 * Matches
 */

// Defino que pagina mostrar
switch ($action)
{
	default:
		$tpl = TPL_DIR . "/matches/index.html";
		break;
} 

// Muestro pagina
include($tpl);
?>
