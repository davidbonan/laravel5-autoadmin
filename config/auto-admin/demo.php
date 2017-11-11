<?php

$config = array(
	'title' => 'Demo',
	'classname' => 'Demo'
);

$index = array(
	'columns'=>array(
		'id'=>array('title' => 'ID'),
		'title'=>array('title' => 'Titre', 'plugin' => 'text'),
		'slug'=>array('title' => 'Select', 'plugin' => 'select'),
	),
);

$edit = array(
		'title'=>'Général',
		'layout'=>array(
			'main'=>array('size' => 8, 'title' => 'Général'),
			'sidebar'=>array('size' => 4, 'title' => 'Sidebar')
		),
		'columns'=>array(
            'title'=>array('section' => 'main', 'plugin' => 'text', 'title' => 'Titre', "params" => array()),
            'slug'=>array('section' => 'sidebar', 'plugin' => 'select', 'title' => 'Select', "params" => array(
            	"options" => array(
            		"option 1" => "Option 1",
            		"option 2" => "Option 2"
            	),
            	"multiple" => true,
            )),
		),
	);

return [
	'config' => $config,
	'index' => $index, 
	'edit' => $edit
];