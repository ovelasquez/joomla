<?php
/**
 * @package		Joomla.Site
 * @subpackage	mod_search
 * @copyright	Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;
?>
<form action="<?php echo JRoute::_('index.php');?>" method="post" id="frm_search" class="frm_search">
		<?php
			$output = '<input name="searchword" id="mod-search-searchword" maxlength="'.$maxlength.'"  class="s" type="text" value="'.$text.'"  onblur="if (this.value==\'\') this.value=\''.$text.'\';" onfocus="if (this.value==\''.$text.'\') this.value=\'\';" />';

			$button = '<input name="btn_search" value=" " type="submit" id="btn_search" class="button'.$moduleclass_sfx.'" onclick="this.form.searchword.focus();"/>';

			$output = $output.$button;

			echo $output;
		?>
	<input type="hidden" name="task" value="search" />
	<input type="hidden" name="option" value="com_search" />
	<input type="hidden" name="Itemid" value="<?php echo $mitemid; ?>" />
</form>
