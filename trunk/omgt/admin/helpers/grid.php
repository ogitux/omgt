<?php defined('SYSPATH') or die('No direct script access.');
 
class grid_Core {
 	protected static $columns = array();
 	protected static $styles  = array();
 	protected static $labels  = array();
 
	public static function add_column($column)
	{
		array_push(grid::$columns, $column['field']);
		grid::$styles[$column['field']] = 'table-row-'. ( isset($column['align']) ? $column['align'] : 'left' );
		grid::$labels[$column['field']] = ( isset($column['label']) ? $column['label'] : $column['field']);
	}
	
	public static function create_grid($collection, $per_page)
	{
		$grid = '<table class="table-grid">';
		$grid .= '<thead>';
		$grid .= '<tr>';
		foreach (grid::$columns as $column)
		{
			$grid .= '<th>'.grid::$labels[$column].'</th>';
		}	
		$grid .= '<th colspan="2">Acciones</th>';			
		$grid .= '</tr>';	
		$grid .= '</thead>';		

		$grid .= '<tbody>';
		foreach ($collection->find_all() as $item)
		{
			$grid .= '<tr>';
			foreach (grid::$columns as $column)
			{
				$grid .= '<td class="'.grid::$styles[$column].'">'.$item->{$column}.'</td>';
			}
			$grid .= '<td>Edit</td>';
			$grid .= '<td>Delete</td>';
			$grid .= '</tr>';			
		}
		$grid .= '</tbody>';
		
		$grid .= '<tfoot>';
		$grid .= '<tr><td colspan="'.( count(grid::$columns) +2).'" class="table-row-right">';
		$grid .= Pagination::factory(array
			(
			    'style' => 'classic',
			    'items_per_page' => $per_page,
			    'query_string' => 'page',
			    'total_items' => $collection->count_last_query()
			));	
		$grid .= '</td></tr>';
		$grid .= '</tfoot>';
		
		$grid .= '</table>';
		return $grid;
	}
}
 
