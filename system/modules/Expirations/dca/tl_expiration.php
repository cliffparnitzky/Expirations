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
 * Table tl_expiration
 */
$GLOBALS['TL_DCA']['tl_expiration'] = array
(
	// Config
	'config' => array
	(
		'dataContainer'     => 'DynamicTable',
		'oncreate_callback' => array
		(
			array('tl_expiration', 'initTable'),
		)
	),
);

/**
 * Class tl_expiration
 *
 * Provide miscellaneous methods that are used by the data configuration array.
 * @copyright  Cliff Parnitzky 2012
 * @author     Cliff Parnitzky
 * @package    Controller
 */
class tl_expiration extends Backend
{
	/*
	 * Initialize the table
	 */
	public function initTable($strTable) {
		
		$virtualTable = $this->Input->get('do');
		$table = $GLOBALS['TL_EXPIRATION'][$virtualTable]['table'];
		
		$this->import("BackendUser", "User");
		
		$maxDays = 30;
		if ($this->User->expirationsConfig != null) {
			foreach($this->User->expirationsConfig as $k=>$config) {
				if ($config['expirationModule'] == $virtualTable && intval($config['maxDays']) > 0) {
					$maxDays = intval($config['maxDays']);
				}
			}
		}
		
		$reference = $GLOBALS['TL_EXPIRATION'][$virtualTable]['reference'];
		if (strlen($reference) == 0) {
			// set an default: tablename without "tl_" prefix
			$reference = substr($table, 3);
		}
		
		// load dca and language
		$this->loadLanguageFile($table);
		$this->loadDataContainer($table);

		// add stop to the filter
		$GLOBALS['TL_DCA'][$table]['fields']['stop']['filter'] = true;
		$GLOBALS['TL_DCA'][$table]['fields']['stop']['flag'] = 5;

		$GLOBALS['TL_DCA'][$table]['config']['closed'] = true;
		$GLOBALS['TL_DCA'][$table]['list']['sorting']['fields'] = array('stop');
		$GLOBALS['TL_DCA'][$table]['list']['sorting']['mode'] = 1;
		$GLOBALS['TL_DCA'][$table]['list']['sorting']['flag'] = 5;
		$GLOBALS['TL_DCA'][$table]['list']['sorting']['filter'] = array(array('stop <> ?', ''), array('stop > ?', time()), array('stop < ?', (time() + ($maxDays * 24 * 60 * 60)))); 
		$GLOBALS['TL_DCA'][$table]['list']['sorting']['panelLayout'] = 'filter '; 
		// remove some operations
		unset($GLOBALS['TL_DCA'][$table]['list']['global_operations']['toggleNodes']);
		unset($GLOBALS['TL_DCA'][$table]['list']['operations']['cut']);
		unset($GLOBALS['TL_DCA'][$table]['list']['operations']['editheader']);
		unset($GLOBALS['TL_DCA'][$table]['list']['operations']['toggle']);
		// modfiy edit operation
		$GLOBALS['TL_DCA'][$table]['list']['operations']['edit']['href'] = 'do=' . $reference . '&' . $GLOBALS['TL_DCA'][$table]['list']['operations']['edit']['href'];
		
		return $table;
	}
}

?>