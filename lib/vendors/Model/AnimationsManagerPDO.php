<?php
namespace Model;

use \Entity\Animations;

class AnimationsManagerPDO extends AnimationsManager
{

  public function update(Animations $animations)
  {

    $requete = $this->dao->prepare('UPDATE animations SET ajax_id = :ajax_id, title = :title, description = :description, published = :published, media = :media, video_url = :video_url WHERE ID = :id');
    
    $requete->bindValue(':title', $animations->Title());
    $requete->bindValue(':description', $animations->Description());
    $requete->bindValue(':published', $animations->Published());
    $requete->bindValue(':media', $animations->Media());
    $requete->bindValue(':video_url', $animations->Video_url());
    $requete->bindValue(':ajax_id', $animations->Ajax_id(), \PDO::PARAM_INT);
    $requete->bindValue(':id', $animations->getId(), \PDO::PARAM_INT);
    
    $requete->execute();
  }

  public function add(Animations $animations)
  {
    $requete = $this->dao->prepare('INSERT INTO animations SET title = :title, description = :description, ajax_id = :ajax_id');

    $requete->bindValue(':title', $animations->Title());
    $requete->bindValue(':description', $animations->Description());
    $requete->bindValue(':ajax_id', $animations->Ajax_id(), \PDO::PARAM_INT);
    
    $requete->execute();
  }


  public function getAll($where)
  {
    $sql = 'SELECT ID, title, description, ajax_id FROM animations ' . $where;
    
    $requete = $this->dao->query($sql);
    $requete->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\Animations');
    
    $listeAnimations = $requete->fetchAll();
    
    $requete->closeCursor();
    
    return $listeAnimations;
  }


  public function getUnique($id)
  {
    $requete = $this->dao->prepare('SELECT * FROM animations WHERE ID = :id');
    $requete->bindValue(':id', (int) $id, \PDO::PARAM_INT);
    $requete->execute();
    
    $requete->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\Animations');
    
    if ($code = $requete->fetch())
    { 
      return $code;
    }
    
    return null;
  }


  public function HighId() {

    $sql = "SELECT MAX(ID) FROM animations";

    $requete = $this->dao->query($sql);

    $return = $requete->fetchColumn();

    return $return;

  }


  public function LowId() {

    $sql = "SELECT MIN(ID) FROM animations";

    $requete = $this->dao->query($sql);

    $return = $requete->fetchColumn();

    return $return;

  }

   public function getPaginate($premiereEntree, $messageTotal, $where){

    $animations = [];

    if($where == NULL) {

      $sql = 'SELECT * FROM animations ORDER BY ID ASC LIMIT ' . $premiereEntree . ', ' . $messageTotal;
    }
    else {

      $sql = 'SELECT * FROM animations ' . $where . ' ORDER BY ID ASC LIMIT ' . $premiereEntree . ', ' . $messageTotal;
    }

    $listMessage = $this->dao->query($sql);

    while($messages = $listMessage->fetch()){

      $animations[] = new Animations($messages);
    }

    return $animations;
  }


  public function countTotal() {

    $pagination = $this->dao->query('SELECT COUNT(*) FROM animations');

    $donnee = $pagination->fetch();
    
    return $donnee;
  }
 

  public function countTable() {

    return (bool) $this->dao->query('SELECT COUNT(*) FROM animations')->fetchColumn(); 
  }


   public function updateAjax($ajax_id, $id)
  {

   echo $ajax_id - 1 . ' : ' ;
   echo $id . ' / ';

   $ajax = $ajax_id - 1;

    $sql = 'UPDATE animations SET ajax_id = ' . $ajax . ' WHERE ID = ' . $id;

    $requete = $this->dao->prepare($sql);
    
    $requete->execute();
  }


  public function HighAjax() {

    $sql = "SELECT MAX(ajax_id) FROM animations";

    $requete = $this->dao->query($sql);

    $return = $requete->fetchColumn();

    return $return;

  } 


   public function LowAjax() {

    $sql = "SELECT MIN(ajax_id) FROM animations";

    $requete = $this->dao->query($sql);

    $return = $requete->fetchColumn();

    return $return;

  }


  public function getUniqueByAjax($ajax_id) {

    $requete = $this->dao->prepare('SELECT * FROM animations WHERE ajax_id = ' . $ajax_id);
    $requete->execute();
    
    $requete->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\Animations');
    
    if ($animations = $requete->fetch())
    { 
      return $animations;
    }

    $animations = $requete->fetch();
    
    return null;

  }


  public function delete($id)
  {
    $this->dao->exec('DELETE FROM animations WHERE ID = '.$id);
  }

}