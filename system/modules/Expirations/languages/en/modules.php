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

/**
 * Define name and tooltip for preferences (inactive modules)
 */
$GLOBALS['TL_LANG']['MOD']['Expirations']             = 'Expiring ... pages, articles, etc.';
$GLOBALS['TL_LANG']['MOD']['expiration']              = 'Expiring ...';
$GLOBALS['TL_LANG']['MOD']['expiringPages']           = array('Expiring pages', 'Displays a list of expiring pages, ordered by date of "Show until".');
$GLOBALS['TL_LANG']['MOD']['expiringArticles']        = array('Expiring articles', 'Displays a list of expiring articles, ordered by date of "Show until".');
$GLOBALS['TL_LANG']['MOD']['expiringContentElements'] = array('Expiring content elements', 'Displays a list of expiring content elements, ordered by date of "Show until".');
$GLOBALS['TL_LANG']['MOD']['expiringMembers']         = array('Expiring members', 'Displays a list of expiring members, ordered by date of "Show until".');
$GLOBALS['TL_LANG']['MOD']['expiringMemberGroups']    = array('Expiring member groups', 'Displays a list of expiring member groups, ordered by date of "Show until".');
$GLOBALS['TL_LANG']['MOD']['expiringUsers']           = array('Expiring users', 'Displays a list of expiring users, ordered by date of "Show until".');
$GLOBALS['TL_LANG']['MOD']['expiringUserGroups']      = array('Expiring user groups', 'Displays a list of expiring user groups, ordered by date of "Show until".');

?>