<?php

namespace Model;

use \Entity\Pictures;

class PicturesManagerPDO extends PicturesManager
{

	public function createMain(Pictures $pictures, $module) {

		$table = 'pictures_' . $module;

		$sql = 'INSERT INTO ' . $table . ' SET src = :src, alt = :alt, item_id = :item_id';

		$requete = $this->dao->prepare($sql);

	    $requete->bindValue(':src', $pictures->Src());
	    $requete->bindValue(':alt', $pictures->Alt());
	    $requete->bindValue(':item_id', $pictures->Item_id());
	    
	    $requete->execute();	
	}

	public function updateMainPicture(Pictures $pictures, $module) {

		$table = 'pictures_' . $module;

		$sql = 'UPDATE ' . $table . ' SET src = :src, alt = :alt WHERE item_id = ' . $pictures->Item_id();

		$requete = $this->dao->prepare($sql);

	    $requete->bindValue(':src', $pictures->Src());
	    $requete->bindValue(':alt', $pictures->Alt());
	    
	    $requete->execute();

	}

	public function getUnique($module, $item_id) {

		$table = 'pictures_' . $module;

		$sql = 'SELECT * FROM ' . $table . ' WHERE item_id =' . $item_id;

		$requete = $this->dao->prepare($sql);

	    $requete->execute();
	    
	    $requete->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\Pictures');
	    
	    if ($pictures = $requete->fetch())
	    { 
	      return $pictures;
	    }
	    
	    return null;	
	}

	public function deleteMain($item_id, $module)
	 {

	 	$table = 'pictures_' . $module;
	 	$sql = 'DELETE FROM ' . $table . ' WHERE item_id = '.(int) $item_id;

	    $this->dao->exec($sql);
	 }


	public function createSlider(Pictures $pictures, $module) {

		$table = 'slider_' . $module;

		$sql = 'INSERT INTO ' . $table . ' SET src = :src, alt = :alt, item_id = :item_id, nb_picture = :nb_picture, picture_name = :picture_name';

		$requete = $this->dao->prepare($sql);

	    $requete->bindValue(':src', $pictures->Src());
	    $requete->bindValue(':alt', $pictures->Alt());
	    $requete->bindValue(':item_id', $pictures->Item_id());
	    $requete->bindValue(':nb_picture', $pictures->nb_picture());
	    $requete->bindValue(':picture_name', $pictures->picture_name());
	    
	    $requete->execute();	
	}

	public function getUniqueSlide($i, $module, $item_id, $action) {

		$table = 'slider_' . $module;

		if($action == 'update') {

			$sql = 'SELECT * FROM ' . $table . ' WHERE nb_picture = ' . $i . ' AND item_id = ' . $item_id;

		}

		if($action == 'empty') {

			$sql = 'SELECT * FROM ' . $table . ' WHERE ID = ' . $i;

		}

		$requete = $this->dao->prepare($sql);

	    $requete->execute();
	    
	    $requete->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\Pictures');
	    
	    if ($pictures = $requete->fetch())
	    { 
	      return $pictures;
	    }
	    
	    return null;

	}

	public function getPicturesSlider($item_id, $module, $app) {

		$table = 'slider_' . $module;

		if($app == 'backend') {

			$sql = 'SELECT * FROM ' . $table . ' WHERE item_id =' . $item_id;	
		}
		else if($app = 'frontend') {

			$sql = 'SELECT * FROM ' . $table . ' WHERE item_id =' . $item_id . ' AND src IS NOT NULL';
		}
		
	    $requete = $this->dao->query($sql);
	    $requete->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\Pictures');
	    
	    $pictures = $requete->fetchAll();
	    
	    $requete->closeCursor();
	    
	    return $pictures;
	}

	public function updateSlider(Pictures $pictures, $module, $id) {

		$table = 'slider_' . $module;

		$sql = 'UPDATE ' . $table . ' SET src = :src WHERE ID = ' . $id;

		$requete = $this->dao->prepare($sql);

	    $requete->bindValue(':src', $pictures->Src());
	    
	    $requete->execute();

	}

	public function countSlides($module, $item_id) {

		$table = 'slider_' . $module;

		$sql = 'SELECT COUNT(*) FROM ' . $table . ' WHERE item_id = ' . $item_id . ' AND src IS NOT NULL' ;

		$requete = $this->dao->query($sql);

		$requete->execute();

		$result = $requete->fetch();

		return $result;

	}
	
	 public function deleteSlider($id, $module)
	 {

	 	$table = 'slider_' . $module;
	 	$sql = 'DELETE FROM ' . $table . ' WHERE ID = '.(int) $id;

	    $this->dao->exec($sql);
	 }

}