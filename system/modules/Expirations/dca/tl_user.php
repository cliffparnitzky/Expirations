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
 * Palettes
 */
foreach ($GLOBALS['TL_DCA']['tl_user']['palettes'] as $key => $row)
{
	if ($key == '__selector__')
	{
			continue;
	}

	$arrPalettes = explode(";", $row);
	$arrPalettes[] = '{expirations_legend},expirationsConfig';

	$GLOBALS['TL_DCA']['tl_user']['palettes'][$key] = implode(";", $arrPalettes);
}

/**
 * Fields
 */
$GLOBALS['TL_DCA']['tl_user']['fields']['expirationsConfig'] = array(
	'label' => &$GLOBALS['TL_LANG']['tl_user']['expirationsConfig'],
	'inputType' => 'multiColumnWizard',
	'eval' 			=> array
	(
		'style' => 'min-width: 80%;',
		'buttons' => array('up' => false, 'down' => false),
		'columnFields' => array
		(
			'expirationModule' => array
			(
				'label'            => &$GLOBALS['TL_LANG']['tl_user']['expirationModule'],
				'exclude'          => true,
				'inputType'        => 'select',
				'options_callback' => array("tl_user_expirations", "getUnusedExpirationModules"),
				'eval'             => array('style'=>'width: 95%;', 'includeBlankOption'=>true, 'chosen'=>true, 'submitOnChange'=>true, 'nospace'=>false)
			),
			'maxDays' => array
			(
				'label'            => &$GLOBALS['TL_LANG']['tl_user']['maxDays'],
				'exclude'          => true,
				'inputType'        => 'text',
				'eval'             => array('style'=>'width: 95%;', 'rgxp'=>'digit', 'nospace'=>false)
			)
		)
	)
);

/**
 * Class tl_user_assignedMemeber
 *
 * Provide miscellaneous methods that are used by the data configuration array.
 * @copyright  Cliff Parnitzky 2011
 * @author     Cliff Parnitzky
 * @package    UserMemberBridge
 * @license    LGPL
*/
class tl_user_expirations extends Backend
{
	/**
	 * Returns all members that are not assigned to an user
	 */
	public function getUnusedExpirationModules(MultiColumnWizard $mcw) {
		$selectedOptions = array();
		foreach ($mcw->value as $option) {
			$selectedOptions[] = $option['expirationModule'];
		}
		
		$arrReturn = array();
		$counter = 0;
		foreach ($GLOBALS['TL_EXPIRATION'] as $expiration => $config) {
			if (($config['minVersion'] == null || strlen($config['minVersion']) == 0 || version_compare(VERSION, $config['minVersion'], '>=')) &&
			    ($expiration == $selectedOptions[$mcw->activeRow] || !in_array($expiration, $selectedOptions))) {
				$arrReturn[$expiration] = $GLOBALS['TL_LANG']['MOD'][$expiration][0];
			}
			$counter++;
		}
		return $arrReturn;
	}
}

?>