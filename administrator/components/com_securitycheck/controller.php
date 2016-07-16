<?php
/**
* @ Controlador por defecto para Securitycheck
* @ author Jose A. Luque
* @ Copyright (c) 2011 - Jose A. Luque
* @license GNU/GPL v2 or later http://www.gnu.org/licenses/gpl-2.0.html
 */

// No direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport('joomla.application.component.controller');

/**
 * Securitycheck Component Controller
 */
class SecuritychecksController extends JController
{
	/**
	 * Método para mostrar la vista
	 *
	 * @acceso	public
	 */
	function display()
	{
		parent::display();
	}
}