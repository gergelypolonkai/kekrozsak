<?php
namespace KekRozsak\FrontBundle\Form\Extension;

use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormViewInterface;
use Symfony\Component\Form\FormBuilderInterface;

class HelpMessageTypeExtension extends AbstractTypeExtension
{
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder->setAttribute('help', $options['help']);
	}

	public function buildView(FormViewInterface $view, FormInterface $form, array $options)
	{
		$view->setVar('help', $form->getAttribute('help'));
	}

	public function getDefaultOptions()
	{
		return array(
			'help' => null,
		);
	}

	public function getExtendedType()
	{
		return 'field';
	}
}

