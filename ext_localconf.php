<?php

if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}

// Add deny check to page repository (actual page request)
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['t3lib/class.t3lib_page.php']['getPage']['denyfegroup'] = 'EXT:denyfegroup/Classes/PageRepositoryGetPage.php:B13\DenyFeGroup\PageRepositoryGetPage';

// Add check to rootline (to respect "Extend to subpages" option)
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['tslib/class.tslib_fe.php']['hook_checkEnableFields']['denyfegroup'] = 'EXT:denyfegroup/Classes/GroupAccess.php:B13\DenyFeGroup\GroupAccess->checkEnableFields';

// Add check to content elements / menus via enable columns SQL
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['t3lib/class.t3lib_page.php']['addEnableColumns']['denyfegroup'] = 'EXT:denyfegroup/Classes/GroupAccess.php:B13\DenyFeGroup\GroupAccess->addEnableColumn';


$GLOBALS['TYPO3_CONF_VARS']['FE']['addRootLineFields'] .= ',fe_group_deny';