<?php
/**
 * Events.class.php
 */
class events extends Tournament
{
	public function GetAllEvents()
	{
		$query	= "SELECT id, name, teams FROM events ORDER BY name";
		$result	= $this->db->query($query);
		$return = $result->fetchAll(PDO::FETCH_ASSOC);
		return $return;	
	}
	public function SelectEventType($attributes="")
	{
		global $event_types;
		$select_event_types = $this->SelectBuild("event_types", $attributes, $event_types);
		return $select_event_types;
	}
	public function CreateEvent($name, $type, $game, $start, $finish, $teams, $players)
	{
		$insert  	= "INSERT INTO events (name, type, game, start_date, finish_date, creation_date, teams, players_by_team) ";
		$insert		.= "VALUES ('$name', '$type', '$game', '$start', '$finish', NOW(), '$teams', '$players')";
		$result		= $this->db->query($insert);		
		$last_id	= $this->db->lastInsertId();
		$return		= ($last_id ? true : false);
		return $return;
	}
}
?>