<?php
/**
 * @package		Joomla.Site
 * @subpackage	com_content
 * @copyright	Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;

JHtml::addIncludePath(JPATH_COMPONENT.'/helpers/html');
JHtml::_('behavior.tooltip');
JHtml::core();

// Create some shortcuts.
$params		= &$this->item->params;
$n			= count($this->items);
$listOrder	= $this->escape($this->state->get('list.ordering'));
$listDirn	= $this->escape($this->state->get('list.direction'));

$idArts = "";
$comArts = array();
foreach ($this->items as $i => $article) :
	$idArts .=",".$article->id; 
endforeach;
if (strlen($idArts)>0):
	$idArts = substr($idArts,1);

	$dbo = & JCommentsFactory::getDBO();
	$dbo->setQuery('SELECT object_id,count(object_id) FROM #__jcomments WHERE object_id in ( '.$idArts.') group by object_id' );
	$comList = $dbo->loadRowList();
	if (count($comList)>0):
		foreach ($comList as $i => $cnt) :
			$comArts[$cnt[0]] = $cnt[1]; 
		endforeach;
	endif;
					
endif;

?>

<?php if (empty($this->items)) : ?>

	<?php if ($this->params->get('show_no_articles', 1)) : ?>
	<p><?php echo JText::_('COM_CONTENT_NO_ARTICLES'); ?></p>
	<?php endif; ?>

<?php else : ?>

<form action="<?php echo htmlspecialchars(JFactory::getURI()->toString()); ?>" method="post" name="adminForm" id="adminForm">
	<?php if ($this->params->get('show_headings') || $this->params->get('filter_field') != 'hide' || $this->params->get('show_pagination_limit')) :?>
	<fieldset class="filters">
		<?php if ($this->params->get('filter_field') != 'hide') :?>
		<legend class="hidelabeltxt">
			<?php echo JText::_('JGLOBAL_FILTER_LABEL'); ?>
		</legend>

		<div class="filter-search">
			<label class="filter-search-lbl" for="filter-search"><?php echo JText::_('COM_CONTENT_'.$this->params->get('filter_field').'_FILTER_LABEL').'&#160;'; ?></label>
			<input type="text" name="filter-search" id="filter-search" value="<?php echo $this->escape($this->state->get('list.filter')); ?>" class="inputbox" onchange="document.adminForm.submit();" title="<?php echo JText::_('COM_CONTENT_FILTER_SEARCH_DESC'); ?>" />
		</div>
		<?php endif; ?>

		<?php if ($this->params->get('show_pagination_limit')) : ?>
		<div class="display-limit">
			<?php echo JText::_('JGLOBAL_DISPLAY_NUM'); ?>&#160;
			<?php echo $this->pagination->getLimitBox(); ?>
		</div>
		<?php endif; ?>

	<!-- @TODO add hidden inputs -->
		<input type="hidden" name="filter_order" value="" />
		<input type="hidden" name="filter_order_Dir" value="" />
		<input type="hidden" name="limitstart" value="" />
	</fieldset>
	<?php endif; ?>

    <div class="cont_int">
		
		<?php foreach ($this->items as $i => $article) : ?>
			<div class="ls_cont">
				<?php if (in_array($article->access, $this->user->getAuthorisedViewLevels())) : /*echo "<pre>";var_dump($article); echo "<pre>";*/?>

					<?php if ($this->params->get('list_show_date')) : 
						setlocale(LC_ALL, 'es_VE');
						setlocale(LC_TIME, 'Spanish');
					?>
					<p class="date"><?php echo ucfirst (utf8_encode(strftime("%A %d de %B del %Y",strtotime($article->displayDate))));?></p>
					<?php endif; ?>

                    <p class="last_links">
                      <?php if ($this->params->get('show_readmore')) :
					  			$link = JRoute::_(ContentHelperRoute::getArticleRoute($article->slug, $article->catid));
							?>
												<a href="<?php echo $link; ?>"  class="btn_resume">
												<?php if (!$article->params->get('access-view')) :
													echo JText::_('COM_CONTENT_REGISTER_TO_READ_MORE');
												elseif ($readmore = $article->params->get('alternative_readmore')) :
													echo $readmore;
													if ($article->params->get('alternative_readmore') != 0) :
														echo JHtml::_('string.truncate', ($article->title), $this->params->get('readmore_limit'));
													endif;
												elseif ($article->params->get('show_readmore_title', 0) == 0) :
													echo JText::sprintf('COM_CONTENT_READ_MORE_TITLE');
												else :
													echo JText::_('COM_CONTENT_READ_MORE');
													echo JHtml::_('string.truncate', ($article->title), $this->params->get('readmore_limit'));
												endif; ?></a>
									
					<?php endif; ?>
                   
                    </p>
                   
                    <h4>
                      <?php echo $this->escape($article->title); ?>
                      <span><?php echo JHtml::_('string.truncate', ($article->introtext), 200); ?></span>
                    </h4>
                    
                    <div class="dtaextr">
					<?php if ($this->params->get('list_show_author', 1)) : ?>
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
					<?php endif; ?>

					<?php
					if (!empty($comArts[$article->id])):
						echo  $comArts[$article->id]. ' '.JText::_('comentarios')  ;
					endif;
					?>
					</div>
				<?php endif; ?>
				</div>
		<?php endforeach; ?>		
        </div>
        
<?php endif; ?>

<?php // Code to add a link to submit an article. ?>
<?php if ($this->category->getParams()->get('access-create')) : ?>
	<?php echo JHtml::_('icon.create', $this->category, $this->category->params); ?>
<?php  endif; ?>

<?php // Add pagination links ?>
<?php if (!empty($this->items)) : ?>
	<?php if (($this->params->def('show_pagination', 2) == 1  || ($this->params->get('show_pagination') == 2)) && ($this->pagination->get('pages.total') > 1)) : ?>
	<div class="pagination">

		<?php if ($this->params->def('show_pagination_results', 1)) : ?>
		 	<p class="counter">
				<?php echo $this->pagination->getPagesCounter(); ?>
			</p>
		<?php endif; ?>

		<?php echo $this->pagination->getPagesLinks(); ?>
	</div>
	<?php endif; ?>
</form>
<?php  endif; ?>
