<?php
/**
* Logs View para el Componente Securitycheck
* @ author Jose A. Luque
* @ Copyright (c) 2011 - Jose A. Luque
* @license GNU/GPL v2 or later http://www.gnu.org/licenses/gpl-2.0.html
*/

// Chequeamos si el archivo está incluido en Joomla!
defined('_JEXEC') or die();
jimport( 'joomla.application.component.view' );
/**
* Logs View
*
*/
class SecuritychecksViewlogs extends JView
{

protected $state;

/**
* Securitychecks view método 'display'
**/
function display($tpl = null)
{
$document = JFactory::getDocument();
$document->addStyleDeclaration('.icon-48-securitycheck {background-image: url(../media/com_securitycheck/images/tick_48x48.png);}');
$document->addStyleDeclaration('.icon-32-read {background-image: url(../media/com_securitycheck/images/read.png);}');
$document->addStyleDeclaration('.icon-32-no_read {background-image: url(../media/com_securitycheck/images/no_read.png);}');
JToolBarHelper::title( JText::_( 'Securitycheck' ).' | ' .JText::_('COM_SECURITYCHECK_CPANEL_VIEW_FIREWALL_LOGS_TEXT'), 'securitycheck' );
JToolBarHelper::custom('redireccion_control_panel','back','back','COM_SECURITYCHECK_REDIRECT_CONTROL_PANEL');
JToolBarHelper::custom('mark_read','read','read','COM_SECURITYCHECK_LOG_READ_CHANGE');
JToolBarHelper::custom('mark_unread','no_read','no_read','COM_SECURITYCHECK_LOG_NO_READ_CHANGE');
JToolBarHelper::custom('delete','delete','delete','COM_SECURITYCHECK_DELETE');

// Obtenemos los datos del modelo
		
		$this->state= $this->get('State');
		$search = $this->state->get('filter.search');
		$description = $this->state->get('filter.description');
		$type= $this->state->get('filter.type');
		$leido = $this->state->get('filter.leido');
		$datefrom = $this->state->get('datefrom');
		$dateto = $this->state->get('dateto');
		
		if ( ($search == '') && ($description == '') && ($type == '') && ($leido == '') && ($datefrom == '') && ($dateto == '') ) { //No hay establecido ningún filtro de búsqueda
			$log_details = $this->get('Data');
			$pagination = $this->get('Pagination');
		} else {			
			$log_details = $this->get('FilterData');
			$pagination = $this->get('FilterPagination');
		}
		
		// Ponemos los datos y la paginación en el template
		$this->assignRef('log_details',$log_details);
		$this->assignRef('pagination', $pagination);
				

parent::display($tpl);
}
}