<?php
namespace Model;

use \Entity\Prejudices;

class PrejudicesManagerPDO extends PrejudicesManager
{

 protected function update(Prejudices $prejudices)
  {

    $requete = $this->dao->prepare('UPDATE prejudices SET ajax_id = :ajax_id, title = :title, description = :description, published = :published, media = :media, video_url = :video_url WHERE ID = :id');
    
    $requete->bindValue(':title', $prejudices->Title());
    $requete->bindValue(':description', $prejudices->Description());
    $requete->bindValue(':published', $prejudices->Published());
    $requete->bindValue(':media', $prejudices->Media());
    $requete->bindValue(':video_url', $prejudices->Video_url());
    $requete->bindValue(':ajax_id', $prejudices->Ajax_id(), \PDO::PARAM_INT);
    $requete->bindValue(':id', $prejudices->getId(), \PDO::PARAM_INT);
    
    $requete->execute();
  }

  public function add(Prejudices $prejudices)
  {
    $requete = $this->dao->prepare('INSERT INTO prejudices SET title = :title, description = :description, ajax_id = :ajax_id');

    $requete->bindValue(':title', $prejudices->Title());
    $requete->bindValue(':description', $prejudices->Description());
    $requete->bindValue(':ajax_id', $prejudices->Ajax_id(), \PDO::PARAM_INT);
    
    $requete->execute();
  }

   public function getAll($where)
  {
    $sql = 'SELECT ID, title, description, ajax_id FROM prejudices ' . $where;
    
    $requete = $this->dao->query($sql);
    $requete->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\Prejudices');
    
    $listePrejudices = $requete->fetchAll();
    
    $requete->closeCursor();
    
    return $listePrejudices;
  }


  public function getUnique($id)
  {
    $requete = $this->dao->prepare('SELECT * FROM prejudices WHERE ID = :id');
    $requete->bindValue(':id', (int) $id, \PDO::PARAM_INT);
    $requete->execute();
    
    $requete->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\Prejudices');
    
    if ($prejudices = $requete->fetch())
    { 
      return $prejudices;
    }
    
    return null;
  }

  public function LowId() {

    $sql = "SELECT MIN(ID) FROM prejudices";

    $requete = $this->dao->query($sql);

    $return = $requete->fetchColumn();

    return $return;

  }

   public function HighId() {

    $sql = "SELECT MAX(ID) FROM prejudices";

    $requete = $this->dao->query($sql);

    $return = $requete->fetchColumn();

    return $return;

  } 

  public function getPaginate($premiereEntree, $messageTotal, $where){

    $animations = [];

    if($where == NULL) {

        $sql = 'SELECT * FROM prejudices ORDER BY ID ASC LIMIT ' . $premiereEntree . ', ' . $messageTotal;
    }
    else {

      $sql = 'SELECT * FROM prejudices ' . $where . ' ORDER BY ID ASC LIMIT ' . $premiereEntree . ', ' . $messageTotal;
    }

    $listMessage = $this->dao->query($sql);

    while($messages = $listMessage->fetch()){

      $animations[] = new Prejudices($messages);
    }

    return $animations;
  }


   public function countTotal() {

    $pagination = $this->dao->query('SELECT COUNT(*) FROM prejudices');

    $donnee = $pagination->fetch();
    
    return $donnee;
  }


  public function countTable() {

    return (bool) $this->dao->query('SELECT COUNT(*) FROM prejudices')->fetchColumn(); 
  }
 

   public function updateAjax($ajax_id, $id)
  {

   echo $ajax_id - 1 . ' : ' ;
   echo $id . ' / ';

   $ajax = $ajax_id - 1;

    $sql = 'UPDATE prejudices SET ajax_id = ' . $ajax . ' WHERE ID = ' . $id;

    $requete = $this->dao->prepare($sql);
    
    $requete->execute();
  }


  public function HighAjax() {

    $sql = "SELECT MAX(ajax_id) FROM prejudices";

    $requete = $this->dao->query($sql);

    $return = $requete->fetchColumn();

    return $return;

  } 


   public function LowAjax() {

    $sql = "SELECT MIN(ajax_id) FROM prejudices";

    $requete = $this->dao->query($sql);

    $return = $requete->fetchColumn();

    return $return;

  }


  public function getUniqueByAjax($ajax_id) {

    $requete = $this->dao->prepare('SELECT * FROM prejudices WHERE ajax_id = ' . $ajax_id);
    $requete->execute();
    
    $requete->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\Prejudices');
    
    if ($prejudices = $requete->fetch())
    { 
      return $prejudices;
    }

    $prejudices = $requete->fetch();
    
    return null;

  }


  public function delete($id)
  {
    $this->dao->exec('DELETE FROM prejudices WHERE ID = '.$id);
  }

}