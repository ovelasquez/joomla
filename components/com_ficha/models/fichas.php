<?php

/**
 * @version		$Id: fichas.php 46 2010-11-21 17:27:33Z mmff $
 * @package		Joomla2.5.ArtCamposExtras
 * @subpackage	Components
 * @copyright	Copyright (C) 2005 - 2010 Open Source Matters, Inc. All rights reserved.
 * @author		Mari Flores
 * @link		http://project.tinn-ds.com/ArtCamposExtras/
 * @license		License GNU General Public License version 2 or later
 */

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

// import the Joomla modellist library
jimport('joomla.application.component.modellist');

/**
 * Fichas Model
 */
class FichaModelFichas extends JModelList
{
	/**
	 * Method to build an SQL query to load the list data.
	 *
	 * @return	string	An SQL query
	 */
	protected function getListQuery() 
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
		
		/*$db->setQuery($query);

		$data = $db->loadObject();
		*/
		
		/*// Create a new query object.
		$db = JFactory::getDBO();
		$query = $db->getQuery(true);

		// Select some fields
		$query->select('id,greeting,created,created_by,publish_up');

		// From the ficha table
		$query->from('#__ficha');
		*/
		//var_dump($query); die();
		return $query;
	}
}
