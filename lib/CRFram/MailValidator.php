<?php
namespace CRFram;

class MailValidator extends Validator
{
  public function isValid($value)
  {
    return preg_match('#[a-z0-9._-]{1,10}@[a-z0-9._-]{1,10}\.[a-z]{1,3}#isU' , $value);
  }
}