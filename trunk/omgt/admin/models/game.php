<?php
class Game_Model extends ORM {
	
	protected $belongs_to = array('tournament');
	
	public function __construct($id = FALSE)
	{
		parent::__construct($id);
	}
	
	public function validate(array & $array, $save = FALSE)
	{
		$array = Validation::factory($array)
				->pre_filter('trim')
				->add_rules('name', 'required', array($this, '_name_exists'));
 
		return parent::validate($array, $save);
	}


	public function _name_exists($name)
	{
		return (bool) ! $this->db->where(array('name' => $name, 'id !=' => $this->id))->count_records($this->table_name);
	}
	
}