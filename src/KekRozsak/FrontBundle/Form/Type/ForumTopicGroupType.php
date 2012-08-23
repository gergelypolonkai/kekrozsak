<?php

namespace KekRozsak\FrontBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ForumTopicGroupType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', null, array(
                'label' => 'Témakör neve',
                'help'  => 'Az új fórum témakör neve',
            ))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'KekRozsak\FrontBundle\Entity\ForumTopicGroup'
        ));
    }

    public function getName()
    {
        return 'kekrozsak_frontbundle_forumtopicgrouptype';
    }
}
