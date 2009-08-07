<?php defined('SYSPATH') OR die('No direct access allowed.');
class Tournament_Controller extends Omgt_Controller {
	
	public function index() 
	{
		$this->theme->content = new View('tournament/index');

		$games = ORM::factory('tournament')->find_all();
		$list = '<ol>';
		foreach ($games as $game)
		{
			$list .= '<li>'.$game->name.' - (<a href="/index.php/game/edit/'.$game->id.'">Edit</a> - <a href="/index.php/game/delete/'.$game->id.'">Delete</a>)</li>';
		}
		$list .= '</ol>';
		
		$this->theme->content->list = $list;
		$this->theme->render(TRUE);
	}

	public function create()
	{
		$this->save();
		$games = ORM::factory('game');
		$games_list	= $games->select_list('id','name');
		
		$this->theme->content = new View('tournament/create');
		$this->theme->content->select_game = form::dropdown('tournament_game', $games_list);
		$this->theme->render(TRUE);
	}
	
	public function edit( $id )
	{
		if ($this->input->post()) {
			$this->save($id);
		}
		$game = ORM::factory('game', $id);
		
		$view = new View('tournament/edit');
		$view->id	= $game->id;
		$view->name	= $game->name;
		$view->render(TRUE);	
	}
	
	public function save($id = FALSE) 
	{
		if ($post = $this->input->post()) {
			$tournament 			= ORM::factory('tournament', $post['id']);
			$tournament->name		=  $_POST['name'];
			$tournament->created	= date('Y-m-d h:i:s');
			
			if ($tournament->validate($post)) {
				$game->save();	
				echo 'Tournament Saved!';
			}
			else {
				echo '<ul>';
				foreach ($post->errors() as $key => $value) 
				{
					echo '<li><strong>'.$key.' :</strong> '.$value.'</li>';
				}
				echo '</ul>';
			}
			
		}
	}
	
	public function delete( $id = FALSE ) 
	{
		if ($id) {
			$tournament	= ORM::factory('tournament', $id);
			if ($tournament->delete()) {
				echo 'Tournament deleted';	
			}
			else {
				echo 'Error deleting';
			}	
		}
		else {
			echo 'There is no ID';
		}
		echo '<br />';
		echo '<a href="/index.php/tournament/">Regresar</a>';
	}
}