<?php
defined('_JEXEC') or die;

function modChrome_container($module, &$params, &$attribs)
{
	if (!empty ($module->content)) : ?>
		<div class="container">
			<?php echo $module->content; ?>
		</div>
	<?php endif;
}
function modChrome_bottommodule($module, &$params, &$attribs)
{
	if (!empty ($module->content)) : ?>
		<?php if ($module->showtitle) : ?>
			<h6><?php echo $module->title; ?></h6>
		<?php endif; ?>
		<?php echo $module->content; ?>
	<?php endif;
}
function modChrome_sidebar($module, &$params, &$attribs)
{
	if (!empty ($module->content)) : ?>
		<?php if ($module->showtitle) : ?>
			<h3><?php echo $module->title; ?></h3>
		<?php endif; ?>
		<?php echo $module->content; ?>
	<?php endif;
}
function modChrome_sidebar1($module, &$params, &$attribs)
{
	if (!empty ($module->content)) : ?>
		<?php if ($module->showtitle) : ?>
			<h1><?php echo $module->title; ?></h1>
		<?php endif; ?>
		<?php echo $module->content; ?>
	<?php endif;
}

?>
