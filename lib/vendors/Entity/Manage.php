<?php

namespace Entity ;

use \CRFram\Entity;

Class Manage extends Entity {

	protected $ID;
	protected $name;
	protected $password;
	protected $mail;
	
	const NAME_INVALIDE = 1;
	const PASS_INVALIDE = 2;
	const MAIL_INVALIDE = 3;
	
	public function getId() { return $this->ID; }
	public function Name() { return $this->name; }
	public function Password() { return $this->password; }
	public function Mail() { return $this->mail; }
	

  	public function isValid()
  	{
    	return !(empty($this->name) || empty($this->password) || empty($this->mail));
  	}

	public function setId($id) {

		$this->ID = (int) $id; 
	}

	public function setName($name) {

		if(!is_string($name) || empty($name)) {

			$erreurs[] = self::NAME_INVALIDE;
		}

		$this->name = $name; 
	}

	public function setPassword($password) {

		if(!is_string($password) || empty($password)) {

			$erreurs[] = self::PASS_INVALIDE;
		}

		$this->password = $password; 
	}

	public function setMail($mail) {

		if(!is_string($mail) || empty($mail)) {

			$erreurs[] = self::MAIL_INVALIDE;
		}

		$this->mail = $mail; 
	}

}