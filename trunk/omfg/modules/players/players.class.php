<?php
/**
 * players.class.php
 */
class players extends Omg
{
	public function GetAllPlayers()
	{
		$query	= "SELECT id, nick FROM players ORDER BY nick";
		$result	= $this->db->query($query);
		$return = $result->fetchAll(PDO::FETCH_ASSOC);
		return $return;	
	}
	public function GetPlayersNotInEvent($event)
	{
		$query	= "SELECT id, nick " .
				  "FROM players " .
				  "WHERE id NOT IN ( " .
				  "	SELECT id FROM event_players WHERE event='$event' " .
				  ") " .
				  "ORDER BY nick";
		$result	= $this->db->query($query);
		$return = $result->fetchAll(PDO::FETCH_ASSOC);
		return $return;	
	}
	public function SelectPlayer($attributes="")
	{
		foreach ($this->GetAllPlayers() as $player)
		{
			$players[$player["id"]] = $player["nick"];
		}
		$select_players = $this->SelectBuild("players", $attributes, $players);
		return $select_players;
	}
	public function SelectPlayersNotInEvent($event, $attributes="")
	{
		$players_not_int_event = $this->GetPlayersNotInEvent($event);
		if (count($players_not_int_event) > 0)
		{
			foreach ($players_not_int_event as $player)
			{
				$players[$player["id"]] = $player["nick"];
			}
		} else {
			$players[]	= "Sin jugadores";
			$attributes	= "disabled=disabled";
		}
		$select_players_not_event = $this->SelectBuild("players_not_event", $attributes, $players);
		return $select_players_not_event;
	}
	public function CreatePlayer($name, $nick, $email, $password)
	{
		$password	= md5($password);
		$insert  	= "INSERT INTO players (name, nick, email, password, created) ";
		$insert		.= "VALUES ('$name', '$nick', '	$email', '$password', NOW())";
		$result		= $this->db->query($insert);		
		$last_id	= $this->db->lastInsertId();
		$return		= ($last_id ? true : false);
		return $return;
	} 
}
?>