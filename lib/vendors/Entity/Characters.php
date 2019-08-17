<?php

namespace Entity ;

use \CRFram\Entity;

Class characters extends Entity {

	protected $ID;
	protected $title; 
	protected $description;
	protected $picture_url;
	protected $picture_alt;

	const TITRE_INVALIDE = 1;
	const DESC_INVALIDE = 2;
	const URL_INVALIDE = 3;
	const ALT_INVALIDE = 4;

	public function getId() { return $this->ID; }
	public function Title() { return $this->title; }
	public function Description() { return $this->description; }
	public function Picture_url() { return $this->picture_url; }
	public function Picture_alt() { return $this->picture_alt; }


  	public function isValid()
  	{
    	return !(empty($this->title) || empty($this->description));
  	}

	public function setId($id) {

		$this->ID = (int) $id; 
	}

	public function setTitle($title) {

		if(!is_string($title) || empty($title)) {

			$erreurs[] = self::TITRE_INVALIDE;
		}


	    $this->title = htmlspecialchars($title);
	}

	public function setDescription($description) {

		if(!is_string($description) || empty($description)) {

			$erreurs[] = self::DESC_INVALIDE;
		}

    	$this->description = $description;
	}

	public function setPicture_url($picture_url) {

		if(!is_string($picture_url) || empty($picture_url)) {

			$erreurs[] = self::URL_INVALIDE;
		}

    	$this->picture_url = $picture_url;
	}

	public function setPicture_alt($picture_alt) {

		if(!is_string($picture_alt) || empty($picture_alt)) {

			$erreurs[] = self::ALT_INVALIDE;
		}

    	$this->picture_alt = $picture_alt;
	}

	
}
