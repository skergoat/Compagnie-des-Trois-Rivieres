<?php

namespace Model;

use \CRFram\Manager;
use \Entity\Pictures;

abstract class PicturesManager extends Manager
{
 	
  /**
  *
  *		create empty main picture when create article
  *
  **/
  abstract public function createMain(Pictures $pictures, $module);

  /**
  *
  *		update main picture 
  *
  **/
  abstract public function updateMainPicture(Pictures $pictures, $module);

  /**
  *
  * get main picture
  *
  **/
  abstract public function getUnique($module, $item_id); 

  /**
  *
  * delete picture and row in table 
  *
  **/
  abstract public function deleteMain($item_id, $module);

   /**
  *
  *   create empty slider when create article
  *
  **/
  abstract public function createSlider(Pictures $pictures, $module);

  /**
  *
  * get unique slider picture 
  *
  **/
  abstract public function getUniqueSlide($i, $module, $item_id, $action);

  /**
  *
  *   get all Slider Pictures 
  *
  **/
  abstract public function getPicturesSlider($item_id, $module, $app);

  /**
  *
  *		update single slide 
  *
  **/
  abstract public function updateSlider(Pictures $pictures, $module, $id); 

  /**
  *
  * Check if picture exists 
  *
  **/
  abstract public function countSlides($module, $item_id);

  /**
  *
  * delete slides 
  *
  **/
  abstract public function deleteSlider($id, $module);

}