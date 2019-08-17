<?php
namespace Model;

use \CRFram\Manager;
use \Entity\Characters;

abstract class CharactersManager extends Manager
{

	/**
	*
	*	add new character
	*
	**/
	abstract public function add();

	/**
	*
	* get highest id in page 
	*
	**/
	abstract public function HighId(); 

	/**
	*
	*	get unique character
	*
	**/
	abstract public function getUnique($id);

	/**
	*
	*	update characters 
	*
	**/
	abstract public function save(Characters $characters);

	/**
	*
	*	count nb total of rows in table in order to paginate 
	*
	**/
	abstract  public function getAll();

	/**
	*
	*	paginate on module index page 
	*
	**/
	abstract  public function getPaginate($premiereEntree, $messageTotal);

	/**
	*
	*	count nb total of rows in table in order to paginate 
	*
	**/
	abstract  public function countTotal();

	/**
	*
	*	delete row in bdd 
	*
	**/
	abstract public function delete($id);


}