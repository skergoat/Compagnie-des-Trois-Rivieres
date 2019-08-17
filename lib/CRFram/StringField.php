<?php
namespace CRFram;

class StringField extends Field
{
  protected $maxLength;
  
  public function buildWidget()
  {
    $widget = '';
    
    $widget .= '<label class="label" style="font-weight:bold;font-size:18px;margin-top:px;">'.$this->label.'</label><input type="text" class="input" name="'.$this->name.'"';
    
    if (!empty($this->value))
    {
      $widget .= ' value="'.$this->value.'"';
    }
    
    if (!empty($this->maxLength))
    {
      $widget .= ' maxlength="'.$this->maxLength.'"';
    }

    $widget .= ' /><span class="help is-danger" style="height:1px;border:2px solid transparent;">';

    if (!empty($this->errorMessage))
    {
      $widget .= $this->errorMessage;
    }

    return $widget .= '</span>';
    
  }
  
  public function setMaxLength($maxLength)
  {
    $maxLength = (int) $maxLength;
    
    if ($maxLength > 0)
    {
      $this->maxLength = $maxLength;
    }
    else
    {
      throw new \RuntimeException('La longueur maximale doit être un nombre supérieur à 0');
    }
  }
}