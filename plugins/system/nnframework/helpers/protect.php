<?php
/**
 * NoNumber Framework Helper File: Protect
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
class NNProtect
{
	static $protect_a = '<!-- >> NN_PROTECTED >>';
	static $protect_b = ' << NN_PROTECTED << -->';
	static $protect_tags_a = '<!-- >> NN_PROTECTED_TAGS >>';
	static $protect_tags_b = ' << NN_PROTECTED_TAGS << -->';
	static $sourcerer_tag = '';

	/**
	 * check if page should be protected for certain extensions
	 */
	public static function isProtectedPage($ext = '', $hastags = 0, $exclude_formats = array('pdf'))
	{
		// return if disabled via url
		// return if current page is pdf format
		// return if current page is an image
		// return if current page is NoNumber QuickPage
		// return if current page is a JoomFish or Josetta page
		return (
			($ext && JFactory::getApplication()->input->get('disable_' . $ext))
			|| in_array(JFactory::getApplication()->input->get('format'), $exclude_formats)
			|| in_array(JFactory::getApplication()->input->get('view'), array('image', 'img'))
			|| in_array(JFactory::getApplication()->input->get('type'), array('image', 'img'))
			|| ($hastags
				&& (
					JFactory::getApplication()->input->getInt('nn_qp', 0)
					|| in_array(JFactory::getApplication()->input->get('option'), array('com_joomfishplus', 'com_josetta'))
				))
		);
	}

	/**
	 * check if this is a Joomla 3 setup
	 * used in Joomla 2.5 code to show error after upgrade to Joomla 3
	 */
	public static function isJoomla3($extension = '')
	{
		if (!version_compare(JVERSION, '3.0', '>='))
		{
			return false;
		}

		if ($extension)
		{
			NNProtect::throwError(
				JText::sprintf('NN_JOOMLA2_VERSION_ON_JOOMLA3', JText::_($extension))
			);
		}

		return true;
	}

	/**
	 * check if page is an admin page
	 */
	public static function isAdmin($block_login = 0)
	{
		return (
			JFactory::getApplication()->isAdmin()
			&& (!$block_login || JFactory::getApplication()->input->get('option') != 'com_login')
			&& JFactory::getApplication()->input->get('task') != 'preview'
		);
	}

	/**
	 * check if page is an edit page
	 */
	public static function isEditPage()
	{
		$option = JFactory::getApplication()->input->get('option');
		// always return false for these components
		if (in_array($option, array('com_rsevents', 'com_rseventspro')))
		{
			return 0;
		}

		$task = JFactory::getApplication()->input->get('task');
		$view = JFactory::getApplication()->input->get('view');
		if (strpos($task, '.') !== false)
		{
			$task = explode('.', $task);
			$task = array_pop($task);
		}
		if (strpos($view, '.') !== false)
		{
			$view = explode('.', $view);
			$view = array_pop($view);
		}

		return (
			in_array($task, array('edit', 'form', 'submission'))
			|| in_array($view, array('edit', 'form'))
			|| in_array(JFactory::getApplication()->input->get('do'), array('edit', 'form'))
			|| in_array(JFactory::getApplication()->input->get('layout'), array('edit', 'form', 'write'))
			|| in_array(JFactory::getApplication()->input->get('option'), array('com_contentsubmit', 'com_cckjseblod'))
			|| NNProtect::isAdmin()
		);
	}

	/**
	 * Check if the component is installed
	 *
	 * @return bool
	 */
	public static function isComponentInstalled($ext)
	{
		jimport('joomla.filesystem.file');

		return JFile::exists(JPATH_ADMINISTRATOR . '/components/com_' . $ext . '/' . $ext . '.php');
	}

	/**
	 * Check if the component is installed
	 *
	 * @return bool
	 */
	public static function isSystemPluginInstalled($ext)
	{
		jimport('joomla.filesystem.file');

		return JFile::exists(JPATH_PLUGINS . '/system/' . $ext . '/' . $ext . '.php');
	}

	/**
	 * the regular expression to mach the edit form
	 */
	public static function getFormRegex($regex_format = 0)
	{
		$regex = '(<' . 'form\s[^>]*((id|name)="(adminForm|postform|submissionForm|default_action_user)|action="[^"]*option=com_myjspace&(amp;)?view=see)")';

		if ($regex_format)
		{
			$regex = '#' . $regex . '#si';
		}

		return $regex;
	}

	/**
	 * protect all text based form fields
	 */
	public static function protectFields(&$str)
	{
		if (strpos($str, '<input') === false && strpos($str, '<textarea') === false)
		{
			return;
		}

		$regex = '#(?:(?:'
			. '(?:<' . 'input\s[^>]*type="text"[^>]*>)'
			. '|(?:<' . 'textarea(\s[^>]*)?>.*?</textarea>)'
			. ')\s*)+#si';

		self::protectByRegex($str, $regex);
	}

	/**
	 * protect all text based form fields
	 */
	public static function protectScripts(&$str)
	{
		if (strpos($str, '</script>') === false)
		{
			return;
		}

		$regex = '#<script[\s>].*?</script>#si';

		self::protectByRegex($str, $regex);
	}

	/**
	 * protect all text based form fields
	 */
	public static function protectHtmlTags(&$str)
	{
		if (strpos($str, '</') === false)
		{
			return;
		}

		$regex = '#</?[a-z][^>]*>#si';

		self::protectByRegex($str, $regex);
	}

	/**
	 * protect all text based form fields
	 */
	private static function protectByRegex(&$str, $regex)
	{
		if (preg_match_all($regex, $str, $matches) < 1)
		{
			return;
		}
		$matches = array_unique($matches['0']);

		foreach ($matches as $match)
		{
			$replacements[] = self::protectString($match);
		}

		$str = str_replace($matches, $replacements, $str);
	}

	/**
	 * protect given plugin style tags
	 */
	public static function protectTags(&$str, $tags = array())
	{
		list($tags, $protected) = self::prepareTags($tags);

		$str = str_replace($tags, $protected, $str);
	}

	/**
	 * replace any protected tags to original
	 */
	public static function unprotectTags(&$str, $tags = array())
	{
		list($tags, $protected) = self::prepareTags($tags);

		$str = str_replace($protected, $tags, $str);
	}

	/**
	 * protect array of strings
	 */
	public static function protectInString(&$str, $unprotected = array(), $protected = array())
	{
		$protected = empty($protected) ? self::protectArray($unprotected) : $protected;

		$str = str_replace($unprotected, $protected, $str);
	}

	/**
	 * replace any protected tags to original
	 */
	public static function unprotectInString(&$str, $unprotected = array(), $protected = array())
	{
		$protected = empty($protected) ? self::protectArray($unprotected) : $protected;

		$str = str_replace($protected, $unprotected, $str);
	}

	private static function initSourcererTag()
	{
		if (self::$sourcerer_tag === 0)
		{
			return false;
		}

		require_once JPATH_PLUGINS . '/system/nnframework/helpers/parameters.php';
		$params = NNParameters::getInstance()->getPluginParams('sourcerer');
		self::$sourcerer_tag = isset($params->syntax_word) ? $params->syntax_word : 0;

		return true;
	}

	/**
	 * protect all Sourcerer blocks
	 */
	public static function protectSourcerer(&$str)
	{
		if (!self::initSourcererTag())
		{
			return;
		}

		if (strpos($str, '{/' . self::$sourcerer_tag . '}') === false)
		{
			return;
		}

		$regex = '#' . preg_quote('{' . self::$sourcerer_tag, '#') . '[\s\}].*?' . preg_quote('{/' . self::$sourcerer_tag . '}', '#') . '#si';

		if (preg_match_all($regex, $str, $matches) > 0)
		{
			$matches = array_unique($matches['0']);

			foreach ($matches as $match)
			{
				$str = str_replace($match, self::protectString($match), $str);
			}
		}
	}

	/**
	 * protect complete adminForm
	 */
	public static function protectForm(&$str, $tags = array())
	{
		if (!self::isEditPage())
		{
			return;
		}

		list($tags, $protected) = self::prepareTags($tags);

		$str = preg_replace(self::getFormRegex(1), '<!-- TMP_START_EDITOR -->\1', $str);
		$str = explode('<!-- TMP_START_EDITOR -->', $str);

		foreach ($str as $i => $s)
		{
			if (!empty($s) != '' && fmod($i, 2))
			{
				// Protect entire form
				if (empty($tags))
				{
					$s = explode('</form>', $s, 2);
					$s['0'] = self::protectString($s['0'] . '</form>');
					$str[$i] = implode('', $s);
					continue;
				}

				$pass = 0;
				foreach ($tags as $tag)
				{
					if (strpos($s, $tag) !== false)
					{
						$pass = 1;
						break;
					}
				}
				if ($pass)
				{
					$s = explode('</form>', $s, 2);
					// protect tags only inside form fields
					if (preg_match_all('#(?:<textarea[^>]*>.*?<\/textarea>|<input[^>]*>)#si', $s['0'], $matches) > 0)
					{
						$matches = array_unique($matches['0']);

						foreach ($matches as $match)
						{
							$field = str_replace($tags, $protected, $match);
							$s['0'] = str_replace($match, $field, $s['0']);
						}
					}
					$str[$i] = implode('</form>', $s);
				}
			}
		}

		$str = implode('', $str);
	}

	/**
	 * replace any protected text to original
	 */
	public static function unprotect(&$str)
	{
		$regex = '#' . preg_quote(self::$protect_a, '#') . '(.*?)' . preg_quote(self::$protect_b, '#') . '#si';
		while (preg_match_all($regex, $str, $matches, PREG_SET_ORDER) > 0)
		{
			foreach ($matches as $match)
			{
				$str = str_replace($match['0'], base64_decode($match['1']), $str);
			}
		}
	}

	/**
	 * prepare the tags and protected tags array
	 */
	private static function prepareTags($tags)
	{
		if (!is_array($tags))
		{
			$tags = array($tags);
		}

		foreach ($tags as $i => $tag)
		{
			if ($tag['0'] == '{')
			{
				continue;
			}

			$tags[$i] = '{' . $tag;
			$tags[] = '{/' . $tag;
		}

		return array($tags, self::protectArray($tags, 1));
	}

	/**
	 * encode string
	 */
	public static function protectString($str, $istag = 0)
	{
		if ($istag)
		{
			return self::$protect_tags_a . base64_encode($str) . self::$protect_tags_b;
		}

		return self::$protect_a . base64_encode($str) . self::$protect_b;
	}

	/**
	 * decode string
	 */
	public static function unprotectString($str, $istag = 0)
	{
		if ($istag)
		{
			return self::$protect_tags_a . base64_decode($str) . self::$protect_tags_b;
		}

		return self::$protect_a . base64_decode($str) . self::$protect_b;
	}

	/**
	 * encode tag string
	 */
	public static function protectTag($str)
	{
		return self::protectString($str, 1);
	}

	/**
	 * encode array of strings
	 */
	public static function protectArray($arr, $istag = 0)
	{
		foreach ($arr as &$str)
		{
			$str = self::protectString($str, $istag);
		}

		return $arr;
	}

	/**
	 * decode array of strings
	 */
	public static function unprotectArray($arr, $istag = 0)
	{
		foreach ($arr as &$str)
		{
			$str = self::unprotectString($str, $istag);
		}

		return $arr;
	}

	/**
	 * replace any protected tags to original
	 */
	public static function unprotectForm(&$str, $tags = array())
	{
		// Protect entire form
		if (empty($tags))
		{

			NNProtect::unprotect($str);

			return;
		}

		NNProtect::unprotectTags($str, $tags);
	}

	/**
	 * remove inline comments in scrips and styles
	 */
	public static function removeInlineComments(&$str, $name)
	{
		$str = preg_replace('#\s*/\* (START|END): ' . $name . ' [a-z]* \*/\s*#s', "\n", $str);
	}

	/**
	 * remove tags from title tags
	 */
	public static function removeFromHtmlTagContent(&$str, $tags, $htmltags = array('title'))
	{
		list($tags, $protected) = self::prepareTags($tags);

		if (!is_array($htmltags))
		{
			$htmltags = array($htmltags);
		}

		if (preg_match_all('#(<(' . implode('|', $htmltags) . ')(?:\s[^>]*?)>)(.*?)(</\2>)#si', $str, $matches, PREG_SET_ORDER) > 0)
		{
			foreach ($matches as $match)
			{
				$content = $match['2'];
				foreach ($tags as $tag)
				{
					$content = preg_replace('#' . preg_quote('#', $tag) . '.*?\}#si', '', $content);
				}
				$str = str_replace($match['0'], $match['1'] . $content . $match['3'], $str);
			}
		}
	}

	/**
	 * remove tags from tag attributes
	 */
	public static function removeFromHtmlTagAttributes(&$str, $tags, $attribs = array('title', 'alt'))
	{
		list($tags, $protected) = self::prepareTags($tags);

		if (!is_array($attribs))
		{
			$attribs = array($attribs);
		}

		if (preg_match_all('#\s(?:' . implode('|', $attribs) . ')\s*=\s*".*?"#si', $str, $matches) > 0)
		{
			$matches = array_unique($matches['0']);

			foreach ($matches as $match)
			{
				$title = $match;
				foreach ($tags as $tag)
				{
					$title = preg_replace('#' . preg_quote($tag, '#') . '.*?\}#si', '', $title);
				}
				$str = str_replace($match, $title, $str);
			}
		}
	}

	/**
	 * Check if article passes security levels
	 */
	static function articlePassesSecurity(&$article, $securtiy_levels = array())
	{
		if (!isset($article->created_by))
		{
			return true;
		}

		if (empty($securtiy_levels))
		{
			return true;
		}

		if (is_string($securtiy_levels))
		{
			$securtiy_levels = array($securtiy_levels);
		}

		if (
			!is_array($securtiy_levels)
			|| in_array('-1', $securtiy_levels)
		)
		{
			return true;
		}

		// Lookup group level of creator
		$user_groups = new JAccess;
		$user_groups = $user_groups->getGroupsByUser($article->created_by);

		// Return true if any of the security levels are found in the users groups
		return count(array_intersect($user_groups, $securtiy_levels));
	}

	/**
	 * Place an error in the message queue
	 */
	static function throwError($text)
	{
		// Return if page is not an admin page or the admin login page
		if (
			!JFactory::getApplication()->isAdmin()
			|| JFactory::getUser()->get('guest')
		)
		{
			return;
		}

		// Check if message is not already in queue
		$messagequeue = JFactory::getApplication()->getMessageQueue();
		foreach ($messagequeue as $message)
		{
			if ($message['message'] == $text)
			{
				return;
			}
		}

		JFactory::getApplication()->enqueueMessage($text, 'error');
	}
}
