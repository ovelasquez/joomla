<?php
/**
* Initialize_data View para el Componente Securitycheck
* @ author Jose A. Luque
* @ Copyright (c) 2011 - Jose A. Luque
* @license GNU/GPL v2 or later http://www.gnu.org/licenses/gpl-2.0.html
*/
// Chequeamos si el archivo está incluido en Joomla!
defined('_JEXEC') or die();
jimport( 'joomla.application.component.view' );
jimport( 'joomla.plugin.helper' );

/**
* Initialize_data View
*
*/
class SecuritychecksViewInitialize_data extends JView{

protected $state;
/**
* Initialize_data view método 'display'
**/
function display($tpl = null)
{
$document = JFactory::getDocument();
$document->addStyleDeclaration('.icon-48-securitycheck {background-image: url(../media/com_securitycheck/images/tick_48x48.png);}');
JToolBarHelper::title( JText::_( 'Securitycheck' ).' | ' .JText::_('COM_SECURITYCHECK_INITIALIZE_DATA'), 'securitycheck' );
JToolBarHelper::custom('redireccion_control_panel','back','back','COM_SECURITYCHECK_REDIRECT_CONTROL_PANEL');

parent::display($tpl);
}
}