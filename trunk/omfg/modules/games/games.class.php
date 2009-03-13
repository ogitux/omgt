<?php
/**
 * Games.class.php
 */
class games extends Omg
{
	public function SelectGame($attributes="")
	{
		$query = "SELECT id, name FROM games ORDER BY name";
		$result = $this->db->query($query);
		foreach ($result->fetchAll(PDO::FETCH_ASSOC) as $game)
		{
			$games[$game["id"]] = $game["name"];
		}
		$select_games = $this->SelectBuild("game", $attributes, $games);
		return $select_games;
	}
}
?>