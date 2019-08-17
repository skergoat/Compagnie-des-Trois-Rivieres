<?php

namespace Entity ;

use \CRFram\Entity;

Class Workshops extends Entity {

	protected $ID;
	protected $title; 
	protected $description;
	protected $published;
	protected $media;
	protected $video_url;
	protected $ajax_id;

	const TITRE_INVALIDE = 1;
	const DESC_INVALIDE = 2;
	const MEDIA_INVALIDE = 3;
	const VIDEO_INVALIDE = 4;
	
	public function getId() { return $this->ID; }
	public function Title() { return $this->title; }
	public function Description() { return $this->description; }
	public function Published() { return $this->published; }
	public function Media() { return $this->media; }
	public function Video_url() { return $this->video_url; }
	public function Ajax_id() { return $this->ajax_id; }


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

		if(!is_string($media) || empty($media)) {

			$erreurs[] = self::MEDIA_INVALIDE;
		}
    	
    	$this->media = $media;
	}

	public function setVideo_url($video_url) {

		if(!is_string($video_url) || empty($video_url)) {

			$erreurs[] = self::VIDEO_INVALIDE;
		}

		$this->video_url = $video_url;

	}

}
