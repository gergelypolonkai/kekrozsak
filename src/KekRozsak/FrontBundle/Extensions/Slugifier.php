<?php

namespace KekRozsak\FrontBundle\Extensions;

class Slugifier
{
    /**
     * Slugify string
     *
     * @param string $text
     * @return string
     */
    public function slugify($text)
    {
        $text = preg_replace(
                '~[^-\w]+~',
                '',
                str_replace(
                        array('"', "'", ':'),
                        '',
                        strtolower(
                                iconv(
                                        'utf-8',
                                        'us-ascii//TRANSLIT',
                                        trim(
                                                preg_replace(
                                                        '~[^\\pL\d]+~u',
                                                        '-',
                                                        $text
                                                    )
                                            )
                                    )
                            )
                    )
            );

        if (empty($text)) {
            $text = 'n-a';
        }

        return $text;
    }
}
