<?php
/**
 * players.class.php
 */
class players extends Tournament
{
	public function GetAllPlayers()
	{
		$query	= "SELECT id, nick FROM players ORDER BY nick";
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
	public function CreatePlayer($name, $nick, $email, $password)
	{
		$password	= md5($password);
		$insert  	= "INSERT INTO players (name, nick, email, password, date_creation) ";
		$insert		.= "VALUES ('$name', '$nick', '	$email', '$password', NOW())";
		$result		= $this->db->query($insert);		
		$last_id	= $this->db->lastInsertId();
		$return		= ($last_id ? true : false);
		return $return;
	} 
}
?>