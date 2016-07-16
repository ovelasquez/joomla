<?php
/**
 * @package     Ads Elite
 * @subpackage  mod_ads_elite
 * @copyright   Copyright (C) 2013 Elite Developers All rights reserved.
 * @license   	GNU/GPL v3 http://www.gnu.org/licenses/gpl.html
 */

defined('_JEXEC') or die( 'Restricted access' );
if ( $moduleclass_sfx ) {
	$adscode = '<div class="ads' . $moduleclass_sfx . '">' . $adscode . '</div>';
}
echo $adscode;
?>