<?php
namespace CRFram;

class SpecialValidator extends Validator
{
  public function isValid($value)
  {
    return preg_match('#(?=.*[\#\$\^\+\=\!\*\(\)\@\%\&\?])#', $value);
  }
}