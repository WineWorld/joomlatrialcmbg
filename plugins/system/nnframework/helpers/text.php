<?php
/**
 * NoNumber Framework Helper File: Text
 *
 * @package         NoNumber Framework
 * @version         14.8.4
 *
 * @author          Peter van Westen <peter@nonumber.nl>
 * @link            http://www.nonumber.nl
 * @copyright       Copyright © 2014 NoNumber All Rights Reserved
 * @license         http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 */

defined('_JEXEC') or die;

/**
 * Functions
 */
class NNText
{
	public static function dateToDateFormat($dateFormat)
	{
		$caracs = array(
			// Day
			'%d' => 'd',
			'%a' => 'D',
			'%#d' => 'j',
			'%A' => 'l',
			'%u' => 'N',
			'%w' => 'w',
			'%j' => 'z',
			// Week
			'%V' => 'W',
			// Month
			'%B' => 'F',
			'%m' => 'm',
			'%b' => 'M',
			// Year
			'%G' => 'o',
			'%Y' => 'Y',
			'%y' => 'y',
			// Time
			'%P' => 'a',
			'%p' => 'A',
			'%l' => 'g',
			'%I' => 'h',
			'%H' => 'H',
			'%M' => 'i',
			'%S' => 's',
			// Timezone
			'%z' => 'O',
			'%Z' => 'T',
			// Full Date / Time
			'%s' => 'U'
		);

		return strtr((string) $dateFormat, $caracs);
	}

	public static function dateToStrftimeFormat($dateFormat)
	{
		$caracs = array(
			// Day - no strf eq : S
			'd' => '%d',
			'D' => '%a',
			'jS' => '%#d[TH]',
			'j' => '%#d',
			'l' => '%A',
			'N' => '%u',
			'w' => '%w',
			'z' => '%j',
			// Week - no date eq : %U, %W
			'W' => '%V',
			// Month - no strf eq : n, t
			'F' => '%B',
			'm' => '%m',
			'M' => '%b',
			// Year - no strf eq : L; no date eq : %C, %g
			'o' => '%G',
			'Y' => '%Y',
			'y' => '%y',
			// Time - no strf eq : B, G, u; no date eq : %r, %R, %T, %X
			'a' => '%P',
			'A' => '%p',
			'g' => '%l',
			'h' => '%I',
			'H' => '%H',
			'i' => '%M',
			's' => '%S',
			// Timezone - no strf eq : e, I, P, Z
			'O' => '%z',
			'T' => '%Z',
			// Full Date / Time - no strf eq : c, r; no date eq : %c, %D, %F, %x
			'U' => '%s'
		);

		return strtr((string) $dateFormat, $caracs);
	}

	public static function html_entity_decoder($given_html, $quote_style = ENT_QUOTES, $charset = 'UTF-8')
	{
		if (is_array($given_html))
		{
			foreach ($given_html as $i => $html)
			{
				$given_html[$i] = self::html_entity_decoder($html);
			}

			return $given_html;
		}

		return html_entity_decode($given_html, $quote_style, $charset);
	}

	public static function cleanTitle($str, $striptags = 0)
	{
		// remove comment tags
		$str = preg_replace('#<\!--.*?-->#s', '', $str);

		// replace weird whitespace
		$str = str_replace(chr(194) . chr(160), ' ', $str);

		if ($striptags)
		{
			// remove html tags
			$str = preg_replace('#</?[a-z][^>]*>#usi', '', $str);
			// remove comments tags
			$str = preg_replace('#<\!--.*?-->#us', '', $str);
		}

		return trim($str);
	}

	public static function prepareSelectItem($str, $published = 1, $type = '', $remove_first = 0)
	{

		$str = str_replace(array('&nbsp;', '&#160;'), ' ', $str);
		$str = preg_replace('#- #', '  ', $str);
		for ($i = 0; $remove_first > $i; $i++)
		{
			$str = preg_replace('#^  #', '', $str);
		}
		preg_match('#^( *)(.*)$#', $str, $match);
		list($str, $pre, $name) = $match;

		$pre = preg_replace('#  #', ' ·  ', $pre);
		$pre = preg_replace('#(( ·  )*) ·  #', '\1 »  ', $pre);
		$pre = str_replace('  ', ' &nbsp; ', $pre);

		if ($type == 'separator')
		{
			$pre = '[[:font-weight:normal;font-style:italic;color:grey;:]]' . $pre;
		}
		else if (!$published)
		{
			$pre = '[[:font-style:italic;color:grey;:]]' . $pre;
			$name = $name . ' [' . JText::_('JUNPUBLISHED') . ']';
		}
		else if ($published == 2)
		{
			$pre = '[[:font-style:italic;:]]' . $pre;
			$name = $name . ' [' . JText::_('JARCHIVED') . ']';
		}

		return $pre . $name;
	}

