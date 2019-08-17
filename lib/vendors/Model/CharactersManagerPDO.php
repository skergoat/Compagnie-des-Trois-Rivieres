<?php
namespace Model;

use \Entity\Characters;

class CharactersManagerPDO extends CharactersManager
{

	public function add() {

		$requete = $this->dao->prepare('INSERT INTO characters SET title = NULL, description = NULL, picture_url = NULL, picture_alt = NULL');	    
	    $requete->execute();

	}

	public function HighId() {

	    $sql = "SELECT MAX(ID) FROM characters";

	    $requete = $this->dao->query($sql);

	    $return = $requete->fetchColumn();

	    return $return;

	}

	public function getUnique($id)
	  {
	    $requete = $this->dao->prepare('SELECT * FROM characters WHERE ID = :id');
	    $requete->bindValue(':id', (int) $id, \PDO::PARAM_INT);
	    $requete->execute();
	    
	    $requete->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\Characters');
	    
	    if ($animations = $requete->fetch())
	    { 
	      return $animations;
	    }
	    
	    return null;
	}

	public function save(Characters $characters) {

		 $requete = $this->dao->prepare('UPDATE characters SET title = :title, description = :description, picture_url = :picture_url, picture_alt = :picture_alt WHERE ID = :id');
    
	    $requete->bindValue(':title', $characters->Title());
	    $requete->bindValue(':description', $characters->Description());
	    $requete->bindValue(':picture_url', $characters->Picture_url());
	    $requete->bindValue(':picture_alt', $characters->Picture_alt());
	    $requete->bindValue(':id', $characters->getId(), \PDO::PARAM_INT);
	    
	    $requete->execute();

	}

	public function getAll()
	{
	    $sql = 'SELECT * FROM characters';
	    
	    $requete = $this->dao->query($sql);
	    $requete->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\Characters');
	    
	    $listeCharacters = $requete->fetchAll();
	    
	    $requete->closeCursor();
	    
	    return $listeCharacters;
	}

	 /**
  * Paginate table post on admin page 
  **/
  public function getPaginate($premiereEntree, $messageTotal){

    $characters = [];

    $listMessage = $this->dao->query('SELECT * FROM characters ORDER BY ID ASC LIMIT ' . $premiereEntree . ', ' . $messageTotal);

    while($messages = $listMessage->fetch()){

      $characters[] = new Characters($messages);
    }

    return $characters;
  }

  /**
  * Count total posts 
  **/
  public function countTotal() {

    $pagination = $this->dao->query('SELECT COUNT(*) FROM characters');

    $donnee = $pagination->fetch();
    
    return $donnee;
  }


	  public function delete($id)
	  {
	    $this->dao->exec('DELETE FROM characters WHERE ID = '.$id);
	  }


}