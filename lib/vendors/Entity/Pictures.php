<?php 

namespace Entity ;

use \CRFram\Entity;

Class Pictures extends Entity {

	protected $ID;
	protected $alt; 
	protected $src;
	protected $item_id;
	protected $nb_picture;
	protected $picture_name;

	const ALT_INVALIDE = 1;
	const HREF_INVALIDE = 2;
	const NAME_INVALIDE = 3;

	public function getId() { return $this->ID; }
	public function Alt() { return $this->alt; }
	public function Src() { return $this->src; }
	public function Item_id() { return $this->item_id; }
	public function Nb_picture() { return $this->nb_picture; }
	public function Picture_name() { return $this->picture_name; }


  	public function isValid()
  	{
    	return !(empty($this->alt) || empty($this->href) || empty($this->item_id));
  	}

	public function setId($id) {

		$this->ID = (int) $ID; 
	}

	public function setNb_picture($nb_picture) {

		$this->nb_picture = (int) $nb_picture; 
	}

	public function setPicture_name($picture_name) {

		if (!is_string($picture_name) || empty($picture_name))
    	{
    		$erreur[] = self::NAME_INVALIDE;
    	}

		$this->picture_name = $picture_name; 
	}

	public function setAlt($alt) {

		if (!is_string($alt) || empty($alt))
    	{
    		$erreur[] = self::ALT_INVALIDE;
    	}

		$this->alt = $alt;
	}

	public function setSrc($src) {

		if (!is_string($src) || empty($src))
    	{
    		$erreurs[] = self::HREF_INVALIDE;
    	}

		$this->src = $src;
	}

	public function setItem_id($item_id) {

		$this->item_id = (int) $item_id; 
	}


}
