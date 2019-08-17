<?php

namespace FormBuilder;

use \CRFram\FormBuilder;
use \CRFram\StringField;
use \CRFram\TextField;
use \CRFram\MaxLengthValidator;
use \CRFram\NotNullValidator;

class ModuleFormBuilder extends FormBuilder
{
  public function build()
  {
    $this->form->add(new StringField([
        'label' => 'Titre',
        'name' => 'title',
        'maxLength' => 100,
        'validators' => [
          new MaxLengthValidator('Le Titre est trop long (100 caractères maximum)', 100),
        ],
       ]))
       ->add(new TextField([
        'label' => 'Description',
        'name' => 'description',
        'rows' => 30,
        'cols' => 60,
       ]));
  }
}