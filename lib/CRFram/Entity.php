<?php
namespace CRFram;

abstract class Entity implements \ArrayAccess
{
  use Hydrator;

  protected $erreurs = [],
            $ID;

  public function __construct(array $donnees = [])
  {
    if (!empty($donnees))
    {
      $this->hydrate($donnees);
    }
  }

  public function isNew()
  {
    return empty($this->ID);
  }

  public function erreurs()
  {
    return $this->erreurs;
  }

  public function id()
  {
    return $this->ID;
  }

  public function setId($id)
  {
    $this->ID = (int) $id;
  }

  public function offsetGet($var)
  {
    if (isset($this->$var) && is_callable([$this, $var]))
    {
      return $this->$var();
    }
  }

  public function offsetSet($var, $value)
  {
    $method = 'set'.ucfirst($var);

    if (isset($this->$var) && is_callable([$this, $method]))
    {
      $this->$method($value);
    }
  }

  public function offsetExists($var)
  {
    return isset($this->$var) && is_callable([$this, $var]);
  }

  public function offsetUnset($var)
  {
    throw new \Exception('Impossible de supprimer une quelconque valeur');
  }
}