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

<?php if (empty($this->items)) : ?>

	<p><?php echo JText::_('COM_FICHA_NO_FICHAS'); ?></p>

<?php else : ?>


<div class="cont_int">
		
		<?php foreach ($this->items as $i => $ficha) : ?>
			<div class="ls_cont">
				<?php if (1) : /*echo "<pre>";var_dump($article); echo "<pre>";*/?>

					<?php /*if ($this->params->get('list_show_date')) : 
						setlocale(LC_ALL, 'es_VE');
						setlocale(LC_TIME, 'Spanish');
					?>
					<p class="date"><?php echo ucfirst (utf8_encode(strftime("%A %d de %B del %Y",strtotime($article->displayDate))));?></p>
					<?php endif;*/ ?>

                    <p class="last_links">
                      <?php echo JText::sprintf('COM_CONTENT_READ_MORE_TITLE');?>                   
                    </p>
                   
                    <h4>
                      <?php echo $this->escape($ficha->greeting); ?>
                      <span><?php echo JHtml::_('string.truncate', ($ficha->greeting), 200); ?></span>
                    </h4>
                    
                    <div class="dtaextr">
					<?php /*if ($this->params->get('list_show_author', 1)) : ?>
					<p class="autorart">
						<?php if(!empty($article->author) || !empty($article->created_by_alias)) : ?>
							<?php $author =  $article->author ?>
							<?php $author = ($article->created_by_alias ? $article->created_by_alias : $author);?>

							<?php if (!empty($article->contactid ) &&  $this->params->get('link_author') == true):?>
								<?php echo JHtml::_(
										'link',
										JRoute::_('index.php?option=com_contact&view=contact&id='.$article->contactid),
										$author
								); ?>

							<?php else :?>
								<?php echo JText::sprintf('COM_CONTENT_WRITTEN_BY', $author); ?>
							<?php endif; ?>
						<?php endif; ?>
					</p>
					<?php endif; */ ?>

					<?php
					/*if (!empty($comArts[$article->id])):
						echo  $comArts[$article->id]. ' '.JText::_('comentarios')  ;
					endif;*/
					?>
					</div>
				<?php endif; ?>
				</div>
		<?php endforeach; ?>		
        </div>





<?php endif;?>
