<?php
namespace Model;

use \CRFram\Manager;
use \Entity\Prejudices;

abstract class PrejudicesManager extends Manager
{


  /**
   *
   *  update animation
   *
   */
  abstract protected function update(Prejudices $prejudices);

   /**
   *
   *  add animation
   *
   */
  abstract public function add(Prejudices $prejudices);

  /**
   * 
   * get all animations 
   *
   **/
  abstract public function getAll($where);

  /**
   *
   *  get single animation 
   *
   */
  abstract public function getUnique($id);

  /**
  *
  * for formHandler 
  *
  **/
  public function save(Prejudices $prejudices)
  {
      $this->update($prejudices);
  }

  /**
  * 
  * return the lowest id of a table
  *
  **/
  abstract public function LowId(); 

  /**
  * 
  * return the highest id of a table
  *
  **/
  abstract public function HighId();

  /**
  *
  * pagination on Module index page 
  *
  **/
  abstract  public function getPaginate($premiereEntree, $messageTotal, $where);

  /**
  *
  * count total of rows in order to paginate 
  *
  **/
  abstract  public function countTotal();

  /**
  *
  * know if table is empty 
  *
  **/
  abstract public function countTable();

   /**
   *
   *  upate ajax id and position in frontend slider 
   *
   */
  abstract public function updateAjax($ajax_id, $id);

  /**
  *
  * get the highest 'ajax id' to calculate position of the slides in frontend slider 
  *  
  *
  **/
  abstract public function HighAjax();

  /**
  *
  * get the lowest 'ajax id' to calculate position of the slides in frontend slider
  *
  **/
  abstract public function LowAjax();

 /**
  *
  * get frontend page by ajax id (in order to load them in ajax after load them in PHP)
  *
  **/
  abstract public function getUniqueByAjax($ajax_id);
 
  /*
  *
  * delete single page 
  *
  **/
  abstract public function delete($id);

}