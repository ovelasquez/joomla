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
    	<div id="slider">
        	
        <?php foreach ($list as $item) : ?>
        <a href="<?php echo $item->link; ?>">
        <?php 
		$images = json_decode($item->images);
		?>
        <img src="<?php echo $images->image_intro; ?>"/>
        <span><?php echo $item->title;?></span>
        </a>
        <?php endforeach; ?>
        </div>
<?php

?>