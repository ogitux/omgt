<?php
/**
 * Events.class.php
 */
class events extends Omg
{
	public function GetAllEvents()
	{
		$query	= "SELECT id, name, teams FROM events ORDER BY name";
		$result	= $this->db->query($query);
		$return = $result->fetchAll(PDO::FETCH_ASSOC);
		return $return;	
	}
	public function GetEventInfo($id)
	{
		$query	= "SELECT e.id, e.name, e.type, e.game, e.start_date, e.finish_date, e.phase, e.teams, e.players_by_team, e.just_players, COUNT(ep.player) as 'event_players', COUNT(et.team) as 'event_teams' " .
				  "FROM events e " .
				  "LEFT OUTER JOIN event_players ep ON ep.event=e.id " . 
				  "LEFT OUTER JOIN event_teams et ON ep.event=e.id " .
				  "WHERE e.id='$id'";
		$result	= $this->db->query($query);
		$return = $result->fetchAll(PDO::FETCH_ASSOC);
		return $return[0];
	}
	public function GetEventParticipants($event)
	{
		$team_info			= $this->GetEventInfo($event);
		$event_participants	= ($team_info["event_teams"] > 0 ? $team_info["event_teams"] : $team_info["event_players"] );
		return $event_participants;
	}
	public function SelectEventType($attributes="")
	{
		global $event_types;
		$select_event_types = $this->SelectBuild("event_types", $attributes, $event_types);
		return $select_event_types;
	}
	public function CreateEvent($name, $type, $game, $start, $finish, $teams, $players)
	{
		$insert  	= "INSERT INTO events (name, type, game, start_date, finish_date, created, teams, players_by_team) ";
		$insert		.= "VALUES ('$name', '$type', '$game', '$start', '$finish', NOW(), '$teams', '$players')";
		$result		= $this->db->query($insert);		
		$last_id	= $this->db->lastInsertId();
		$return		= ($last_id ? true : false);
		return $return;
	}
	public function EventAddPlayer($event, $player)
	{
		$insert	= "INSERT INTO event_players (event, player, created) VALUES ('$event', '$player', NOW())";
		$result		= $this->db->query($insert);		
		$last_id	= $this->db->lastInsertId();
		$return		= ($last_id ? true : false);
		return $return;
	}
	public function EventAddTeam($event, $team)
	{
		$insert	= "INSERT INTO event_teams (event, team, created) VALUES ('$event', '$team', NOW())";
		$result		= $this->db->query($insert);		
		$last_id	= $this->db->lastInsertId();
		$return		= ($last_id ? true : false);
		return $return;
	}
}
?>