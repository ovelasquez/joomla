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
	foreach ($list as $item) : ?>
	<?php
		if ($contI==0){
	?>  <h5 class="ico_ven">ENLACES DE INTERES EN VENEZUELA</h5>
        <ul class="list_links">        
    <?php
		}
	?>
          	<li>»<a href="<?php echo $item->link; ?>" target="_blank"><?php echo htmlspecialchars($item->title, ENT_COMPAT, 'UTF-8'); ?></a></li>    	
	<?php 
		$contI++;
		if ($contI==count($list)):
	?>      </ul>
    		<p class="see_all"><a href="index.php?option=com_weblinks&view=category&id=<?php echo  $item->catslug;?>">VER TODOS</a></p>
    <?php
		endif;
	endforeach; ?>
      </div>
    