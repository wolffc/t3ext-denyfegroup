<?php

if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}

// add hook for the enable columns for custom records using t3lib_pageSelect
$TYPO3_CONF_VARS['SC_OPTIONS']['t3lib/class.t3lib_page.php']['addEnableColumns']['denyfegroup'] = 'EXT:denyfegroup/Classes/Main.php:&tx_denyfegroup_main->addEnableColumn';

// fix the query for page tables
$TYPO3_CONF_VARS['SC_OPTIONS']['tslib/class.tslib_fe.php']['determineId-PostProc']['denyfegroup'] = 'EXT:denyfegroup/Classes/Main.php:&tx_denyfegroup_main->determineIdPostProc';

	// we need to XCLASS tslib_fe as the group check is in there as well
$TYPO3_CONF_VARS['FE']['XCLASS']['tslib/class.tslib_fe.php'] = t3lib_extMgm::extPath('denyfegroup', 'Classes/Tsfe.php');


$TYPO3_CONF_VARS['FE']['addRootLineFields'] .= ',fe_group_deny';