<?php
/**
 * @package		Joomla.Site
 * @subpackage	com_search
 * @copyright	Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;
$lang = JFactory::getLanguage();
$upper_limit = $lang->getUpperLimitSearchWord();
?>

    
<form  action="<?php echo JRoute::_('index.php?option=com_search');?>" method="post">
	<div id="searchForm">
	<!--fieldset class="word">
		<label for="search-searchword">
			<?php echo JText::_('COM_SEARCH_SEARCH_KEYWORD'); ?>
		</label>
		<input type="text" name="searchword" id="search-searchword" size="30" maxlength="<?php echo $upper_limit; ?>" value="<?php echo $this->escape($this->origkeyword); ?>" class="inputbox" />
		<button name="Search" onclick="this.form.submit()" class="button"><?php echo JText::_('COM_SEARCH_SEARCH');?></button>
		<input type="hidden" name="task" value="search" />
	</fieldset-->
    <div id="frm_archive">
        <p><?php echo JText::_('COM_SEARCH_SEARCH_KEYWORD'); ?></p>
        <input type="text" name="searchword" id="search-searchword" size="30" maxlength="<?php echo $upper_limit; ?>" value="<?php echo $this->escape($this->origkeyword); ?>" class="s_archive" /><input name="Search"  onclick="this.form.submit()" id="btn_archive" value=" " class="btn_buscar">
    </div>

	<?php //var_dump($this);?>
	<div id="frm_time">
		<ul>
        	
			<li><?php echo JText::_('COM_SEARCH_FOR');?>
			<?php echo $this->lists['searchphrase']; ?>
			</li>
            <li>
			<?php echo JText::_('COM_SEARCH_ORDERING');?>
			<?php echo $this->lists['ordering'];?>
            </li>
            <li>
	<?php if ($this->params->get('search_areas', 1)) : ?>
		<?php echo JText::_('COM_SEARCH_SEARCH_ONLY');?>
        <select name="areas[]" multiple="multiple" size="3">
		<?php foreach ($this->searchareas['search'] as $val => $txt) :
			$checked = is_array($this->searchareas['active']) && in_array($val, $this->searchareas['active']) ? 'selected="selected"' : '';
		?>
		<option value="<?php echo $val;?>" id="area-<?php echo $val;?>" <?php echo $checked;?> ><?php echo JText::_($txt); ?></option>
		
		<?php endforeach; ?>
		</select>
	<?php endif; ?>
    		</li>
		</ul>
	</div>
    </div>
    
    <div class="searchintro<?php echo $this->params->get('pageclass_sfx'); ?>">
		<?php if (!empty($this->searchword)):?>
		<h4><span><?php echo JText::plural('COM_SEARCH_SEARCH_KEYWORD_N_RESULTS', $this->total);?></span></h4>
		<?php endif;?>
	</div>
    
    <?php if ($this->total > 0) : ?>
	<div class="form-limit-box">
        <div class="form-limit">
            <label for="limit">
                <?php echo JText::_('JGLOBAL_DISPLAY_NUM'); ?>
            </label>
            <?php echo $this->pagination->getLimitBox(); ?>
        </div>
        <p class="counter">
            <?php echo $this->pagination->getPagesCounter(); ?>
        </p>
	</div>
<?php endif; ?>
</form>
