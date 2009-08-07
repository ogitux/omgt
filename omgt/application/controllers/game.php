<?php defined('SYSPATH') OR die('No direct access allowed.');
class Game_Controller extends Omgt_Controller {
	
	public function index() 
	{
		$this->theme->content = new View('game/index');
		
		$games = ORM::factory('game')->find_all();
		$list = '<ol>';
		foreach ($games as $game)
		{
			$list .= '<li>'.$game->name.' - (<a href="/index.php/game/edit/'.$game->id.'">Edit</a> - <a href="/index.php/game/delete/'.$game->id.'">Delete</a>)</li>';
		}
		$list .= '</ol>';
		
		$this->theme->content->list = $list;
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
			$game->name		=  $_POST['name'];
			$game->created	= date('Y-m-d h:i:s');
			if ($game->validate($post)) {
				$game->save();	
				$this->session->set_flash('messages',array('type' => 'success', 'msg' => 'Game Saved!'));
			}
			else {
				$msg = '<ul>';
				foreach ($post->errors() as $key => $value) 
				{
					$msg .= '<li><strong>'.$key.' :</strong> '.$value.'</li>';
				}
				$msg .= '</ul>';
				$this->session->set_flash('messages',array('type' => 'error', 'msg' => $msg));
			}
			
		}
	}
	
	public function delete( $id = FALSE ) 
	{
		if ($id) {
			$game	= ORM::factory('game', $id);
			if ($game->delete()) {
				echo 'Game deleted';	
			}
			else {
				echo 'Error deleting';
			}	
		}
		else {
			echo 'There is no ID';
		}
		echo '<br />';
		echo '<a href="/index.php/game/">Regresar</a>';
	}
}