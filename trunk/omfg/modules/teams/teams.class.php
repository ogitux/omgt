<?php
/**
 * teams.class.php
 */
class teams extends Omg
{
	public function GetAllTeams($wheres=NULL, $orders="name")
	{
		$query	= "SELECT id, name FROM teams ";
		if ($wheres)
		{
			$query .= "WHERE $wheres";
		}
		$query .= "ORDER BY $orders";
		$result	= $this->db->query($query);
		$return = $result->fetchAll(PDO::FETCH_ASSOC);
		return $return;	
	}
	public function SelectTeam($attributes="")
	{
		foreach ($this->GetAllTeams() as $team)
		{
			$teams[$team["id"]] = $team["name"];
		}
		$select_teams = $this->SelectBuild("teams", $attributes, $teams);
		return $select_teams;
	}
	public function CreateTeam($game, $name, $tag, $players)
	{
		$insert  	= "INSERT INTO teams (game, name, tag, date_creation) ";
		$insert		.= "VALUES ('$game', '$name', '	$tag', NOW())";
		$result		= $this->db->query($insert);		
		$last_id	= $this->db->lastInsertId();
		
		foreach ($players as $player)
		{
			$insert_player  = "INSERT INTO team_players (team, player) ";
			$insert_player .= "VALUES ('$last_id', '$player')";
			$result_player = $this->db->query($insert_player);		
		}
		
		$return		= ($last_id ? true : false);
		return $return;
	} 
}
?>