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
      <div class="box_sumarios">
    <?php 
	$contI =0;
	setlocale(LC_ALL, 'es_VE');
	setlocale(LC_TIME, 'Spanish');
	//echo strftime("%A", mktime(0, 0, 0, 12, 22, 1978));
	foreach ($list as $item) : ?>
	<?php
		if ($contI==0){
	?>  <h4>
          <a href="<?php echo $item->displayCategoryLink;?>">» VER TODOS</a>
          <span>ÚLTIMOS SUMARIOS</span>
        </h4>
        <ul class="list_sum">        
    <?php
		}
	?>
          <li>
            <a href="<?php echo $item->link; ?>"><?php echo $item->title; ?></a><span class="date_sum"><?php echo ucfirst (strftime("%d/%m/%Y",strtotime($item->displayDate)));?></span>
                        
          </li>
    	
	<?php 
		$contI++;
		if ($contI==count($list)):
	?>      </ul>
    <?php
		endif;
	endforeach; ?>
      </div>
    