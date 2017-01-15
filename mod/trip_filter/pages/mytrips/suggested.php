<?php
/**
 * List suggested mytrips
 */

elgg_gatekeeper();

// for consistency with other tabs
elgg_push_breadcrumb(elgg_echo('mytrips'));

// only register title button if allowed
if ((elgg_get_plugin_setting('limited_mytrips', 'mytrips') != 'yes') || elgg_is_admin_logged_in()) {
	elgg_register_title_button();
}

$selected_tab = 'suggested';

// build page elements
// limit to 9 so we can have a nice 3 x 3 grid
$mytrips = trip_filter_get_suggested_mytrips(elgg_get_logged_in_user_entity(), 9);
if (!empty($mytrips)) 
{
	// list suggested mytrips
	$content = elgg_view('output/text', [
		'value' => elgg_echo('trip_filter:suggested:info'),
	]);
	$content .= elgg_view('trip_filter/suggested', [
		'mytrips' => $mytrips,
	]);
} else {
	$content = elgg_echo('trip_filter:suggested:none');
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
echo elgg_view_page(elgg_echo('trip_filter:trips:sorting:suggested'), $body);
