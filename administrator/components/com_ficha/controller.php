<?php

/**
 * @version		$Id: controller.php 46 2010-11-21 17:27:33Z mmff $
 * @package		Joomla2.5.ArtCamposExtras
 * @subpackage	Components
 * @copyright	Copyright (C) 2005 - 2010 Open Source Matters, Inc. All rights reserved.
 * @author		Mari Flores
 * @link		http://project.tinn-ds.com/ArtCamposExtras/
 * @license		License GNU General Public License version 2 or later
 */

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

// import Joomla controller library
jimport('joomla.application.component.controller');

/**
 * General Controller of Ficha component
 */
class FichaController extends JController
{
	/**
	 * display task
	 *
	 * @return void
	 */
	function display($cachable = false) 
	{
		// set default view if not set
		JRequest::setVar('view', JRequest::getCmd('view', 'Fichas'));

		// call parent behavior
		parent::display($cachable);
	}
	
	public function listArt() {
		$catid = JRequest::getVar( 'catid', '', 'post', 'cmd' ) ;
		
		// Get the database object.
		$db = JFactory::getDBO();

		// Create a database query to build match the token.
		$query = $db->getQuery(true);
		$query->select('a.id, a.title');
		$query->from('#__content AS a');

		$query->where('a.catid = ' . $catid);
			
		// Get the terms.
		$db->setQuery($query);
		$matches = $db->loadObjectList();
		
		if (!empty($matches)){
			foreach ($matches as $obj){
				echo "<option value='".$obj->id."'>".$obj->title."</option>";
			}
		}
	}
}
