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
		$text = trim(preg_replace('~[^\\pL\d]+~u', '-', $text));

		if (function_exists('iconv'))
		{
			$text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
		}

		$text = strtolower($text);

		$text = preg_replace('~[^-\w]+~', '', $text);

		if (empty($text))
		{
			$text = 'n-a';
		}

		return $text;
	}
}
