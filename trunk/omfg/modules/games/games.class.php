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
	public function SelectGameFormat($attributes="")
	{
		global $game_formats;
		$select_game_formats = $this->SelectBuild("game_formats", $attributes, $game_formats);
		return $select_game_formats;
	}
}
?>