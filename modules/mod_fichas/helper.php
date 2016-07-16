<?php
/**
 * @package		Joomla.Site
 * @subpackage	mod_fichas
 * @copyright	Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;

class modFichasHelper
{
	/**
	 * Method to build an SQL query to load the list data.
	 *
	 * @return	string	An SQL query
	 */
	static function  getListFichas() 
	{
		$db =  JFactory::getDBO();
		$query = $db->getQuery(true);

		$query->select('f.id,f.greeting,f.created,f.created_by,f.publish_up,f.artid,f.gaceta_txt');
		$query->from('#__ficha AS f');

		// Join on article table.
		$query->select('c.title AS article_title');
		$query->join('LEFT', '#__content AS c on c.id = f.artid');

		// Join on user table.
		$query->select('u.name AS author');
		$query->join('LEFT', '#__users AS u on u.id = f.created_by');
		
		//$query->where('a.id = ' . (int) $pk);

		// Filter by start and end dates.
		$nullDate = $db->Quote($db->getNullDate());
		$date = JFactory::getDate();

		$nowDate = $db->Quote($date->toSql());

		$query->where('(f.publish_up = ' . $nullDate . ' OR f.publish_up <= ' . $nowDate . ')');
		
		$query->order('f.publish_up desc');
		
		$db->setQuery($query,0,3);

		$data = $db->loadObjectList();
		/**/
		
		return $data;
	}
}
