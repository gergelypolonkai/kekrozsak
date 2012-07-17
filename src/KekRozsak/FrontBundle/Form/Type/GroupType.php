<?php

namespace KekRozsak\FrontBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class GroupType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder->add('name', null, array(
			'label' => 'A csoport neve',
		));
		
		$builder->add('description', 'ckeditor', array(
			'label'   => 'A csoport leírása',
		));
	}
	
	public function getName()
	{
		return 'group';
	}
}
