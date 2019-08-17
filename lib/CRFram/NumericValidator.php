<?php
namespace CRFram;

class NumericValidator extends Validator
{
  public function isValid($value)
  {
    return preg_match('#(?=.*[0-9])#', $value);
  }
}