<?php
/**
 * JComments plugin for Fichas support
 *
 * @version 2.0
 * @package JComments
 * @author Mariana FLORES
 * @copyright (C) 2006-2012 by Sergey M. Litvinov (http://www.joomlatune.ru)
 * @license GNU/GPL: http://www.gnu.org/copyleft/gpl.html
 **/

class jc_com_ficha extends JCommentsPlugin
{
	function getObjectInfo($id, $language = null)
	{
		$info = new JCommentsObjectInfo();

		$db = JCommentsFactory::getDBO();
		$db->setQuery('SELECT id, greeting, created_by FROM #__ficha WHERE id = ' . $id);
		$row = $db->loadObject();

		if (!empty($row)) {
			$info->title = $row->greeting;
			$info->userid = $row->created_by;
			$info->link = JRoute::_('index.php?option=com_ficha&view=ficha&id=' . $id);
		}/**/
		return $info;
	}
}
?>