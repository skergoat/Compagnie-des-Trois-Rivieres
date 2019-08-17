<?php
namespace Model;

use \CRFram\Manager;
use \Entity\Recover;

abstract class RecoverManager extends Manager
{

  /**
  *
  * save code 
  * 
  **/
  abstract public function save($code);

  /**
  *
  * Remove codes after two minutes if not used
  *   
  **/
  abstract public function removeCodeAfter();

  /** 
  * Verify if recover code and email exist in bdd 
  **/
  abstract public function verifyCode($code);

  /**
  * Remove recover code from bdd when used
  **/
  abstract public function removeCode($code);  

}