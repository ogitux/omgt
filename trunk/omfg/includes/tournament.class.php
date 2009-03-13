<?php
/**
 * Tournament.class.php
 */

class Tournament 
{
	var $db;
	
	public function __construct()
	{
		$this->ConnectDb();
	}
	
	private function ConnectDb()
	{
		$dsn = "mysql:dbname=". DB_NAME .";host=". DB_HOST;
		try {
		    $this->db = new PDO($dsn, DB_USER, DB_PASS);
		} catch (PDOException $e) {
		    echo 'Connection failed: ' . $e->getMessage();
		    exit;
		}
	}
	
	public function LoadModules()
	{
		$query = "SELECT class_name FROM modules WHERE enabled=1 ORDER BY class_name";
		$result = $this->db->query($query);
		foreach ($result->fetchAll(PDO::FETCH_BOTH) as $module)
		{
			$module = $module["class_name"];
			// Instancio clase eventos
			require_once(MOD_DIR . "/$module/$module.class.php");
			$this->{$module} = new $module;
		}
	}
	
	public function SelectBuild($id, $attributes, $options, $selected_option=NULL)
	{
		$select = "<select id=\"$id\" name=\"$id\" $attributes>\n";
		foreach ($options as $option_id => $option_value)
		{
			$selected = ($selected_option==$option_id ? "selected=\"selected\"" : "" );
			$select .= "<option value=\"$option_id\" $selected>$option_value</option>\n";
		}
		$select .= "</select>";
		return $select;
	}
}
?>