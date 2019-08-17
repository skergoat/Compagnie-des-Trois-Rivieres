<?php
namespace Model;

use \Entity\Workshops;

class WorkshopsManagerPDO extends WorkshopsManager
{

  protected function update(Workshops $workshops)
  {

    $requete = $this->dao->prepare('UPDATE workshops SET ajax_id = :ajax_id, title = :title, description = :description, published = :published, media = :media, video_url = :video_url WHERE ID = :id');
    
    $requete->bindValue(':title', $workshops->Title());
    $requete->bindValue(':description', $workshops->Description());
    $requete->bindValue(':published', $workshops->Published());
    $requete->bindValue(':media', $workshops->Media());
    $requete->bindValue(':video_url', $workshops->Video_url());
    $requete->bindValue(':ajax_id', $workshops->Ajax_id(), \PDO::PARAM_INT);
    $requete->bindValue(':id', $workshops->getId(), \PDO::PARAM_INT);
    
    $requete->execute();
  }


  public function add(Workshops $workshops)
  {
    $requete = $this->dao->prepare('INSERT INTO workshops SET ajax_id = :ajax_id, title = :title, description = :description');

   $requete->bindValue(':ajax_id', $workshops->Ajax_id(), \PDO::PARAM_INT);
    $requete->bindValue(':title', $workshops->Title());
    $requete->bindValue(':description', $workshops->Description());
    
    $requete->execute();
  }


  public function getAll($where)
  {
    $sql = 'SELECT ID, ajax_id, title, description FROM workshops ' . $where;
    
    $requete = $this->dao->query($sql);
    $requete->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\Workshops');
    
    $listeAteliers = $requete->fetchAll();
    
    $requete->closeCursor();
    
    return $listeAteliers;
  }


  public function getUnique($id)
  {
    $requete = $this->dao->prepare('SELECT * FROM workshops WHERE Id = :id');
    $requete->bindValue(':id', (int) $id, \PDO::PARAM_INT);
    $requete->execute();
    
    $requete->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\Workshops');
    
    if ($workshops = $requete->fetch())
    { 
      return $workshops;
    }
    
    return null;
  }


  public function LowId() {

    $sql = "SELECT MIN(ID) FROM workshops";

    $requete = $this->dao->query($sql);

    $return = $requete->fetchColumn();

    return $return;

  }


  public function HighId() {

    $sql = "SELECT MAX(ID) FROM workshops";

    $requete = $this->dao->query($sql);

    $return = $requete->fetchColumn();

    return $return;

  } 


  public function getPaginate($premiereEntree, $messageTotal, $where){

    $animations = [];

    if($where == NULL) {

      $sql = 'SELECT * FROM workshops ORDER BY ID ASC LIMIT ' . $premiereEntree . ', ' . $messageTotal;
    }
    else {

      $sql = 'SELECT * FROM workshops ' . $where . ' ORDER BY ID ASC LIMIT ' . $premiereEntree . ', ' . $messageTotal;
    }

    $listMessage = $this->dao->query($sql);

    while($messages = $listMessage->fetch()){

      $animations[] = new Workshops($messages);
    }

    return $animations;
  }


  public function countTotal() {

    $pagination = $this->dao->query('SELECT COUNT(*) FROM workshops');

    $donnee = $pagination->fetch();
    
    return $donnee;
  }


  public function countTable() {

    return (bool) $this->dao->query('SELECT COUNT(*) FROM workshops')->fetchColumn(); 
  }


   public function updateAjax($ajax_id, $id)
  {

   echo $ajax_id - 1 . ' : ' ;
   echo $id . ' / ';

   $ajax = $ajax_id - 1;

    $sql = 'UPDATE workshops SET ajax_id = ' . $ajax . ' WHERE ID = ' . $id;

    $requete = $this->dao->prepare($sql);
    
    $requete->execute();
  }


  public function HighAjax() {

    $sql = "SELECT MAX(ajax_id) FROM workshops";

    $requete = $this->dao->query($sql);

    $return = $requete->fetchColumn();

    return $return;

  } 


  public function LowAjax() {

    $sql = "SELECT MIN(ajax_id) FROM workshops";

    $requete = $this->dao->query($sql);

    $return = $requete->fetchColumn();

    return $return;

  }


   public function getUniqueByAjax($ajax_id) {

    $requete = $this->dao->prepare('SELECT * FROM workshops WHERE ajax_id = ' . $ajax_id);
    $requete->execute();
    
    $requete->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\Workshops');
    
    if ($work = $requete->fetch())
    { 
      return $work;
    }

    $work = $requete->fetch();
    
    return null;
  }


  public function delete($id)
  {
    $this->dao->exec('DELETE FROM workshops WHERE ID = '.$id);
  }
 

}