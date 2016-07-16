/**
 * @version		$Id: submitbutton.js 48 2010-11-21 20:37:56Z mmff $
 * @package		Joomla2.5.ArtCamposExtras
 * @subpackage	Components
 * @copyright	Copyright (C) 2005 - 2010 Open Source Matters, Inc. All rights reserved.
 * @author		Mari Flores
 * @link		http://joomlacode.org/gf/project/ficha_1_6/
 * @license		License GNU General Public License version 2 or later
 */

Joomla.submitbutton = function(task)
{
	if (task == '')
	{
		return false;
	}
	else
	{
		var isValid=true;
		var action = task.split('.');
		if (action[1] != 'cancel' && action[1] != 'close')
		{
			var forms = $$('form.form-validate');
			for (var i=0;i<forms.length;i++)
			{
				if (!document.formvalidator.isValid(forms[i]))
				{
					isValid = false;
					break;
				}
			}
		}
	
		if (isValid)
		{
			var valnot = new String('{"notas":[')
			if (jQuery(".notastexta").length>0){
				
				jQuery(".notastexta").each(function(){
					if (jQuery(this).val()!="") valnot+='"'+escape(jQuery(this).val())+'",';
				})
				if (valnot != '{"notas":['){
					valnot = valnot.substr("0",valnot.length-1)
					
				}
				
				valnot += ']}'	
				
				jQuery("#jform_nota").val(valnot);	
			}
			
			Joomla.submitform(task);
			return true;
		}
		else
		{
			alert(Joomla.JText._('COM_FICHA_FICHA_ERROR_UNACCEPTABLE','Some values are unacceptable'));
			return false;
		}
	}
}

