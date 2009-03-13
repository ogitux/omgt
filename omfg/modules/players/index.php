<?php
/**
 * Players
 */

// Defino que pagina mostrar
switch ($action)
{
	default:
		$tpl = TPL_DIR . "/players/index.html";
		break;
	case "add":
		$tpl = TPL_DIR . "/players/add.html";
		break; 
	case "save":
		$tpl		= TPL_DIR . "/message.html";
		$name		= $_POST["player_name"];
		$nick		= $_POST["player_nick"];
		$email		= $_POST["player_email"];
		$password	= $_POST["player_pass"];
		$insert		= $MyPes->players->CreatePlayer($name, $nick, $email, $password);
		if ($insert)
		{
			$message	 = "Jugador registrado exitosamente";
			$redirection = "?s=players";
		} else {
			$message	 = "Error al registrar al jugador";
			$redirection = "?s=players";
		}
		break;
} 

// Muestro pagina
include($tpl);
?>
