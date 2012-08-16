<?php
namespace KekRozsak\FrontBundle\Form\Extension;

use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\Form\FormBuilderInterface;
use JMS\DiExtraBundle\Annotation as DI;

/**
 * @DI\Service("form.type_extension.help_message")
 * @DI\Tag("form.type_extension", attributes={"alias" = "field"})
 */
class HelpMessageTypeExtension extends AbstractTypeExtension
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->setAttribute('help', $options['help']);
    }

    public function buildView(FormView $view, FormInterface $form, array $options)
    {
        $view->set('help', $form->getAttribute('help'));
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
