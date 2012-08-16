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
            );

        $builder->add('content', 'ckeditor', array(
                    'label' => ' ',
                )
            );

        // TODO: possibility to add to other groups!
    }

    public function getName()
    {
        return 'document';
    }
}
