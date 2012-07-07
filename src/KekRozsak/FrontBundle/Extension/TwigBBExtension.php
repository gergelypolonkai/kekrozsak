<?php
namespace KekRozsak\FrontBundle\Extension;

use Symfony\Component\DependencyInjection\ContainerInterface;

class TwigBBExtension extends \Twig_Extension
{
	private $assets;

	public function __construct(ContainerInterface $container)
	{
		$this->assets = $container->get('templating.helper.assets');
	}

	public function getFilters()
	{
		return array(
			'bbdecode' => new \Twig_Filter_Method($this, 'bbdecode', array(
				'is_safe' => array('html'),
			)),
		);
	}

	public function bbdecode($sentence)
	{
		$sentence = htmlspecialchars($sentence, ENT_NOQUOTES);
		$sentence = str_replace(array("\r\n", "\n", "\r"), "<br />", $sentence);
		$sentence = preg_replace('/\\[u\\](.*?)\\[\\/u\\]/im', '<span class="u">\\1</span>', $sentence);
		$sentence = preg_replace('/\\[b\\](.*?)\\[\\/b\\]/im', '<span class="b">\\1</span>', $sentence);
		$sentence = preg_replace('/\\[i\\](.*?)\\[\\/i\\]/im', '<span class="i">\\1</span>', $sentence);
		while (preg_match('/\\[img( (ns|name)="[^"]+"){1,}\\]/i', $sentence, $m, PREG_OFFSET_CAPTURE))
		{
			$start = $m[0][1];
			$len = strlen($m[0][0]);
			$full_tag = $m[0][0];

			$ns =   (preg_match('/ ns="([^"]+)"/',   $full_tag, $ns))   ? trim($ns[1])   : '';
			$name = (preg_match('/ name="([^"]+)"/', $full_tag, $name)) ? trim($name[1]) : '';

			if ($name == '')
			{
				$sentence = substr_replace($sentence, 'Hibás kép', $start, $len);
			}
			else
			{
				// TODO: Thumbnailing!
				$sentence = substr_replace($sentence, '<img src="' . $this->assets->getUrl('upload/images/' . (($ns == '') ? '' : $ns . '/') . $name) . '" alt="" />', $start, $len);
			}
		}
		while (preg_match('/\\[link( (url)="[^"]+"){1,}\\](?P<content>.*?)\\[\\/link\\]/i', $sentence, $m, PREG_OFFSET_CAPTURE))
		{
			$start = $m[0][1];
			$len = strlen($m[0][0]);
			$full_tag = $m[0][0];

			$url = (preg_match('/ url="([^"]+)"/', $full_tag, $url)) ? trim($url[1]) : '';
			$content = '';
			if (array_key_exists('content', $m))
			{
				$content = trim($m['content'][0]);
			}

			if (($url == '') || ($content == ''))
			{
				$sentence = substr_replace($sentence, 'Hibás link', $start, $len);
			}
			else
			{
				$sentence = substr_replace($sentence, '<a href="' . $url . '" target="_blank">' . $content . '</a>', $start, $len);
			}
		}
		return $sentence;
	}

	public function getName()
	{
		return 'twig_bb';
	}
}
