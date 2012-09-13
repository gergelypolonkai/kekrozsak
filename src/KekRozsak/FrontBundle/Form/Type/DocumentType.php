<?php

namespace KekRozsak\FrontBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class DocumentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
         $builder->add('title', null, array(
                    'label' => 'A dokumentum címe',
                )
            )

         ->add('groups', null, array(
                    'label'    => 'Csoportok',
                    'property' => 'name',
                    'required' => true,
                )
            )

        ->add('content', 'ckeditor', array(
                    'label' => ' ',
                )
            );
    }

    public function getName()
    {
        return 'document';
    }
}
