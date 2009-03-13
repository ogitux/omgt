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
		$event		= $_GET["event"];
		$tpl 		= TPL_DIR . "/events/add_team.html";
		$team_info	= $MyPes->events->GetEventInfo($event);
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
		if ($insert) {
			$message	 = "Evento creado exitosamente";
			$redirection = "?";
		} else {
			$message	 = "Error al crear el evento";
			$redirection = "?s=events&a=add";
		}
		break;
	case "save_event_team":
		$tpl			= TPL_DIR . "/message.html";
		$redirection = "?s=events";
		
		$event			= $_GET["event"];
		$just_players	= $_GET["jp"];
		if ($just_players==1) {
			$player		= $_POST["players"];
			$insert		= $MyPes->events->EventAddPlayer($event, $player);
		} else {
			$team		= $_POST["teams"];
			$insert		= $MyPes->events->EventAddTeam($event, $team);
		}
		
		if ($insert)
		{
			$message	 = "Jugador/Equipo agregado exitosamente";
		} else {
			$message	 = "Error al agregar";
		}
		break;
} 

// Muestro pagina
include($tpl);
?>
