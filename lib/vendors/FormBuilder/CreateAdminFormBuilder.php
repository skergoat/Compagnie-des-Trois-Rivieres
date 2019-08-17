<?php

namespace FormBuilder;

use \CRFram\FormBuilder;
use \CRFram\StringField;
use \CRFram\PasswordField;
use \CRFram\NotNullValidator;
use \CRFram\MailValidator;
use \CRFram\MinLengthValidator;
use \CRFram\UppercaseValidator;
use \CRFram\NumericValidator;
use \CRFram\SpecialValidator;

class CreateAdminFormBuilder extends FormBuilder
{
  public function build()
  {
    $this->form->add(new StringField([
        'label' => 'Nom',
        'name' => 'name',
        'validators' => [
          new NotNullValidator('Merci de spécifier votre nom'),
        ],
       ]))
       ->add(new PasswordField([
        'label' => 'Mot de Passe',
        'name' => 'password',
        'validators' => [
          new NotNullValidator('Merci de spécifier le mot de passe'),
          new MinLengthValidator('Le mot de passe doit avoir 8 caracteres'),
          new UppercaseValidator('Le mot de passe doit contenir au moins une majuscule'),
          new NumericValidator('Le mot de passe doit contenir au moins un chiffre'),
          new SpecialValidator('Le mot de passe doit contenir au moins un caractere special'),
        ],
       ]))
       ->add(new StringField([
        'label' => 'Mail',
        'name' => 'mail',
        'validators' => [
          new NotNullValidator('Merci de spécifier votre mail'),
          new MailValidator('Merci de rentrer un mail valide'),
        ],
       ]));
  }
}