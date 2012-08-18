<?php

namespace KekRozsak\FrontBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class BookType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                    'author',
                    null,
                    array(
                        'label' => 'Szerző',
                    )
                )
            ->add(
                    'title',
                    null,
                    array(
                        'label' => 'Cím',
                    )
                )
            ->add(
                    'year',
                    null,
                    array(
                        'label' => 'Kiadás éve',
                    )
                )
            ->add(
                    'commentable',
                    null,
                    array(
                        'label'    => 'Kommentelhető?',
                        'required' => false
                    )
                )
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'KekRozsak\FrontBundle\Entity\Book'
        ));
    }

    public function getName()
    {
        return 'kekrozsak_frontbundle_booktype';
    }
}
