<?php
namespace KekRozsak\FrontBundle\Twig;

use Symfony\Component\DependencyInjection\ContainerInterface;
use JMS\DiExtraBundle\Annotation as DI;

/**
 * @DI\Service
 * @DI\Tag("twig.extension")
 *
 */
class TwigBBExtension extends \Twig_Extension
{
    private $container;

    /**
     * @DI\InjectParams({
     *     "container" = @DI\Inject("service_container")
     * })
     * @param \Symfony\Component\DependencyInjection\ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
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
        $sentence = preg_replace(
                '/\\[i\\](.*?)\\[\\/i\\]/im',
                '<span class="i">\\1</span>',
                preg_replace(
                        '/\\[b\\](.*?)\\[\\/b\\]/im',
                        '<span class="b">\\1</span>',
                        preg_replace(
                                '/\\[u\\](.*?)\\[\\/u\\]/im',
                                '<span class="u">\\1</span>',
                                str_replace(
                                        array("\r\n", "\n", "\r"),
                                        "<br />",
                                        htmlspecialchars($sentence, ENT_NOQUOTES)
                                    )
                            )
                    )
            );

        $m = array();

        while (
            preg_match(
                    '/\\[img( (ns|name)="[^"]+"){1,}\\]/i',
                    $sentence,
                    $m,
                    PREG_OFFSET_CAPTURE
                )
        ) {
            $start = $m[0][1];
            $len = strlen($m[0][0]);
            $full_tag = $m[0][0];

            $ns =   (preg_match('/ ns="([^"]+)"/',   $full_tag, $ns))   ? trim($ns[1])   : '';
            $name = (preg_match('/ name="([^"]+)"/', $full_tag, $name)) ? trim($name[1]) : '';

            if ($name == '') {
                $sentence = substr_replace($sentence, 'Hibás kép', $start, $len);
            } else {
                // TODO: Thumbnailing!
                $sentence = substr_replace(
                        $sentence,
                        '<img src="'
                                . $this
                                    ->container
                                    ->get('templating.helper.assets')
                                    ->getUrl(
                                            'upload/images/'
                                            . (($ns == '') ? '' : $ns . '/')
                                            . $name
                                        )
                                . '" alt="" />',
                        $start,
                        $len
                    );
            }
        }

        while (
            preg_match(
                '/\\[link( (url)="[^"]+"){1,}\\](?P<content>.*?)\\[\\/link\\]/i',
                    $sentence, $m, PREG_OFFSET_CAPTURE)
        ) {
            $start = $m[0][1];
            $len = strlen($m[0][0]);
            $full_tag = $m[0][0];

            $url = (preg_match('/ url="([^"]+)"/', $full_tag, $url)) ? trim($url[1]) : '';
            $content = '';
            if (array_key_exists('content', $m)) {
                $content = trim($m['content'][0]);
            }

            if (($url == '') || ($content == '')) {
                $sentence = substr_replace($sentence, 'Hibás link', $start, $len);
            } else {
                $sentence = substr_replace(
                        $sentence,
                        '<a href="'
                                . $url
                                . '" target="_blank">'
                                . $content
                                . '</a>',
                        $start,
                        $len
                    );
            }
        }

        return $sentence;
    }

    public function getName()
    {
        return 'twig_bb';
    }
}
