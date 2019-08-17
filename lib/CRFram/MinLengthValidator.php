<?php
namespace CRFram;

class MinLengthValidator extends Validator
{
  public function isValid($value)
  {
    return strlen($value) > 8;
  }
}