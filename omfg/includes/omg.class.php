<?php
/**
 * Omg.class.php
 * 
 * This is a web app (PHP/MySQL) for game tournament management, this app can be used with any kind of game from consoles and computers. You only need to have a web server running PHP and MySQL ;) 
 * 
 * @author: aveliz
 * @version: 0.0.4
 * @license: Code : GNU General Public License v3 - Content: Creative Commons 3.0 BY 
 * 
 * This file is part of OMG : Open Manager for Gaming.
 *     
 * OMG is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 * 
 * OMG is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 * 
 * You should have received a copy of the GNU General Public License
 * along with OMG.  If not, see <http://www.gnu.org/licenses/>.
 */

class Omg 
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