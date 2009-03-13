<?php
/**
 * Teams
 */

// Defino que pagina mostrar
switch ($action)
{
	default:
		$tpl = TPL_DIR . "/scenarios/index.html";
		break;
	case "add":
		$tpl = TPL_DIR . "/scenarios/add.html";
		break;
	case "save_scenario":
		$tpl			= TPL_DIR . "/message.html";
		$name			= $_POST["scenario_name"];
		$game			= $_POST["game"];
		$description	= $_POST["scenario_description"];
		$insert			= $MyPes->scenarios->CreateScenario($name, $game, $description);
		$redirection	= "?s=scenarios";
		if ($insert)
		{
			$message	 = "Escenario creado exitosamente";
		} else {
			$message	 = "Error al crear escenario";
		}
		break;
} 

// Muestro pagina
include($tpl);
?>
