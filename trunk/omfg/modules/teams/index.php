<?php
/**
 * Teams
 */

// Defino que pagina mostrar
switch ($action)
{
	default:
		$tpl = TPL_DIR . "/teams/index.html";
		break;
	case "add":
		$tpl = TPL_DIR . "/teams/add.html";
		break; 
	case "save":
		$tpl		= TPL_DIR . "/message.html";
		$name		= $_POST["team_name"];
		$tag		= $_POST["team_tag"];
		$players	= $_POST["team_players"];
		$game		= $_POST["game"];
		$insert		= $MyPes->teams->CreateTeam($game, $name, $tag, $players);
		$redirection = "?s=teams";
		if ($insert)
		{
			$message	 = "Equipo creado exitosamente";
		} else {
			$message	 = "Error al crear equipo";
		}
		break;
} 

// Muestro pagina
include($tpl);
?>
