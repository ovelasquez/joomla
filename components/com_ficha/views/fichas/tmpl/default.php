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
<div class="category-list">
<h2><?php echo JText::sprintf('COM_FICHA'); ?></h2>
<?php if (empty($this->items)) : ?>

	<p><?php echo JText::sprintf('COM_FICHA_NO_FICHAS'); ?></p>

<?php else : ?>
<form action="<?php echo htmlspecialchars(JFactory::getURI()->toString()); ?>" method="post" name="adminForm" id="adminForm">
	<fieldset class="filters">
		<div class="display-limit">
			<?php echo JText::_('JGLOBAL_DISPLAY_NUM'); ?>&#160;
			<?php echo $this->pagination->getLimitBox(); ?>
		</div>
	</fieldset>
<div class="cont_int">
		<?php foreach ($this->items as $i => $ficha) : ?>
			<div class="ls_cont">
				<?php if (1) : /*echo "<pre>";var_dump($article); echo "<pre>";*/?>

					<?php 
						setlocale(LC_ALL, 'es_VE');
						setlocale(LC_TIME, 'Spanish');
					?>
					<p class="date"><?php echo JHtml::_('date', $ficha->created);?></p>

                    <p class="last_links">
                      <a href="<?php echo JRoute::_('index.php?option=com_ficha&view=ficha&id=' . $ficha->id); ?>"  class="btn_resume"><?php echo JText::sprintf('COM_FICHA_READ_MORE_TITLE');?> </a>                 
                    </p>
                   
                    <h4>
                      <?php echo $this->escape($ficha->greeting); ?>
                      <span>Gaceta Oficial: <?php if (isset($ficha->article_title)) echo JHtml::_('string.truncate', ($ficha->article_title), 200); else echo $ficha->gaceta_txt;?></span>
                    </h4>
                    
                    <div class="dtaextr">
					<p class="autorart">
						<?php if(!empty($ficha->created_by)) : ?>
							<?php $author =  $ficha->author ?>							
							<?php echo JText::sprintf('COM_FICHA_WRITTEN_BY', $author); ?>
						<?php endif; ?>
					</p>
					

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
        
<?php // Add pagination links ?>
<?php if (!empty($this->items)) : ?>
	<div class="pagination">

		<p class="counter">
				<?php echo $this->pagination->getPagesCounter(); ?>
			</p>
		<?php echo $this->pagination->getPagesLinks(); ?>
	</div>
<?php  endif; ?>
</form>
<?php endif;?>
</div>