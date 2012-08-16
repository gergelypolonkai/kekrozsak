<?php
namespace KekRozsak\FrontBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class UserDataType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('emailPublic', null, array(
                    'label'    => 'Publikus legyen az e-mail címed?',
                    'help'     => 'Ha bejelölöd, a kör többi tagja láthatja az e-mail címedet.',
                    'required' => false,
                )
            );

        $builder->add('realName', null, array(
                    'label' => 'Valódi neved',
                    'help'  => 'A valódi, polgári neved. Nem kötelező mező, akkor érdemes megadni, ha szeretnéd, hogy a többi tag megtalálhasson különféle közösségi oldalakon.',
                )
            );

        $builder->add('realNamePublic', null, array(
                    'label' => 'Publikus legyen a valódi neved?',
                    'help'  => 'Ha bejelölöd, a kör többi tagja láthatja a valódi neved.',
                    'required' => false,
                )
            );

        $builder->add('selfDescription', null, array(
                    'label' => 'Rövid leírás Magadról',
                    'help'  => 'Írj ide egy rövid leírást saját magadról. Ez mindenképpen megjelenik majd a profilodon, így a többiek tudhatják, hogy mivel is foglalkozol.',
                )
            );

        $builder->add('msnAddress', null, array(
                    'label' => 'MSN címed',
                    'help'  => 'Egy MSN cím, amin elérhető vagy.'
                )
            );

        $builder->add('msnAddressPublic', null, array(
                    'label' => 'Publikus legyen az MSN címed?',
                    'help'  => 'Ha bejelölöd, a kör többi tagja láthatja az MSN címedet.',
                    'required' => false,
                )
            );

        $builder->add('googleTalk', null, array(
                    'label' => 'Google Talk címed',
                    'help'  => 'Itt egy olyan GMail-es e-mail címet adhatsz meg, amin elérhető vagy a GMail csevegőben.',
                )
            );

        $builder->add('googleTalkPublic', null, array(
                    'label' => 'Publikus legyen a Google Talk címed?',
                    'help'  => 'Ha bejelölöd, a kör többi tagja láthatja a Google Talk címedet.',
                    'required' => false,
                )
            );

        $builder->add('skype', null, array(
                    'label' => 'Skype neved',
                    'help'  => 'Egy Skype név, amin elérhető vagy.',
                )
            );

        $builder->add('skypePublic', null, array(
                    'label' => 'Publikus legyen a Skype neved?',
                    'help'  => 'Ha bejelölöd, a kör többi tagja láthatja a Skype nevedet.',
                    'required' => false,
                )
            );

        $builder->add('phoneNumber', null, array(
                    'label' => 'Telefonszámod',
                    'help'  => 'Egy telefonszám, amin elérhető vagy. Programszervezéseknél jól jöhet.',
                )
            );

        $builder->add('phoneNumberPublic', null, array(
                    'label' => 'Publikus legyen a telefonszámod?',
                    'help'  => 'Ha bejelölöd, a kör többi tagja láthatja a telefonszámodat.',
                    'required' => false,
                )
            );
    }

    public function getName()
    {
        return 'user_data';
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'KekRozsak\FrontBundle\Entity\UserData'
        ));
    }
}
