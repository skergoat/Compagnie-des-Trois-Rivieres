<?php

namespace Entity ;

use \CRFram\Entity;

Class Animations extends Entity {

	protected $ID;
	protected $ajax_id;
	protected $title; 
	protected $description;
	protected $published;
	protected $media;
	protected $video_url;

	const TITLE_INVALIDE = 1;
	const DESC_INVALIDE = 2;
	const MEDIA_INVALIDE = 2;
	
	public function getId() { return $this->ID; }
	public function Ajax_id() { return $this->ajax_id; }
	public function Title() { return $this->title; }
	public function Description() { return $this->description; }
	public function Published() { return $this->published; }
	public function Media() { return $this->media; }
	public function Video_url() { return $this->video_url; }


  	public function isValid()
  	{
    	return !(empty($this->title) || empty($this->description));
  	}

	public function setId($id) {

		$this->ID = (int) $id; 
	}

	public function setAjax_id($ajax_id) {

		$this->ajax_id = (int) $ajax_id; 
	}

	public function setTitle($title) {

		if(empty($title) || !is_string($title)) {

			$erreurs[] = self::TITLE_INVALIDE;
		}

	    $this->title = htmlspecialchars($title);
	}

	public function setDescription($description) {

		if(empty($description) || !is_string($description)) {

			$erreurs[] = self::DESC_INVALIDE;
		}

    	$this->description = $description;
	}

	public function setPublished($published) {

	  if($published == 'true') {

         $published = true;

      }
      else {

        $published = false;

      }
    	
    	$this->published = (int) $published;
	}

	public function setMedia($media) {

		if(empty($media) || !is_string($media)) {

			$erreurs[] = self::MEDIA_INVALIDE;
		}
    	
    	$this->media = $media;
	}

	public function setVideo_url($video_url) {

		$this->video_url = $video_url;

	}

}
