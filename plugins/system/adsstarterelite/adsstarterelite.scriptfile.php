<?php
/**
 * @package     Ads Elite
 * @subpackage  plg_ads_starter_elite
 * @copyright   Copyright (C) 2013 Elite Developers All rights reserved.
 * @license   	GNU/GPL v3 http://www.gnu.org/licenses/gpl.html
 */

defined( '_JEXEC' ) or die( 'Restricted access' );

class plgSystemAdsStarterEliteInstallerScript{ 

	function update( $parent ) { 
	
		$this->install( $parent );
	
	}

	function install( $parent ) { 

		$db = JFactory::getDbo() ;
		$tableExtensions = $db->quoteName( "#__extensions" );
		$columnElement = $db->quoteName( "element" );
		$columnType = $db->quoteName( "type" );
		$columnEnabled = $db->quoteName( "enabled" );
		$db->setQuery( "UPDATE $tableExtensions SET $columnEnabled=1 WHERE $columnElement='adsstarterelite' AND $columnType='plugin'" );
		$db->query();
		echo '<br /><p>' . JText::_( 'Plug-in Ads Starter Elite Enabled' ) . '</p><br />' ;    
	
	} 
}
?>