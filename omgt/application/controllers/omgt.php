<?php defined('SYSPATH') OR die('No direct access allowed.');
class Omgt_Controller extends Controller {

	public $theme;

	public function __construct()
	{
		$this->theme = new View('index');
		$this->theme->header	= new View('header');
		$this->theme->content	= '';
		$this->theme->footer	= new View('footer');
		parent::__construct();
	}

	public function index()
	{
		$this->theme->content = new View('main');
		$this->theme->render(TRUE);		
	}
	
}