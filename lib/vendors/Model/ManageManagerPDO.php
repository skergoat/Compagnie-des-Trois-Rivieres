<?php
namespace Model;

use \Entity\Manage;

class ManageManagerPDO extends ManageManager
{

	protected function add(Manage $manage)
  {
    $requete = $this->dao->prepare('INSERT INTO manage SET name = :name, password = :password, mail = :mail');
    
    $requete->bindValue(':name', $manage->Name());
    $requete->bindValue(':password', password_hash($manage->Password(), PASSWORD_DEFAULT));
    $requete->bindValue(':mail', $manage->Mail());
    
    $requete->execute();
  }


  protected function update(Manage $manage)
  {
    $requete = $this->dao->prepare('UPDATE manage SET name = :name, password = :password, mail = :mail WHERE ID = :id');
    
    $requete->bindValue(':name', $manage->Name());
    $requete->bindValue(':password', password_hash($manage->Password(), PASSWORD_DEFAULT));
    $requete->bindValue(':mail', $manage->Mail());
    $requete->bindValue(':id', $manage->getId(), \PDO::PARAM_INT);
    
    $requete->execute();
  }


  public function getUnique($id)
  {
    $requete = $this->dao->prepare('SELECT * FROM manage WHERE ID = :id');
    $requete->bindValue(':id', (int) $id, \PDO::PARAM_INT);
    $requete->execute();
    
    $requete->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\Manage');
    
    if ($animations = $requete->fetch())
    { 
      return $animations;
    }
    
    return null;
  }


  public function getUniqueByLogin($login) {

    $sql = "SELECT * FROM manage WHERE name = '" . $login . "'";;

    $requete = $this->dao->prepare($sql);
    $requete->execute();
    
    $requete->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\Manage');
    
    if ($animations = $requete->fetch())
    { 
      return $animations;
    }
    
    return null;

  }


  public function getUniqueByMail($mail) {

      $sql = "SELECT * FROM manage WHERE mail = '" . $mail . "'";

      $requete = $this->dao->prepare($sql);
      $requete->execute();
      
      $requete->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\Manage');
      
      if ($animations = $requete->fetch())
      { 
        return $animations;
      }
      
      return null;
  }


  public function verifInfo($action, $id){

    if($action == 'create') {

      $reponse = $this->dao->query('SELECT * FROM manage');

    } else {

       $sql = 'SELECT * FROM manage WHERE ID != ' . $id;

       $reponse = $this->dao->query($sql);
    }

    return $reponse;
  }


  public function countLogin($login)
  {
      $sql = "SELECT * FROM manage WHERE name = '" . $login . "'" ;

      $query = $this->dao->prepare($sql);

      $query->execute();

      if ($query->rowCount() == 1) {
          return true;
      } else {
          return false;
      }
  }


  public function countMail($mail) {

      $sql = "SELECT * FROM manage WHERE mail = '" . $mail . "'";

      $query = $this->dao->prepare($sql);

      $query->execute();

       if ($query->rowCount() == 1) {
          return true;
      } else {
          return false;
      }
  }



  public function getList()
  {
    $sql = 'SELECT * FROM manage ORDER BY ID';
    
    $requete = $this->dao->query($sql);
    $requete->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\Manage');
    
    $listeNews = $requete->fetchAll();
    
    $requete->closeCursor();
    
    return $listeNews;
  }

   
  public function getPaginate($premiereEntree, $messageTotal){

    $animations = [];

    $listMessage = $this->dao->query('SELECT * FROM manage ORDER BY ID ASC LIMIT ' . $premiereEntree . ', ' . $messageTotal);

    while($messages = $listMessage->fetch()){

      $animations[] = new Manage($messages);
    }

    return $animations;
  }

  
  public function countTotal() {

    $pagination = $this->dao->query('SELECT COUNT(*) FROM manage');

    $donnee = $pagination->fetch();
    
    return $donnee;
  }


  public function delete($id)
  {
    $this->dao->exec('DELETE FROM manage WHERE ID = '.(int) $id);
  }
}