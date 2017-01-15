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
*	File: Extra tabs for the all mytrips page
*/


// all mytrips doesn't get link to self
elgg_pop_breadcrumb();
elgg_push_breadcrumb(elgg_echo('mytrips'));

// only register title button if allowed
if ((elgg_get_plugin_setting('limited_mytrips', 'mytrips') != 'yes') || elgg_is_admin_logged_in()) {
	elgg_register_title_button();
}

$selected_tab = get_input('filter');
system_message("selected_tab " . $selected_tab);

// default trip options
$trip_options = [
	'type' => 'group',
	'full_view' => false,
];

$dbprefix = elgg_get_config('dbprefix');
//system_message("teranga selected tab es ... " . $selected_tab);

switch ($selected_tab) 
{
	case 'ordered':
		
		$order_id = elgg_get_metastring_id('order');
		
		$trip_options['limit'] = false;
		$trip_options['pagination'] = false;
		$trip_options['selects'] = [
			"IFNULL((SELECT order_ms.string as order_val
			FROM {$dbprefix}metadata mo
			JOIN {$dbprefix}metastrings order_ms ON mo.value_id = order_ms.id
			WHERE e.guid = mo.entity_guid
			AND mo.name_id = {$order_id}), 99999) AS order_val",
		];
		
		$trip_options['order_by'] = 'CAST(order_val AS SIGNED) ASC, e.time_created DESC';
		
		if (elgg_is_admin_logged_in()) {
			elgg_require_js('trip_filter/ordered_list');
			$trip_options['list_class'] = 'trip-filter-list-ordered';
		}
		
		break;
	case 'yours':
		elgg_gatekeeper();
		
		$trip_options['relationship'] = 'member';
		$trip_options['relationship_guid'] = elgg_get_logged_in_user_guid();
		$trip_options['inverse_relationship'] = false;

		break;
	case 'featured':
		$trip_options['metadata_names'] = [
			'name' => 'featured',
		];
		
		break;
	case 'open':
		$trip_options['metadata_name_value_pairs'] = [
			'name' => 'membership',
			'value' => ACCESS_PUBLIC,
		];
		
		break;
	case 'closed':
		$trip_options['metadata_name_value_pairs'] = [
			'name' => 'membership',
			'value' => ACCESS_PUBLIC,
			'operand' => '<>',
		];
		
		break;
	case 'alpha':
		$trip_options['joins']	= [
			"JOIN {$dbprefix}mytrips_entity ge ON e.guid = ge.guid",
		];
		$trip_options['order_by'] = 'ge.name ASC';
		
		break;
}

if (isset($trip_options['relationship'])) {
	$content = elgg_list_entities_from_relationship($trip_options);
} else {
	$content = elgg_list_entities_from_metadata($trip_options);
}
if (empty($content)) {
	$content = elgg_echo('mytrips:none');
}

$filter = elgg_view('mytrips/group_sort_menu', [
	'selected' => $selected_tab,
]);

$sidebar = elgg_view('mytrips/sidebar/find');
$sidebar .= elgg_view('mytrips/sidebar/featured');

// build page
$body = elgg_view_layout('content', [
	'content' => $content,
	'sidebar' => $sidebar,
	'filter' => $filter,
]);

// draw page
echo elgg_view_page(elgg_echo('mytrips:all'), $body);
	
