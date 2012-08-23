<?php

namespace KekRozsak\FrontBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ForumTopicType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', null, array(
                'label' => 'Téma címe',
                'help'  => 'Az új fórum téma címe',
            ))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'KekRozsak\FrontBundle\Entity\ForumTopic'
        ));
    }

    public function getName()
    {
        return 'kekrozsak_frontbundle_forumtopictype';
    }
}
