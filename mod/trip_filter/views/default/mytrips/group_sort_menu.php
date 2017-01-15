<?php
/**
* 	Plugin: Teranga Trip Filtering Tool 0.1
*	Author: Rosana Montes Soldado
*			Universidad de Granada
*	Licence: 	CC-ByNCSA
*	Reference:	Microproyecto CEI BioTIC Ref. 11-2015
* 	Project coordinator: @rosanamontes
*	Website: http://lsi.ugr.es/rosana
*	
*	File: All trips listing page navigation
*
*/

$tabs = [
	'yours' => [
		'text' => elgg_echo('mytrips:yours'),
		'href' => 'mytrips/all?filter=yours',
		'priority' => 250,
	],
	'newest' => [
		'text' => elgg_echo('sort:newest'),
		'href' => 'mytrips/all?filter=newest',
		'priority' => 200,
	],
	'popular' => [
		'text' => elgg_echo('sort:popular'),
		'href' => 'mytrips/all?filter=popular',
		'priority' => 300,
	],
	'discussion' => [
		'text' => elgg_echo('mytrips:latestdiscussion'),
		'href' => 'mytrips/all?filter=discussion',
		'priority' => 400,
	],
	'open' => [
		'text' => elgg_echo('trip_filter:trips:sorting:open'),
		'href' => 'mytrips/all?filter=open',
		'priority' => 500,
	],
	'closed' => [
		'text' => elgg_echo('trip_filter:trips:sorting:closed'),
		'href' => 'mytrips/all?filter=closed',
		'priority' => 600,
	],
	'ordered' => [
		'text' => elgg_echo('trip_filter:trips:sorting:ordered'),
		'href' => 'mytrips/all?filter=alpha',
		'priority' => 700,
	],
	/*'featured' => [
		'text' => elgg_echo('status:featured'),
		'href' => 'mytrips/all?filter=featured',
		'priority' => 800,
	], //por defecto los activos son features y los old son fechas pasadas
	// Rosana: Como este los que vayamos a añadir*/
	'suggested' => [
		'text' => elgg_echo('trip_filter:trips:sorting:suggested'),
		'href' => 'mytrips/suggested',
		'priority' => 900,
	],
];

foreach ($tabs as $name => $tab) 
{
	$show_tab = false;
	$show_tab_setting = elgg_get_plugin_setting("trip_listing_{$name}_available", 'trip_filter');
	if (in_array($name, ['ordered', 'featured'])) {
		if ($show_tab_setting == '1') {
			$show_tab = true;
		}
	} elseif ($show_tab_setting !== '0') {
		$show_tab = true;
	}
	
	if ($show_tab && in_array($name, ['yours', 'suggested']) && !elgg_is_logged_in()) {
		continue;
	}
	
	if (!$show_tab) {
		continue;
	}
	
	$tab['name'] = $name;
	
	if ($vars['selected'] === $name) {
		$tab['selected'] = true;
	}
	
	elgg_register_menu_item('filter', $tab);
}

echo elgg_view_menu('filter', [
	'sort_by' => 'priority',
	'class' => 'elgg-menu-hz',
]);
