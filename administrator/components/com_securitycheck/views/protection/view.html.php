<?php
/**
* Protection View para el Componente Securitycheck
* @ author Jose A. Luque
* @ Copyright (c) 2011 - Jose A. Luque
* @license GNU/GPL v2 or later http://www.gnu.org/licenses/gpl-2.0.html
*/

// Protect from unauthorized access
defined('_JEXEC') or die('Restricted Access');

// Load framework base classes
jimport('joomla.application.component.view');

class SecuritychecksViewProtection extends JView
{
protected $state;

/**
* Securitycheckpros view método 'display'
**/
function display($tpl = null)
{
$document = JFactory::getDocument();
$document->addStyleDeclaration('.icon-48-securitycheck {background-image: url(../media/com_securitycheck/images/tick_48x48.png);}');
$document->addStyleDeclaration('.icon-32-protect {background-image: url(../media/com_securitycheck/images/protect.png);}');
JToolBarHelper::title( JText::_( 'Securitycheck' ).' | ' .JText::_('COM_SECURITYCHECK_CPANEL_HTACCESS_PROTECTION_TEXT'), 'securitycheck' );
// Si existe el fichero .htaccess, mostramos la opción para borrarlo.
// Obtenemos el modelo...
$model = $this->getModel();
// ... y el tipo de servidor web
$mainframe = JFactory::getApplication();
$server = $mainframe->getUserState("server",'apache');

if ( $server == 'apache' ) {
	if ( $model->ExistsFile('.htaccess') ) {
		$document->addStyleDeclaration('.icon-32-delete_htaccess {background-image: url(../media/com_securitycheck/images/delete_htaccess.png);}');
		JToolBarHelper::custom('delete_htaccess','delete_htaccess','delete_htaccess','COM_SECURITYCHECK_DELETE_HTACCESS');
	}
	JToolBarHelper::custom('protect','protect','protect','COM_SECURITYCHECK_PROTECT');
} else if ( $server == 'nginx' ) {
	JToolBarHelper::custom('generate_rules','protect','protect','COM_SECURITYCHECK_GENERATE_RULES');
}

JToolBarHelper::custom('redireccion_control_panel','back','back','COM_SECURITYCHECK_REDIRECT_CONTROL_PANEL');

// Obtenemos la configuración actual...
$config = $model->getConfig();
// ... y la que hemos aplicado en el fichero .htaccess existente
$config_applied = $model->GetconfigApplied();

$this->assign('protection_config', $config);
$this->assign('config_applied', $config_applied);
$this->assign('ExistsHtaccess',	$model->ExistsFile('.htaccess'));
$this->assignRef('server', $server);


parent::display($tpl);
}
}