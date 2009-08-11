<?php defined('SYSPATH') OR die('No direct access allowed.');
class Scenario_Controller extends Admin_Controller {
	
	public function index() 
	{
		url::redirect('game');
	}

	public function create()
	{
		$this->save();
		
		$games = ORM::factory('game');
		$games_list	= $games->select_list('id','name');
		
		$this->theme->content = new View('scenario/create');
		$this->theme->content->select_game = form::dropdown('game_id', $games_list);
		$this->theme->render(TRUE);
	}
	
	public function edit( $id )
	{
		if ($this->input->post()) {
			$this->save($id);
		}
		$game = ORM::factory('scenario', $id);
		
		$this->theme->content = new View('scenario/edit');
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
			$game = ORM::factory('scenario', $id);
			$game->name		= $post['name'];
			$game->game_id	= $post['game_id'];
			$game->created	= date('Y-m-d h:i:s');
			
			if ($game->validate($post)) {
				$game->save();
				$msg = 'Scenario Saved!';
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
			$game	= ORM::factory('scenario', $id);
			if ($game->delete()) {
				$msg	= 'Scenario deleted';
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