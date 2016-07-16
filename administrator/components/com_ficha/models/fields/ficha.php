<?php

/**
 * @version		$Id: ficha.php 72 2010-11-30 13:48:41Z mmff $
 * @package		Joomla2.5.ArtCamposExtras
 * @subpackage	Components
 * @copyright	Copyright (C) 2005 - 2010 Open Source Matters, Inc. All rights reserved.
 * @author		Mari Flores
 * @link		http://project.tinn-ds.com/ArtCamposExtras/
 * @license		License GNU General Public License version 2 or later
 */

// No direct access to this file
defined('_JEXEC') or die;

// import the list field type
jimport('joomla.form.helper');
JFormHelper::loadFieldClass('list');

/**
 * Ficha Form Field class for the Ficha component
 */
class JFormFieldFicha extends JFormFieldList
{
	/**
	 * The field type.
	 *
	 * @var		string
	 */
	protected $type = 'Ficha';

	/**
	 * Method to get a list of options for a list input.
	 *
	 * @return	array		An array of JHtml options.
	 */
	protected function getOptions() 
	{
			$db = JFactory::getDBO();

			/// $query = new JDatabaseQuery; WARNING - There's an error in this line, JDatabaseQuery is an abstract class
			$query = $db->getQuery(true); // THIS IS THE FIX, WARNING IT MUST BE FIXED IN THE ZIP FILES

			$query->select('#__ficha.id as id,greeting,#__categories.title as category,catid');
			$query->from('#__ficha');
			$query->leftJoin('#__categories on catid=#__categories.id');
			$db->setQuery((string)$query);
			$messages = $db->loadObjectList();
			$options = array();
			if ($messages)
			{
					foreach($messages as $message) 
					{
							$options[] = JHtml::_('select.option', $message->id, $message->greeting .
												  ($message->catid ? ' (' . $message->category . ')' : ''));
					}
			}
			$options = array_merge(parent::getOptions(), $options);
			return $options;
	}
}
