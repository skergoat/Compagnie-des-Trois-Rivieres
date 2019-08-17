<?php
namespace CRFram;

class PDOFactory
{
  public static function getMysqlConnexion()
  {
    $db = new \PDO('mysql:host=dinde.o2switch.net;dbname=maje8745_compagnie;charset=utf8', 'maje8745', '9195285B65x9?compagnie');
    $db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    
    return $db;
  }
}