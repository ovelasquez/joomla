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
	<div id="lasts">
    
<?php 
	$contI =0;
	foreach ($list as $item) : ?>
	<?php 
	
	$ddate = date("d",strtotime($item->displayDate)); 
	$mdate = date("M",strtotime($item->displayDate)); 
	$adate = date("y",strtotime($item->displayDate)); 
	$urls = json_decode($item->urls);
	?>
    <?php
		if ($contI==0){
	?>
     <h3><a href="<?php echo $item->displayCategoryLink;?>">» VER TODAS</a>ÚLTIMAS GACETAS</h3>
    <?php
		}
	?>
	<div class="last_box" id="go<?php echo $contI+1; ?>">
        <h5>
          <span>GACETA OFICIAL:</span>
          <?php echo $item->title; ?>
        </h5>
        <p class="last_date"><?php echo $ddate; ?><span><?php echo $mdate; ?>'<?php echo $adate; ?></span></p>
        <h4><?php echo $item->introtext; ?></h4>
        <p class="last_links">
          <a href="<?php echo $item->link; ?>" class="btn_resume">RESUMEN</a>
          <a href="<?php echo BASEURL.str_replace("http://","/images/gacetas/", $urls->urla); ?>" class="btn_download"  target="_blank">DESCARGAR</a>
        </p>
      </div>
	
<?php 
	$contI++;
	endforeach; ?>
    	<div class="clear"></div>

	</div>