<?php

//namespace Teranga;

/**
 * page setup event
 */
function pagesetup() {

	// add to site links
	if (elgg_is_logged_in()) {
		$item = new \ElggMenuItem('trip_companions', elgg_echo('trip_companions:new:people'), 'trip_companions');
		elgg_register_menu_item('site', $item);
	}

	/*elgg_register_menu_item('page', array(
		'name' => 'trip_companions_all',
		'text' => elgg_echo('trip_companions:all'),
		'href' => 'trip_companions',
		'contexts' => array(
			'trip_companions'
		)
	));
	
	elgg_register_menu_item('page', array(
		'name' => 'trip_companions_friends',
		'text' => elgg_echo('trip_companions:friends:only'),
		'href' => 'trip_companions/friends',
		'contexts' => array(
			'trip_companions'
		)
	));*/
	
	elgg_register_menu_item('page', array(
		'name' => 'trip_companions_groups',
		'text' => elgg_echo('trip_companions'),//groups:only
		'href' => 'trip_companions/groups',
		'contexts' => array(
			'trip_companions'
		)
	));
}
