<?php
/**
 * All myTrips listing page navigation
 *
 * @uses $vars['selected'] Name of the tab that has been selected
 *
* 	Plugin: myTripsTeranga from previous version of @package ElggGroup
*	Author: Rosana Montes Soldado 
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
* 
*/ 


//to be extended by fuzzy_filter
$tabs = array(
	'newest' => array(
		'text' => elgg_echo('sort:newest'),
		'href' => 'myTrips/all?filter=newest',
		'priority' => 200,
	),
	'popular' => array(
		'text' => elgg_echo('sort:popular'),
		'href' => 'myTrips/all?filter=popular',
		'priority' => 300,
	),
	'featured' => array(
		'text' => elgg_echo('mytrips:featured'),
		'href' => 'myTrips/all?filter=featured',
		'priority' => 400,
	),
	'discussion' => array(
		'text' => elgg_echo('mytrips:latestdiscussion'),
		'href' => 'myTrips/all?filter=discussion',
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
