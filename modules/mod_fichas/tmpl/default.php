<?php
/**
 * @package		Joomla.Site
 * @subpackage	mod_fichas
 * @copyright	Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;
?>
  <div class="box_home box_fichas">
    <?php 
	//var_dump($items);
	$contI =0;
	setlocale(LC_ALL, 'es_VE');
	setlocale(LC_TIME, 'Spanish');
	//echo strftime("%A", mktime(0, 0, 0, 12, 22, 1978));
	foreach ($items as $item) : ?>
	<?php
		if ($contI==0){
	?>  <h4>
          <a href="<?php echo JRoute::_('index.php?option=com_ficha&view=fichas'); ?>">» VER TODAS</a>
          <span>ÚLTIMAS FICHAS</span>
        </h4>
        <ul class="list_posts">        
    <?php
		}
	?>
          <li>
            <span class="posts_date">» <?php echo JHtml::_('date', $item->created);?></span>
            <p><?php echo $item->greeting; ?></p>
            <p class="post_more"><a href="<?php echo JRoute::_('index.php?option=com_ficha&view=ficha&id=' . $item->id); ?>">» Ver más</a></p>
          </li>
    	
	<?php 
		$contI++;
		if ($contI==count($items)):
	?>      </ul>
    <?php
		endif;
	endforeach; ?>
      </div>