<?php

if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}

$tempColumns = array(
	'fe_group_deny' => array(
		'exclude' => 1,
		'label' => 'LLL:EXT:denyfegroup/Resources/Private/Language/db.xml:fe_group_deny',
		'config' => array(
			'type' => 'select',
			'foreign_table' => 'fe_groups',
			'foreign_table_where' => 'ORDER BY fe_groups.title',
			'size' => 5,
			'minitems' => 0,
			'maxitems' => 50,
		)
	),
);

t3lib_div::loadTCA('pages');
t3lib_extMgm::addTCAcolumns('pages', $tempColumns, 1);
t3lib_extMgm::addToAllTCAtypes('pages','fe_group_deny', '', 'after:fe_group');


t3lib_div::loadTCA('tt_content');
t3lib_extMgm::addTCAcolumns('tt_content', $tempColumns, 1);
t3lib_extMgm::addToAllTCAtypes('tt_content','fe_group_deny', '', 'after:fe_group');
?>