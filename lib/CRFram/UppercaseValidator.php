<?php
namespace CRFram;

class UppercaseValidator extends Validator
{
  public function isValid($value)
  {
    return preg_match('#(?=.*[A-Z])#', $value);
  }
}