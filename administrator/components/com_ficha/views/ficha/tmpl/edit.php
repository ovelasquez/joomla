<?php
/**
 * @version		$Id: edit.php 60 2010-11-27 18:45:40Z mmff $
 * @package		Joomla2.5.ArtCamposExtras
 * @subpackage	Components
 * @copyright	Copyright (C) 2005 - 2010 Open Source Matters, Inc. All rights reserved.
 * @author		Mari Flores
 * @link		http://project.tinn-ds.com/ArtCamposExtras/
 * @license		License GNU General Public License version 2 or later
 */
// No direct access
defined('_JEXEC') or die('Restricted access');
JHtml::_('behavior.tooltip');
?>

<script type="text/javascript">
	 jQuery.noConflict();
	 jQuery(document).ready(function($) {
		if (jQuery("#jform_nota").val()!=""){
			var obj = jQuery.parseJSON(jQuery("#jform_nota").val());
			if (obj.notas.length>0){
				for (i=0;i<obj.notas.length;i++){
					$('.notas').append('<li><label for="notas'+($('.notas li').length)+'" >Nota '+($('.notas li').length)+'</label><textarea name="notas[]" id="notas'+($('.notas li').length)+'" cols="40" rows="5"  class="notastexta">'+unescape(obj.notas[i])+'</textarea><a class="icon-16-delete btnelimi" href="#" onclick="eliminarNota(this)" >Eliminar nota</a></li>');			
				}
			} 
		}else{
			$('.notas').append('<li><label for="notas0" >Nota 1</label><textarea name="notas[]" id="notas1" cols="40" rows="5" class="notastexta"></textarea><a class="icon-16-delete btnelimi" href="#" onclick="eliminarNota(this)">Eliminar nota</a></li>');
			
		}
		
		jQuery(".btnagrega").click(function(){
			$('.notas').append('<li><label for="notas'+($('.notas li').length)+'" >Nota '+($('.notas li').length)+'</label><textarea name="notas[]" id="notas'+($('.notas li').length)+'" cols="40" rows="5"  class="notastexta"></textarea><a class="icon-16-delete btnelimi" href="#" onclick="eliminarNota(this)" >Eliminar nota</a></li>');
			return false;	
		});
		
		jQuery("#jform_catid").change(function(){
			$.post('index.php?option=com_ficha&format=raw&task=listArt', { catid: $(this).val() },
				function(data){
				jQuery("#jform_artid").html("<option value='0'>Seleccione</option>"+data);
				jQuery("#jform_artid").val(jQuery(".artid").val());
				});
			
		}).change();
		
	 });
	 
	 function eliminarNota(elem){
		 jQuery(elem).parent().remove();
		}
</script>
<?php 
//var_dump();
?>
<form action="<?php echo JRoute::_('index.php?option=com_ficha&layout=edit&id='.(int) $this->item->id); ?>" method="post" name="adminForm" id="ficha-form">
	<div class="width-60 fltlft">	
        <fieldset class="adminform">
            <legend><?php echo JText::_( 'COM_FICHA_FICHA_DETAILS' ); ?></legend>
            <ul class="adminformlist">
        <?php foreach($this->form->getFieldset('datosgenerales') as $field): ?>
                <li><?php echo $field->label;echo $field->input;?></li>
        <?php endforeach; 
				
		?>
            </ul>
        	<input class="artid" type="hidden" value="<?php echo $this->form->getValue('artid');?>" />
        </fieldset>
        <div>
            <input type="hidden" name="task" value="ficha.edit" />
            <?php echo JHtml::_('form.token'); ?>
        </div>
    </div>
    <div class="width-40 fltrt">
	     <fieldset class="panelform" style=" margin-top:18px!important;">
				<ul class="adminformlist">
					<li><?php echo $this->form->getLabel('created_by'); ?>
					<?php echo $this->form->getInput('created_by'); ?></li>

					
					<li><?php echo $this->form->getLabel('created'); ?>
					<?php echo $this->form->getInput('created'); ?></li>

					<li><?php echo $this->form->getLabel('publish_up'); ?>
					<?php echo $this->form->getInput('publish_up'); ?></li>

					
				</ul>
			</fieldset>
        <fieldset class="panelform" style=" margin-top:10px!important;">
        <legend><?php echo JText::_( 'COM_FICHA_FICHA_DETAILS_NOTAS' ); ?></legend>
        <a class="icon-16-newarticle btnagrega" href="#" >Agregar nota</a>
        <ul class="adminformlist notas">
            <?php foreach($this->form->getFieldset('notas') as $field): ?>
                <li><?php echo $field->label; ?>
                    <?php echo $field->input; ?></li>
            <?php endforeach; ?>
            </ul>
        </fieldset>
        
       
	</div>

	<div class="clr"></div>
</form>

