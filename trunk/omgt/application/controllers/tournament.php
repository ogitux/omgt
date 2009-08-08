<?php defined('SYSPATH') OR die('No direct access allowed.');
class Tournament_Controller extends Omgt_Controller {
	
	public function index() 
	{
		$this->theme->content = new View('tournament/index');

		$games = ORM::factory('tournament')->find_all();
		$list = '<ol>';
		foreach ($games as $game)
		{
			$list .= '<li>'.$game->name.' - (<a href="/tournament/edit/'.$game->id.'">Edit</a> - <a href="/tournament/delete/'.$game->id.'">Delete</a>)</li>';
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
		
		$tournament = ORM::factory('tournament', $id);

		$games = ORM::factory('game');
		$games_list	= $games->select_list('id','name');
		
		$this->theme->content = new View('tournament/edit');
		$this->theme->content->id			= $tournament->id;
		$this->theme->content->name			= $tournament->name;
		$this->theme->content->select_game	= form::dropdown('tournament_game', $games_list, $tournament->game_id);
		$this->theme->content->begin_date	= date('d-m-Y',strtotime($tournament->begin_date));
		$this->theme->content->end_date		= date('d-m-Y',strtotime($tournament->end_date));
		$this->theme->render(TRUE);	
	}
	
	public function save($id = FALSE) 
	{
		if ($post = $this->input->post()) {
			$tournament 			= ORM::factory('tournament', $id);
			$tournament->game_id	= $post['tournament_game'];
			$tournament->name		= $post['name'];
			$tournament->begin_date	= date('Y-m-d h:i:s',strtotime($post['begin_date']));
			$tournament->end_date	= date('Y-m-d h:i:s',strtotime($post['end_date']));
			$tournament->created	= date('Y-m-d h:i:s');
			
			if ($tournament->validate($post)) {
				$tournament->save();
				$msg	= 'Tournament Saved!';
				$type	= 'success';
			}
			else {
				$msg = '<ul>';
				foreach ($post->errors() as $key => $value) 
				{
					$msg .= '<li><strong>'.$key.' :</strong> '.$value.'</li>';
				}
				$msg .= '</ul>';
				$type	= 'error';
			}
			$this->session->set('messages',array('type' => $type, 'msg' => $msg));
			url::redirect('tournament');
		}
	}
	
	public function delete( $id = FALSE ) 
	{
		if ($id) {
			$tournament	= ORM::factory('tournament', $id);
			if ($tournament->delete()) {
				$msg	= 'Tournament deleted';
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
		$this->session->set('messages',array('type' => $type, 'msg' => $msg));
		url::redirect('tournament');
	}
	
}