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
		// Create a new query object.
		$db = JFactory::getDBO();
		$query = $db->getQuery(true);

		// Select some fields
		$query->select('id,greeting');

		// From the ficha table
		$query->from('#__ficha');
		return $query;
	}
}
