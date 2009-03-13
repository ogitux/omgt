<?php
/**
 * Events
 */

// Defino que pagina mostrar
switch ($action)
{
	default:
		$tpl = TPL_DIR . "/events/index.html";
		break;
	case "add":
		$tpl = TPL_DIR . "/events/add.html";
		break;
	case "add_team":
		$tpl = TPL_DIR . "/events/add_team.html";
		break; 
	case "save_event":
		$tpl		= TPL_DIR . "/message.html";
		$name		= $_POST["event_name"];
		$type		= $_POST["event_types"];
		$game		= $_POST["game"];
		$start		= date("Y-m-d",strtotime($_POST["event_start_at"]));
		$finish		= date("Y-m-d",strtotime($_POST["event_finish_at"]));
		$teams		= $_POST["teams"];
		$players	= $_POST["players_by_team"];
		$insert		= $MyPes->events->CreateEvent($name, $type, $game, $start, $finish, $teams, $players);
		if ($insert)
		{
			$message	 = "Evento creado exitosamente";
			$redirection = "?";
		} else {
			$message	 = "Error al crear el evento";
			$redirection = "?s=events&a=add";
		}
		break;
} 

// Muestro pagina
include($tpl);
?>
