<?php
/**
 * @copyright	Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;

/**
 * Fichas Search plugin
 *
 * @package		Joomla.Plugin
 * @subpackage	Search.fichas
 * @since		1.6
 */
class plgSearchFichas extends JPlugin
{
	/**
	 * Constructor
	 *
	 * @access      protected
	 * @param       object  $subject The object to observe
	 * @param       array   $config  An array that holds the plugin configuration
	 * @since       1.5
	 */
	public function __construct(& $subject, $config)
	{
		parent::__construct($subject, $config);
		$this->loadLanguage();
	}

	/**
	* @return array An array of search areas
	*/
	function onContentSearchAreas()
	{
		static $areas = array(
			'fichas' => 'PLG_SEARCH_FICHAS_FICHAS'
		);
		return $areas;
	}

	/**
	* Fichas Search method
	*
	* The sql must return the following fields that are used in a common display
	* routine: href, title, section, created, text, browsernav
	* @param string Target search string
	* @param string matching option, exact|any|all
	* @param string ordering option, newest|oldest|popular|alpha|category
	 */
	function onContentSearch($text, $phrase='', $ordering='', $areas=null)
	{
		$db		= JFactory::getDbo();
		$app	= JFactory::getApplication();
		$user	= JFactory::getUser();
		$groups	= implode(',', $user->getAuthorisedViewLevels());
		$result = array();

		if (is_array($areas)) {
			if (!array_intersect($areas, array_keys($this->onContentSearchAreas()))) {
				return array();
			}
		}

		$sContent		= $this->params->get('search_content',		1);
		$sArchived		= $this->params->get('search_archived',		1);
		$limit			= $this->params->def('search_limit',		50);
		$state = array();
		if ($sContent) {
			$state[]=1;
		}
		if ($sArchived) {
			$state[]=2;
		}

		$text = trim($text);
		if ($text == '') {
			return array();
		}

		$section = JText::_('PLG_SEARCH_FICHAS_FICHAS');
		
		switch ($phrase) {
			case 'exact':
				$text = $db->Quote('%' . $db->getEscaped($text, true) . '%', false);
				$wheres2[] = "LOWER(f.greeting) LIKE " . $text;
				$wheres2[] = "LOWER(f.entemisor) LIKE " . $text;
				$wheres2[] = "LOWER(f.norma) LIKE " . $text;
				$wheres2[] = "LOWER(f.objeto) LIKE " . $text;
				$wheres2[] = "LOWER(f.vigencia) LIKE " . $text;
				$wheres2[] = "LOWER(f.derogatoria) LIKE " . $text;
				$wheres2[] = "LOWER(f.nota) LIKE " . $text;
				$wheres2[] = "LOWER(f.gaceta_txt) LIKE " . $text;
				$where = '(' . implode(') OR (', $wheres2) . ')';
				break;
			case 'all':
			case 'any':
			default:
				$words = explode(' ', $text);
				$wheres = array();
				foreach ($words as $word) {
					$word = $db->Quote('%' . $db->getEscaped($word, true) . '%', false);
					$wheres2 = array();
					$wheres2[] = "LOWER(f.greeting) LIKE " . $word;
					$wheres2[] = "LOWER(f.entemisor) LIKE " . $word;
					$wheres2[] = "LOWER(f.norma) LIKE " . $word;
					$wheres2[] = "LOWER(f.objeto) LIKE " . $word;
					$wheres2[] = "LOWER(f.vigencia) LIKE " . $word;
					$wheres2[] = "LOWER(f.derogatoria) LIKE " . $word;
					$wheres2[] = "LOWER(f.nota) LIKE " . $word;
					$wheres2[] = "LOWER(f.gaceta_txt) LIKE " . $word;
					$wheres[] = implode(' OR ', $wheres2);
				}
				$where = '(' . implode(($phrase == 'all' ? ') AND (' : ') OR ('), $wheres) . ')';
				break;
		}
		
		

		switch ($ordering) {
			case 'alpha':
				$order = 'f.greeting ASC';
				break;

			case 'category':
			case 'popular':
			case 'newest':
			case 'oldest':
			default:
				$order = 'f.greeting DESC';
		}

		$text	= $db->Quote('%'.$db->escape($text, true).'%', false);

		$rows = array();
		//if (!empty($state)) {
			$query	= $db->getQuery(true);
			
			$query->select('f.greeting AS title, f.created AS created, f.id, '
					. ' f.gaceta_txt AS text,'
					. $db->Quote($section).' AS section,'
					. '\'2\' AS browsernav');
			$query->from('#__ficha AS f');
			$query->where($where);
			$query->order($order);

			
			$db->setQuery($query, 0, $limit);
			$rows = $db->loadObjectList();

			if ($rows) {
				
				foreach($rows as $key => $row) {					
					$rows[$key]->href = 'index.php?option=com_ficha&view=ficha&id='.$row->id;
					$rows[$key]->title = $row->title;
					$rows[$key]->text = $row->title;
					$rows[$key]->text .= ($row->text) ? ', '.$row->text : '';	
					$result[] = $rows[$key];				
				}
			}
		//}
		
		
		
		return $result;
	}
}
