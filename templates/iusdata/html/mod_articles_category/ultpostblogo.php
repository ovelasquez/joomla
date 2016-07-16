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
      <div class="box_home">
    <?php 
	$contI =0;
	setlocale(LC_ALL, 'es_ES');
	setlocale(LC_TIME, 'es_ES');
	//echo strftime("%A", mktime(0, 0, 0, 12, 22, 1978));
	foreach ($list as $item) : ?>
	<?php
		if ($contI==0){
	?>  <h4>
          <a href="<?php echo $item->displayCategoryLink;?>">» VER TODOS</a>
          <span>BLOG</span>
        </h4>
        <ul class="list_posts">        
    <?php
		}
	?>
          <li>
            <span class="posts_date">» <?php echo ucfirst (utf8_encode(strftime("%A %d de %B del %Y",strtotime($item->displayDate))));?></span>
            <p><?php echo $item->title; ?></p>
            <p class="post_more"><a href="<?php echo $item->link; ?>">» Ver más</a></p>
          </li>
    	
	<?php 
		$contI++;
		if ($contI==count($list)):
	?>      </ul>
    <?php
		endif;
	endforeach; ?>
      </div>
    