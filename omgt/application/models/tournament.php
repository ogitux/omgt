<?php
class Tournament_Model extends ORM {
	protected $has_one = array('game');
}