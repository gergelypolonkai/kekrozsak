<?php
namespace KekRozsak\FrontBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class UserType extends AbstractType
{
	protected $_registration;

	public function __construct($registration)
	{
		$this->_registration = $registration;
	}

	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder->add('username', null, array(
			'label' => 'Felhasználónév',
			'help'  => 'Ezt fogod használni az oldalra való bejelentkezéshez. Jelszavadhoz hasonlóan kezeld bizalmasan! Jelentkezés után nem lehet megváltoztatni!',
		));
		$builder->add('password', 'repeated', array(
			'type'            => 'password',
			'second_name'     => 'confirm',
			'invalid_message' => 'A két jelszó nem egyezik meg!',
			'options'         => array(
						'label' => 'Jelszó',
						'help'  => 'Ezt fogod használni az oldalra való bejelentkezéshez. Soha ne add meg senkinek!',
			),
		));
		$builder->add('email', null, array(
			'label' => 'E-mail cím',
		));
		$builder->add('displayName', null, array(
			'label' => 'Név',
			'help'  => 'Ezen a néven fog szólítani a közösség. Bármikor megváltoztathatod, de az egyértelműség kedvéért ezt mindig jelezd a többiek felé!',
		));
		$builder->add('agree', 'checkbox', array(
			'property_path' => false,
			'label'         => ' ',
			'help'          => 'A Jelentkezés gomb megnyomásával kijelentem, hogy a Kék Rózsa okkultista kör Házirendjét elolvastam, és azt felvételem esetén magamra nézve teljes mértékben elfogadom.',
		));
	}

	public function getName()
	{
		return 'user';
	}

	public function getDefaultOptions()
	{
		$opts = array(
			'data_class' => 'KekRozsak\FrontBundle\Entity\User',
		);
		if ($this->_registration)
			$opts['validation_groups'] = array('registration');

		return $opts;
	}
}

