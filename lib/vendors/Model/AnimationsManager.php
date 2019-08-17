<?php
namespace Model;

use \CRFram\Manager;
use \Entity\Animations;

abstract class animationsManager extends Manager
{


  /**
   *
   *  update animation
   *
   */
  abstract protected function update(Animations $animations);

  /**
   *
   *  add animation
   *
   */
  abstract public function add(Animations $animations);

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
  public function save(Animations $animations)
  {
      $this->update($animations);
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

  /**
  *
  * delete single animation 
  *
  **/
  abstract public function delete($id);

}