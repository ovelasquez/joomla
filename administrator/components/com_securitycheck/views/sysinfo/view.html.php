<?php

/**
* @ author Jose A. Luque
* @ Copyright (c) 2011 - Jose A. Luque
* @license GNU/GPL v2 or later http://www.gnu.org/licenses/gpl-2.0.html
*/

// No direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport( 'joomla.application.component.view' );

/**
 * Securitycheck View
   */
class SecuritychecksViewsysinfo extends JView
{
	/**
	 * Método display de la vista Securitycheck (muestra los detalles de las vulnerabilidades del producto escogido)
	 **/
	function display($tpl = null)
	{
		$document = JFactory::getDocument();
		$document->addStyleDeclaration('.icon-48-securitycheck {background-image: url(../media/com_securitycheck/images/tick_48x48.png);}');
		JToolBarHelper::title( JText::_( 'Securitycheck' ).' | ' .JText::_('COM_SECURITYCHECK_SYSTEM_INFORMATION'), 'securitycheck' );
		JToolBarHelper::custom('redireccion','back','back','COM_SECURITYCHECK_REDIRECT');
				
		// Obtenemos los datos del modelo
		$model = $this->getModel("sysinfo");
		$system_info = $model->getInfo();
		
						
		// Ponemos los datos y la paginación en el template
		$this->assignRef('system_info',$system_info);				
							
		parent::display($tpl);
	}
}