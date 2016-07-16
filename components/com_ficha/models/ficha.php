<?php

/**
 * @version		$Id: ficha.php 15 2009-11-02 18:37:15Z mmff $
 * @package		Joomla2.5.ArtCamposExtras
 * @subpackage	Components
 * @copyright	Copyright (C) 2005 - 2010 Open Source Matters, Inc. All rights reserved.
 * @author		Mari Flores
 * @link		http://project.tinn-ds.com/ArtCamposExtras/
 * @license		License GNU General Public License version 2 or later
 */

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

// import Joomla modelitem library
jimport('joomla.application.component.modelitem');

/**
 * Ficha Model
 */
class FichaModelFicha extends JModelItem
{
	/**
	 * @var string msg
	 */
	protected $msg;
	protected $item;

	/**
	 * Returns a reference to the a Table object, always creating it.
	 *
	 * @param	type	The table type to instantiate
	 * @param	string	A prefix for the table class name. Optional.
	 * @param	array	Configuration array for model. Optional.
	 * @return	JTable	A database object
	 * @since	1.6
	 */
	public function getTable($type = 'Ficha', $prefix = 'FichaTable', $config = array()) 
	{
		return JTable::getInstance($type, $prefix, $config);
	}
	/**
	 * Get the message
	 * @return string The message to be displayed to the user
	 */
	public function getMsg() 
	{
		if (!isset($this->msg)) 
		{
			$id = JRequest::getInt('id');
			// Get a TableFicha instance
			$table = $this->getTable();

			// Load the message
			$table->load($id);

			// Assign the message
			$this->msg = $table->greeting;
		}
		return $this->msg."hj b";
	}
	
	public function getItem() 
	{
	
		$id = JRequest::getInt('id');
		$db =  JFactory::getDBO();
		$query = $db->getQuery(true);

		$query->select('f.id,f.greeting,f.created,f.created_by,f.publish_up,f.artid,f.entemisor,f.norma,f.objeto,f.vigencia,f.derogatoria,f.nota,f.gaceta_txt');
		$query->from('#__ficha AS f');

		// Join on article table.
		$query->select('c.title AS article_title');
		$query->join('LEFT', '#__content AS c on c.id = f.artid');

		// Join on user table.
		$query->select('u.name AS author');
		$query->join('LEFT', '#__users AS u on u.id = f.created_by');
		
				
		$query->where('f.id = ' . (int) $id);

		// Filter by start and end dates.
		$nullDate = $db->Quote($db->getNullDate());
		$date = JFactory::getDate();

		$nowDate = $db->Quote($date->toSql());

		$query->where('(f.publish_up = ' . $nullDate . ' OR f.publish_up <= ' . $nowDate . ')');
		
		$db->setQuery($query);

		$data = $db->loadObject();
		
		$this->item = $data;
		
		return $this->item;
	}
}
