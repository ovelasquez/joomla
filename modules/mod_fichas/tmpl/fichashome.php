<?php
/**
 * @package		Joomla.Site
 * @subpackage	mod_fichas
 * @copyright	Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;
$list = $items;
?>
	<div id="lasts" class="lastsfch">
    
<?php 
	$contI =0;
	foreach ($list as $item) : ?>
	<?php 
	$ddate = date("d",strtotime($item->publish_up)); 
	$mdate = date("M",strtotime($item->publish_up)); 
	$adate = date("y",strtotime($item->publish_up)); 
	?>
    <?php
		if ($contI==0){
	?>
     <h3><a href="<?php echo JRoute::_('index.php?option=com_ficha&view=fichas'); ?>">» VER TODAS</a><span>ÚLTIMAS FICHAS</span></h3>
    <?php
		}
	?>
	<div class="last_box" id="go<?php echo $contI+1; ?>">
        <h5>
          <span>FICHA DE GACETA OFICIAL:</span>
          <?php echo substr($item->gaceta_txt,0,7); ?>
        </h5>
        <p class="last_date"><?php echo $ddate; ?><span><?php echo $mdate; ?>'<?php echo $adate; ?></p>
        <h4><?php echo $item->greeting; ?></h4>
        <p class="last_links">
          <a href="<?php echo JRoute::_('index.php?option=com_ficha&view=ficha&id=' . $item->id); ?>" class="btn_resume">Ver más</a>
        </p>
      </div>
	
<?php 
	$contI++;
	endforeach; ?>
    	<div class="clear"></div>

	</div>