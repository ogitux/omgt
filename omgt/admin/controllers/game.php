<?php defined('SYSPATH') OR die('No direct access allowed.');
class Game_Controller extends Admin_Controller {
	
	public function index() 
	{
		$this->theme->content = new View('game/index');
		
		$games = ORM::factory('game')->find_all();
		$game_list = '<ol>';
		foreach ($games as $game)
		{
			$game_list .= '<li>'.$game->name.' - (<a href="/admin/game/edit/'.$game->id.'">Edit</a> - <a href="/admin/game/delete/'.$game->id.'">Delete</a>)</li>';
		}
		$game_list .= '</ol>';
		
		$scenarios = ORM::factory('scenario')->find_all();
		grid::add_column('id');
		grid::add_column('name');
		
/*		$scenario_list = '<ol>';
		foreach ($scenarios as $scenario)
		{
			$scenario_list .= '<li>'.$scenario->name.' - (<a href="/admin/scenario/edit/'.$scenario->id.'">Edit</a> - <a href="/admin/scenario/delete/'.$scenario->id.'">Delete</a>)</li>';
		}
		$scenario_list .= '</ol>';
*/
		
		$this->theme->content->game_list = $game_list;
		$this->theme->content->scenario_list = grid::create_grid($scenarios);
		$this->theme->render(TRUE);
	}

	public function view($id = FALSE) 
	{
		if (!$id) {
		}
		else {
			
		}
	}	
	
	public function create()
	{
		$this->save();
		
		$this->theme->content = new View('game/create');
		$this->theme->render(TRUE);
	}
	
	public function edit( $id )
	{
		if ($this->input->post()) {
			$this->save($id);
		}
		$game = ORM::factory('game', $id);
		
		$this->theme->content = new View('game/edit');
		$this->theme->content->id	= $game->id;
		$this->theme->content->name	= $game->name;
		$this->theme->render(TRUE);
	}
	
	public function save($id = FALSE) 
	{
		if ($post = $this->input->post()) {
			if (isset($post['id'])) {
				$id = $post['id'];	
			}
			$game = ORM::factory('game', $id);
			$game->name		= $post['name'];
			$game->created	= date('Y-m-d h:i:s');
			
			if ($game->validate($post)) {
				$game->save();
				$msg = 'Game Saved!';
				$type = 'success';	
			}
			else {
				$msg = '<ul>';
				foreach ($post->errors() as $key => $value) 
				{
					$msg .= '<li><strong>'.$key.' :</strong> '.$value.'</li>';
				}
				$msg .= '</ul>';
				$type = 'error';
			}
			$this->session->set_flash('messages',array('type' => $type, 'msg' => $msg));
			url::redirect('game');
		}
	}
	
	public function delete( $id = FALSE ) 
	{
		if ($id) {
			$game	= ORM::factory('game', $id);
			if ($game->delete()) {
				$msg	= 'Game deleted';
				$type	= 'success';	
			}
			else {
				$msg	= 'Error deleting';
				$type	= 'error';
			}	
		}
		else {
			$msg	= 'There is no ID';
			$type	= 'error';
		}

		$this->session->set_flash('messages',array('type' => $type, 'msg' => $msg));
		url::redirect('game');
	}
}