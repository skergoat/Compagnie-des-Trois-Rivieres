<?php
namespace Model;

use \Entity\Recover;

class RecoverManagerPDO extends RecoverManager
{
	public function save($code) {

	    $requete = $this->dao->prepare('INSERT INTO recover(code, date_add, date_remove) VALUES(?, NOW(), DATE_ADD(date_add, INTERVAL 2 MINUTE))'); 
	    $requete->execute(array($code));
  	}

  	
	public function removeCodeAfter() {

		$this->dao->query('DELETE FROM recover WHERE NOW() > date_remove');
	}


	public function verifyCode($code) {

	    return (bool) $this->dao->query('SELECT COUNT(*) FROM recover WHERE code = ' . $code)->fetchColumn();
	}

	public function removeCode($code) {

		$sql = 'DELETE FROM recover WHERE code = ' . $code;

		$removeCode = $this->dao->prepare($sql) or die(print_r($bdd->errorMesssage()));

		$removeCode->execute();
	}

}


