<?php
/**
 * @package		Joomla.Site
 * @subpackage	mod_syndicate
 * @copyright	Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;
if (strpos($link,"index.php?")>0) $link=str_replace("index.php","index.php/blog",$link);
?>
<a href="<?php echo $link ?>" class="btn_rss">
	RSS <?php echo strpos($link,"index.php?"); ?>
</a>
