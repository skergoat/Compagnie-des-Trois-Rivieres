<?php
namespace Model;

use \CRFram\Manager;
use \Entity\Manage;

abstract class ManageManager extends Manager
{

  /**
  *
  * add admin 
  *
  **/
  abstract protected function add(Manage $manage);

  /**
  *
  * upate admin 
  *
  **/
  abstract protected function update(Manage $manage);


  /**
  *
  * save method for formHandler 
  *
  **/
  public function save(Manage $manage)
  {

    if ($manage->isValid())
    {
      $manage->isNew() ? $this->add($manage) : $this->update($manage);
    }
    else
    {
      throw new \RuntimeException('L\'admin doit être validé pour être enregistré');
    }
  }

  /**
  *
  * get unique admin 
  *
  **/
  abstract public function getUnique($id);

  /**
  *
  *   get entity by password in order to verify it 
  *
  **/
  abstract public function getUniqueByLogin($login);

  /**
  *
  * get password by mail in orer to recover it 
  *
  **/
  abstract public function getUniqueByMail($mail);

  /**
  *
  * verify if credentials already exists in bdd 
  *
  **/
  abstract public function verifInfo($action, $id);
 
  /**
  *
  *   verify if if admin exsits and get password by login 
  *
  **/
  abstract public function countLogin($login);

  /**
  *
  * verify if admin exists and get password by mail
  *
  **/
  abstract public function countMail($mail);

  /**
  *
  * get List of admins 
  *
  **/
  abstract public function getList();

  /**
  *
  * paginate 
  *
  **/
  abstract public function getPaginate($premiereEntree, $messageTotal);

  /**
  *
  * count total of rows in bdd in order to paginate 
  *
  **/
  abstract public function countTotal();

  /**
  *
  * delete single admin 
  *
  **/
  abstract public function delete($id);

}