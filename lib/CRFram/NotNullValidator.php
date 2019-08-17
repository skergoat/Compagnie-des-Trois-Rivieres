<?php
namespace CRFram;

class NotNullValidator extends Validator
{
  public function isValid($value)
  {
    return $value != '';
  }
}