	public static function strReplaceOnce($search, $replace, $str)
	{
		$replace = str_replace(array('\\', '$'), array('\\\\', '\\$'), $replace);

		return preg_replace('#' . preg_quote($search, '#') . '#', $replace, $str, 1);
	}

	/**
	 * Gets the full uri and optionally adds/replaces the hash
	 */
	public static function getURI($hash = '')
	{
		$uri = JURI::getInstance();

		if ($hash != '')
		{
			$uri->setFragment($hash);
		}

		return $uri->toString();
	}

	/**
	 * gets attribute from a tag string
	 */
	public static function fixHtmlTagStructure(&$str)
	{
		// Move div nested inside <p> tags outside of it
		// input: <p><div>...</div></p>
		// output: </p><div>...</div><p>
		$str = preg_replace('#((?:<p(?: [^>]*)?>\s*)?)((?:<br ?/?>)?\s*<div(?: [^>]*)?>.*?</div>\s*(?:<br ?/?>)?)((?:\s*</p>)?)#si', '\3\2\1', $str);

		// Combine duplicate <p> tags
		nnText::combinePTags($str);

		// Remove duplicate ending </p> tags
		nnText::removeDuplicateTags($str, '/p');
	}

	/**
	 * combine duplicate <p> tags
	 * input: <p class="aaa" a="1"><!-- ... --><p class="bbb" b="2">
	 * output: <p class="aaa bbb" a="1" b="2"><!-- ... -->
	 */
	public static function combinePTags(&$str)
	{
		if (!preg_match_all('#(<p(?: [^>]*)?>)\s*((?:<!--.*?-->\s*)?)(<p(?: [^>]*)?>)#si', $str, $tags, PREG_SET_ORDER) > 0)
		{
			return;
		}

		foreach ($tags as $tag)
		{
			$str = str_replace($tag['0'], nnText::combineTags($tag['1'], $tag['3']) . $tag['2'], $str);
		}
	}

	/**
	 * combine tags
	 */
	public static function combineTags($tag1, $tag2)
	{
		// Return if tags are the same
		if ($tag1 == $tag2)
		{
			return $tag1;
		}

		if (!preg_match('#<([a-z][a-z0-9]*)#si', $tag1, $tag_type))
		{
			return $tag2;
		}

		$tag_type = $tag_type[1];

		if (!$attribs = nnText::combineAttributes($tag1, $tag2))
		{
			return '<' . $tag_type . '>';
		}

		return '<' . $tag_type . ' ' . $attribs . '>';
	}

	/**
	 * gets attribute from a tag string
	 */
	public static function getAttribute($attrib, $str)
	{
		// get attribute from string
		if (preg_match('#' . preg_quote($attrib, '#') . '="([^"]*)"#si', $str, $match))
		{
			return $match['1'];
		}

		return '';
	}

	/**
	 * gets attributes from a tag string
	 */
	public static function getAttributes($str)
	{
		$attribs = array();
		if (preg_match_all('#([a-z0-9-_]+)="([^"]*)"#si', $str, $matches, PREG_SET_ORDER) > 0)
		{
			foreach ($matches as $match)
			{
				$attribs[$match['1']] = $match['2'];
			}
		}

		return $attribs;
	}

