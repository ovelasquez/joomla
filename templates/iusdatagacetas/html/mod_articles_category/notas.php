<?php
/**
 * @package		Joomla.Site
 * @subpackage	mod_articles_category
 * @copyright	Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;
?>  
    <?php 
	$contI =0;
	foreach ($list as $item) : ?>
	<?php
		if ($contI==0){
	?>  <div id="index_ut">      
    <?php
		}
	?>
        	<h4><?php echo $item->title; ?></h4>
            <?php echo $item->introtext; ?>
    	
	<?php 
		$contI++;
		if ($contI==count($list)):
	?>  </div>
    <?php
		endif;
	endforeach; ?>
    