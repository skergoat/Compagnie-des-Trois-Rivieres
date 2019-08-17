<?php

namespace FormBuilder;

use \CRFram\FormBuilder;
use \CRFram\StringField;
use \CRFram\PasswordField;
use \CRFram\NotNullValidator;
use \CRFram\MinLengthValidator;
use \CRFram\UppercaseValidator;
use \CRFram\NumericValidator;
use \CRFram\SpecialValidator;


class RecoverFormBuilder extends FormBuilder
{
  public function build()
  {
    $this->form->add(new PasswordField([
        'label' => 'Mot de Passe',
        'name' => 'password',
        'validators' => [
          new NotNullValidator('Merci de remplir le champ'),
          new MinLengthValidator('Le mot de passe doit avoir 8 caracteres'),
          new UppercaseValidator('Le mot de passe doit contenir au moins une majuscule'),
          new NumericValidator('Le mot de passe doit contenir au moins un chiffre'),
          new SpecialValidator('Le mot de passe doit contenir au moins un caractere special'),
        ],
       ]));
  }
}