	/**
	 * combine attribute values in a tag string
	 */
	public static function combineAttributes($string1, $string2)
	{
		$attribs1 = is_array($string1) ? $string1 : nnText::getAttributes($string1);
		$attribs2 = is_array($string2) ? $string2 : nnText::getAttributes($string2);

		$dublicate_attribs = array_intersect_key($attribs1, $attribs2);

		// Fill $attribs with the unique ids
		$attribs = array_diff_key($attribs1, $attribs2) + array_diff_key($attribs2, $attribs1);

		// Add/combine the duplicate ids
		$single_value_attributes = array('id');
		foreach ($dublicate_attribs as $key => $val)
		{
			if (in_array($key, $single_value_attributes))
			{
				$attribs[$key] = $attribs2[$key];
				continue;
			}

			// Combine strings, but remove duplicates
			// "aaa bbb" + "aaa ccc" = "aaa bbb ccc"
			$attribs[$key] = implode(' ', explode(' ', $attribs1[$key]) + explode(' ', $attribs2[$key]));
		}

		foreach ($attribs as $key => &$val)
		{
			$val = $key . '="' . $val . '"';
		}

		return implode(' ', $attribs);
	}

	/**
	 * combine duplicate <p> tags
	 * input: </p><!-- ... --></p>
	 * output: </p><!-- ... -->
	 */
	public static function removeDuplicateTags(&$str, $tag_type = 'p')
	{
		$str = preg_replace('#(<' . $tag_type . '(?: [^>]*)?>\s*(<!--.*?-->\s*)?)<' . $tag_type . '(?: [^>]*)?>#si', '\1', $str);
	}

	/**
	 * Creates an alias from a string
	 * Based on stringURLUnicodeSlug method from the unicode slug plugin by infograf768
	 */
	public static function createAlias($str)
	{
		// Remove < > html entities
		$str = str_replace(array('&lt;', '&gt;'), '', $str);

		// Convert html entities
		$str = html_entity_decode($str, ENT_COMPAT, 'UTF-8');

		// remove html tags
		$str = preg_replace('#</?[a-z][^>]*>#usi', '', $str);
		// remove comments tags
		$str = preg_replace('#<\!--.*?-->#us', '', $str);

		// Replace double byte whitespaces by single byte (East Asian languages)
		$str = preg_replace('/\xE3\x80\x80/', ' ', $str);

		// Remove any '-' from the string as they will be used as concatenator.
		// Would be great to let the spaces in but only Firefox is friendly with this
		$str = str_replace('-', ' ', $str);

		// Replace forbidden characters by whitespaces
		$str = preg_replace('#[,:\#\$\*"@+=;!&\.%()\]\/\'\\\\|\[]#', "\x20", $str);

		// Delete all '?'
		$str = str_replace('?', '', $str);

		// Trim white spaces at beginning and end of alias and make lowercase
		$str = trim($str);

		// Remove any duplicate whitespace and replace whitespaces by hyphens
		$str = preg_replace('#\x20+#', '-', $str);

		// Remove leading and trailing hyphens
		$str = trim($str, '-');

		return JString::strtolower($str);
	}

	/**
	 * Creates an array of different syntaxes of titles to match against a url variable
	 */
	public static function createUrlMatches($titles = array())
	{
		$matches = array();
		foreach ($titles as $title)
		{
			$matches[] = $title;
			$matches[] = JString::strtolower($title);
		}

		$matches = array_unique($matches);

		foreach ($matches as $title)
		{
			$matches[] = htmlspecialchars(html_entity_decode($title, ENT_COMPAT, 'UTF-8'));
		}

		$matches = array_unique($matches);

		foreach ($matches as $title)
		{
			$matches[] = urlencode($title);
			$matches[] = utf8_decode($title);
			$matches[] = str_replace(' ', '', $title);
			$matches[] = trim(preg_replace('#[^a-z0-9]#i', '', $title));
			$matches[] = trim(preg_replace('#[^a-z]#i', '', $title));
		}

		$matches = array_unique($matches);

		foreach ($matches as $i => $title)
		{
			$matches[$i] = trim(str_replace('?', '', $title));
		}

		$matches = array_diff(array_unique($matches), array('', '-'));

		return $matches;
	}

	static function getBody($html)
	{
		if (strpos($html, '<body') === false || strpos($html, '</body>') === false)
		{
			return array('', $html, '');
		}

		$html_split = explode('<body', $html, 2);
		$pre = $html_split['0'];
		$body = '<body' . $html_split['1'];
		$body_split = explode('</body>', $body);
		$post = array_pop($body_split);
		$body = implode('</body>', $body_split) . '</body>';

		return array($pre, $body, $post);
	}
}
