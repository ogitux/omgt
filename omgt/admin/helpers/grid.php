<?php defined('SYSPATH') or die('No direct script access.');
 
class grid_Core {
 	protected static $columns = array();
 
	public static function add_column($column)
	{
		array_push(grid::$columns, $column);
	}
	
	public static function create_grid($collection)
	{
		$grid = '<table>';
		$grid .= '<tr>';
		foreach (grid::$columns as $column)
		{
			$grid .= '<td>'.$column.'</td>';
		}	
		$grid .= '</tr>';			

		foreach ($collection as $item)
		{
			$grid .= '<tr>';
			foreach (grid::$columns as $column)
			{
				$grid .= '<td>'.$item->{$column}.'</td>';
			}
			$grid .= '</tr>';			
		}
		
		$grid .= '</table>';
		return $grid;
	}
}
 
