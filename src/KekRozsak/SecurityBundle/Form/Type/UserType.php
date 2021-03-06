<?php
namespace KekRozsak\SecurityBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

use KekRozsak\FrontBundle\Form\Type\UserDataType;

class UserType extends AbstractType
{
    protected $_registration;

    public function __construct($registration = false)
    {
        $this->_registration = $registration;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('username', null, array(
                    'label'     => 'Felhasználónév',
                    'read_only' => (!$this->_registration),
                    'help'      => 'Ezt fogod használni az oldalra való bejelentkezéshez. Jelszavadhoz hasonlóan kezeld bizalmasan! Jelentkezés után nem lehet megváltoztatni!',
                )
            );

        $builder->add('password', 'repeated', array(
                    'type'            => 'password',
                    'second_name'     => 'confirm',
                    'invalid_message' => 'A két jelszó nem egyezik meg!',
                    'required'        => ($this->_registration),
                    'options'         => array(
                            'label' => 'Jelszó',
                            'help'  => 'Ezt fogod használni az oldalra való bejelentkezéshez. Soha ne add meg senkinek!',
                        ),
                )
            );

        $builder->add('email', null, array(
                    'label' => 'E-mail cím',
                    'help'  => 'Ezen az e-mail címen értesítünk majd, ha felvételt nyersz a körbe.',
                )
            );

        $builder->add('displayName', null, array(
                    'label' => 'Név',
                    'help'  => 'Ezen a néven fog szólítani a közösség. Bármikor megváltoztathatod, de az egyértelműség kedvéért ezt mindig jelezd a többiek felé!',
                )
            );

        if (!$this->_registration) {
            $builder->add('userData', new UserDataType(), array(
                        'label' => 'Egyéb adatok',
                    )
                );
        } else {
            $builder->add('agree', 'checkbox', array(
                        'property_path' => false,
                        'label'         => ' ',
                        'help'          => 'A Jelentkezés gomb megnyomásával kijelentem, hogy a Kék Rózsa okkultista kör Házirendjét elolvastam, és azt felvételem esetén magamra nézve teljes mértékben elfogadom.',
                    )
                );
        }
    }

    public function getName()
    {
        return 'user';
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $opts = array(
            'data_class' => 'KekRozsak\SecurityBundle\Entity\User',
        );

        if ($this->_registration) {
            $opts['validation_groups'] = array('registration');
        }

        $resolver->setDefaults($opts);
    }
}
