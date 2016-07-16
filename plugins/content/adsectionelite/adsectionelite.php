<?php
/**
 * @package     AdSection Elite
 * @subpackage  plg_adsection_elite
 * @copyright   Copyright (C) 2013 Elite Developers All rights reserved.
 * @license   	GNU/GPL v3 http://www.gnu.org/licenses/gpl.html
 */

defined( '_JEXEC' ) or die( 'Restricted access' );

jimport( 'joomla.plugin.plugin' );
jimport( 'joomla.environment.browser' );
 
class plgContentAdSectionElite extends JPlugin {
	
	public function onContentPrepare( $context , &$article , &$params , $limitstart ) {
 
		if ( $context == 'mod_custom.content' ) {
            return ;
        }	
		if ( ( JRequest :: getVar( 'view' ) ) == 'item' ) {
			$article->introtext = "\r\n<!-- google_ad_section_start -->\r\n" . $article->introtext . "\r\n<!-- google_ad_section_end -->\r\n" ;
		} else {
			$article->text = "\r\n<!-- google_ad_section_start -->\r\n" . $article->text . "\r\n<!-- google_ad_section_end -->\r\n" ;
		}		
		return ; 
		
	}
}
?>