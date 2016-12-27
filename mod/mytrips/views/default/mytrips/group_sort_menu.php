<?php
/**
 * All trips listing page navigation
 *
 * @uses $vars['selected'] Name of the tab that has been selected
 *
* 	Plugin: mytripsTeranga
*	Author: Rosana Montes Soldado from previous version of @package ElggGroups
*			Universidad de Granada
*	Licence: 	CC-ByNCSA
*	Reference:	Microproyecto CEI BioTIC Ref. 11-2015
* 	Project coordinator: @rosanamontes
*	Website: http://lsi.ugr.es/rosana
* 	Project colaborator: Antonio Moles 
*	
*   Project Derivative:
*	TFG: Desarrollo de un sistema de gestión de paquetería para Teranga Go
*   Advisor: Rosana Montes
*   Student: Ricardo Luzón Fernández
*/


$tabs = array(
	'newest' => array(
		'text' => elgg_echo('sort:newest'),
		'href' => 'mytrips/all?filter=newest',
		'priority' => 200,
	),
	'popular' => array(
		'text' => elgg_echo('sort:popular'),
		'href' => 'mytrips/all?filter=popular',
		'priority' => 300,
	),
	'featured' => array(
		'text' => elgg_echo('mytrips:featured'),
		'href' => 'mytrips/all?filter=featured',
		'priority' => 400,
	),
	'discussion' => array(
		'text' => elgg_echo('mytrips:latestdiscussion'),
		'href' => 'mytrips/all?filter=discussion',
		'priority' => 500,
	),
);

foreach ($tabs as $name => $tab) {
	$tab['name'] = $name;

	if ($vars['selected'] == $name) {
		$tab['selected'] = true;
	}

	elgg_register_menu_item('filter', $tab);
}

echo elgg_view_menu('filter', array('sort_by' => 'priority', 'class' => 'elgg-menu-hz'));
