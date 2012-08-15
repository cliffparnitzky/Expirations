<?php if (!defined('TL_ROOT')) die('You cannot access this file directly!');

/**
 * Contao Open Source CMS
 * Copyright (C) 2005-2012 Leo Feyer
 *
 * Formerly known as TYPOlight Open Source CMS.
 *
 * This program is free software: you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation, either
 * version 3 of the License, or (at your option) any later version.
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU
 * Lesser General Public License for more details.
 * 
 * You should have received a copy of the GNU Lesser General Public
 * License along with this program. If not, please visit the Free
 * Software Foundation website at <http://www.gnu.org/licenses/>.
 *
 * PHP version 5
 * @copyright  Cliff Parnitzky 2012
 * @author     Cliff Parnitzky
 * @package    Expirations
 * @license    LGPL
 */
 
// Configure expiration modules
/*
 * Extend the module via adding the following lines to 'system/localconfig.php'
 *
 * $GLOBALS['TL_EXPIRATION']['VIRTUAL_TABLE'] = array
 * (
 * 		'table'      => 'TABLE_NAME',
 * 		'icon'       => 'PATH_TO_ICON',
 * 		'minVersion' => 'MIN_VERSION'
 * );
 *
 * ! 'icon' and 'minVersion' are optional
 * ! Labels musst be set to $GLOBALS['TL_LANG']['MOD']['VIRTUAL_TABLE'] = array('TXT', 'TXT');
 */
$GLOBALS['TL_EXPIRATION']['expiringPages'] = array
(
	'table'      => 'tl_page'
);
$GLOBALS['TL_EXPIRATION']['expiringArticles'] = array
(
	'table'      => 'tl_article'
);
$GLOBALS['TL_EXPIRATION']['expiringContentElements'] = array
(
	'table'      => 'tl_content',
	'minVersion' => '2.10'
);
$GLOBALS['TL_EXPIRATION']['expiringMembers'] = array
(
	'table'      => 'tl_member'
);
$GLOBALS['TL_EXPIRATION']['expiringMemberGroups'] = array
(
	'table'      => 'tl_member_group'
);
$GLOBALS['TL_EXPIRATION']['expiringUsers'] = array
(
	'table'      => 'tl_user'
);
$GLOBALS['TL_EXPIRATION']['expiringUserGroups'] = array
(
	'table'      => 'tl_user_group'
);

// adding backend moduls
foreach ($GLOBALS['TL_EXPIRATION'] as $expiration => $config) {
	
	$addToBackendModules = false;
	if ($config['minVersion'] == null || strlen($config['minVersion']) == 0 || version_compare(VERSION, $config['minVersion'], '>=')) {
		$addToBackendModules = true;
	}
	
	if ($addToBackendModules) {
		$icon = $config['icon'];
		if (strlen($icon) == 0) {
			$icon = 'system/modules/Expirations/html/' . $expiration . '.png';
		}
		if (!file_exists(TL_ROOT . "/" . $icon)) {
			$icon = 'system/modules/Expirations/html/hourglas.png';
		}
		
		$GLOBALS['BE_MOD']['expiration'][$expiration] = array
		(
			'tables' => array('tl_expiration'),
			'icon'   => $icon
		);
	}
}

?>