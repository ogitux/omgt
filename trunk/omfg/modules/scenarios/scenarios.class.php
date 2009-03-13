<?php
/**
 * scenarios.class.php
 */
class scenarios extends Omg
{
	public function GetAllScenarios()
	{
		$query	 = "SELECT s.id, g.name as 'game', s.name FROM scenarios s ";
		$query	.= "INNER JOIN games g ON g.id=s.game ";
		$query  .= "ORDER BY s.name";

		$result	= $this->db->query($query);
		$return = $result->fetchAll(PDO::FETCH_ASSOC);
		return $return;	
	}
	
	public function CreateScenario($name, $game, $description=NULL)
	{
		$insert  	= "INSERT INTO scenarios (name, game, description, created) ";
		$insert		.= "VALUES ('$name', '$game', '$description', NOW())";
		$result		= $this->db->query($insert);		
		$last_id	= $this->db->lastInsertId();
		$return		= ($last_id ? true : false);
		return $return;
	} 
}
?>