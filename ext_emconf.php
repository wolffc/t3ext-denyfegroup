<?php

/***************************************************************
 * Extension Manager/Repository config file for ext "denyfegroup".
 ***************************************************************/

$EM_CONF[$_EXTKEY] = array (
	'title' => 'Deny Usergroup Access',
	'description' => 'Explicitly denies a page or content to a certain usergroup.',
	'category' => 'fe',
	'version' => '2.1.0',
    'state' => 'stable',
    'modify_tables' => 'pages,tt_content',
	'clearcacheonload' => 0,
    'author' => 'Benjamin Mack',
    'author_email' => 'typo3@b13.de',
    'author_company' => 'b:dreizehn GmbH',
	'constraints' => array(
		'depends' => array(
			'typo3' => '7.6.0-8.99.99',
		),
		'conflicts' => array(
		),
		'suggests' => array(
		),
	),
);

?>
