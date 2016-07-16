<?php
/**
 * @version		$Id: default.php 15 2009-11-02 18:37:15Z mmff $
 * @package		Joomla2.5.ArtCamposExtras
 * @subpackage	Components
 * @copyright	Copyright (C) 2005 - 2010 Open Source Matters, Inc. All rights reserved.
 * @author		Mari Flores
 * @link		http://project.tinn-ds.com/ArtCamposExtras/
 * @license		License GNU General Public License version 2 or later
 */
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
?>
<div class="fichas">
<dl class="article-info">
<dd class="category-name">CATEGORÍA: <a href="<?php echo JRoute::_('index.php?option=com_ficha&view=fichas' ); ?>">FICHAS</a></dd>
<dd class="published">
	<?php echo JText::sprintf('COM_FICHA_PUBLISHED_DATE_ON', JHtml::_('date', $this->item->publish_up, JText::_('DATE_FORMAT_LC2'))); ?>
</dd>
<dd class="createdby">
	<?php echo JText::sprintf('COM_FICHA_WRITTEN_BY', $this->item->author); ?>
</dd>
</dl>
<h2><?php echo $this->item->greeting?></h2>
<dl class="ficha-name">
    <dt><?php echo JText::sprintf('COM_FICHA_FICHA_FIELD_ARTID_LABEL'); ?>:</dt> <dd><?php if (isset($this->item->article_title)) echo $this->item->article_title; else echo $this->item->gaceta_txt?>&nbsp;</dd>
    
    <dt><?php echo JText::sprintf('COM_FICHA_FICHA_FIELD_ENTEMISOR_LABEL'); ?>: </dt><dd><?php echo $this->item->entemisor?>&nbsp;</dd>
    
    <dt><?php echo JText::sprintf('COM_FICHA_FICHA_FIELD_NORMA_LABEL'); ?>: </dt><dd><?php echo $this->item->norma?>&nbsp;</dd>
    
    <dt><?php echo JText::sprintf('COM_FICHA_FICHA_FIELD_OBJETO_LABEL'); ?>: </dt><dd><?php echo $this->item->objeto?>&nbsp;</dd>
    
    <dt><?php echo JText::sprintf('COM_FICHA_FICHA_FIELD_VIGENCIA_LABEL'); ?>: </dt><dd><?php echo $this->item->vigencia?>&nbsp;</dd>
    
    <dt><?php echo JText::sprintf('COM_FICHA_FICHA_FIELD_DEROGATORIA_LABEL'); ?>: </dt><dd><?php echo $this->item->derogatoria?>&nbsp;</dd>
<?php 

$jsonn =  json_decode($this->item->nota);
if (isset($jsonn->notas) && is_array($jsonn->notas)){
    $i= 0;
    foreach ($jsonn->notas as $it){
        echo '<dt>Nota '.($i+1).':</dt> <dd class="notas">'.($it).'&nbsp;</dd>';
        $i++;
    }
}
?>    
</dl>
<br/>
<?php

 $comments = JPATH_SITE . DS .'components' . DS . 'com_jcomments' . DS . 'jcomments.php';
  if (file_exists($comments)) {
    require_once($comments);
    echo JComments::showComments($this->item->id, 'com_ficha', $this->item->greeting);
  }
?>
</div>
	<script type="text/javascript">
		$(document).ready(function($) {
		$(".notas").each(function(){
			$(this).html(unescape($(this).html()))
		});
			
		});
		
    </script>
