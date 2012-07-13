<?php
namespace KekRozsak\FrontBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class ForumPostType extends AbstractType
{
	private $topicGroup;
	private $topic;

	public function __construct($topicGroup = null, $topic = null)
	{
		$this->topicGroup = $topicGroup;
		$this->topic = $topic;
	}

	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder->add('createdAt', 'hidden', array(
			'label' => 'Időpont',
			'data'  => new \DateTime('now')
		));
		$builder->add('text', null, array(
			'label' => ' ',
		));
		$builder->add('topic', 'hidden', array(
			'property_path' => false,
			'data'          => $this->topic,
		));
	}

	public function getName()
	{
		return 'forum_post';
	}

	public function getDefaultOptions()
	{
		$opts = array(
			'data_class' => 'KekRozsak\FrontBundle\Entity\ForumPost',
		);

		return $opts;
	}
}

