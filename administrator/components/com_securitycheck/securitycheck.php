<?php
/**
* @ author Jose A. Luque
* @ Copyright (c) 2011 - Jose A. Luque
* @license GNU/GPL v2 or later http://www.gnu.org/licenses/gpl-2.0.html
*/
// No direct access
defined( '_JEXEC' ) or die( 'Restricted access' );


// Require el controlador específico si es requerido
if($controller = JRequest::getWord('controller')) {
	$path = JPATH_COMPONENT.DS.'controllers'.DS.$controller.'.php';
	if (file_exists($path)) {
		require_once $path;
	} else {
		$controller = 'cpanel';
		require_once(JPATH_COMPONENT.DS.'controllers'.DS.'cpanel.php');
	}
} else {
	$controller = 'cpanel';
	require_once(JPATH_COMPONENT.DS.'controllers'.DS.'cpanel.php');
	// Handle Live Update requests
	require_once JPATH_COMPONENT_ADMINISTRATOR.DS.'liveupdate'.DS.'liveupdate.php';
	if(JRequest::getCmd('view','') == 'liveupdate') {
		LiveUpdate::handleRequest();
		return;
	}
}

// Creamos el controlador
$classname = 'SecuritychecksController'.$controller;
$controller = new $classname( );
// Realizamos la tarea requerida
$controller->execute(JRequest::getCmd('task','display'));
// Redirección si es establecida por el controlador
$controller->redirect();