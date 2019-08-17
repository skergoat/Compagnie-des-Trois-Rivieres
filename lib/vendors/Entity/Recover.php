<?php

namespace Entity ;

use \CRFram\Entity;

Class Recover extends Entity {

	protected $ID;
	protected $code;
		
	public function getId() { return $this->ID; }
	public function Code() { return $this->code; }


  	public function isValid()
  	{
    	return !(empty($this->title) || empty($this->description));
  	}

	public function setId($id) {

		$this->ID = (int) $id; 
	}

	public function setCode($code) {

		$this->code = (int) $code; 
	}


}
