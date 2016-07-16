<?php
/**
 * @package     Ads Elite
 * @subpackage  mod_ads_elite
 * @copyright   Copyright (C) 2013 Elite Developers All rights reserved.
 * @license   	GNU/GPL v3 http://www.gnu.org/licenses/gpl.html
 */
 
defined('_JEXEC') or die( 'Restricted access' );

	require_once __DIR__ . '/helper.php';

	$user = JFactory::getUser();
	$user_id = $user->get( 'id' );
	$noartc = $params->get('noartc');
	$usertype = $params->get('usrl');
	$moduleclass_sfx = htmlspecialchars( $params->get( 'moduleclass_sfx' ) );
	$layout =  htmlspecialchars( $params->get( 'layout' , 'default' ) );
	$adscode = ModAdsEliteHelper::getCode($params);

	$db = JFactory::getDBO();
	$query = 'SELECT * FROM #__users as u LEFT JOIN #__user_usergroup_map as ug on u.id = ug.user_id WHERE u.id='.$user_id;
	$db->setQuery($query);
	$user_group = ($row = $db->loadObject()) ? $row->group_id : 0;

	if( (JRequest::getWord( "view" ) != "article") or ($noartc != 1) ) {
		switch ($usertype) {
			case 'au': 
				require( JModuleHelper::getLayoutPath( 'mod_ads_elite' , $layout ) ); 
				break;
			case 'nu': 
				if (!$user_group) { 
					require( JModuleHelper::getLayoutPath( 'mod_ads_elite' , $layout ) );
				} 
				break;
			case 'ru': 
				if ($user_group) { 
					require( JModuleHelper::getLayoutPath( 'mod_ads_elite' , $layout ) );
				} 
				break;
		}
	}