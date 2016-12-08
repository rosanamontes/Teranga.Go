<?php
/**
 * myTrips function library
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

/**
 * List all myTrips
 */
function myTrips_handle_all_page() {

	// all myTrips doesn't get link to self
	elgg_pop_breadcrumb();
	elgg_push_breadcrumb(elgg_echo('myTrips'));

	if (elgg_get_plugin_setting('limited_myTrips', 'myTrips') != 'yes' || elgg_is_admin_logged_in()) {
		elgg_register_title_button();
	}

	$selected_tab = get_input('filter', 'newest');

	switch ($selected_tab) 
	{
		case 'popular':
			$content = elgg_list_entities_from_relationship_count(array(
				'type' => 'trip',
				'relationship' => 'member',
				'inverse_relationship' => false,
				'full_view' => false,
				'no_results' => elgg_echo('myTrips:none'),
			));
			break;
		case 'discussion':
			$content = elgg_list_entities(array(
				'type' => 'object',
				'subtype' => 'tripforumtopic',
				'order_by' => 'e.last_action desc',
				'limit' => 40,
				'full_view' => false,
				'no_results' => elgg_echo('discussion:none'),
				'distinct' => false,
				'preload_containers' => true
			));
			break;
		case 'open':
			$content = elgg_list_entities_from_metadata(array(
				'type' => 'trip',
				'metadata_name' => 'featured_trip',
				'metadata_value' => 'yes',
				'full_view' => false,
			));
			if (!$content) {
				$content = elgg_echo('myTrips:nofeatured');
			}
			break;

		case 'closed':
			$content = elgg_list_entities_from_metadata(array(
				'type' => 'trip',
				'metadata_name' => 'featured_trip',
				'metadata_value' => 'no',
				'full_view' => true,
			));
			if (!$content) {
				$content = elgg_echo('fuzzy_filter');
			}
			break;

		case 'alpha':
			$dbprefix = elgg_get_config('dbprefix');
			$content = elgg_list_entities(array(
				'type' => 'trip',
				'joins' => ["JOIN {$dbprefix}myTrips_entity ge ON e.guid = ge.guid"],
				'order_by' => 'ge.name',
				'full_view' => false,
				'no_results' => elgg_echo('myTrips:none'),
				'distinct' => false,
			));			
			break;
		case 'newest':
		default:
			$content = elgg_list_entities(array(
				'type' => 'trip',
				'full_view' => false,
				'no_results' => elgg_echo('myTrips:none'),
				'distinct' => false
				
			));
			break;
	}

	$filter = elgg_view('myTrips/trip_sort_menu', array('selected' => $selected_tab));

	$sidebar = elgg_view('myTrips/sidebar/find');
	$sidebar .= elgg_view('myTrips/sidebar/featured');

	$params = array(
		'content' => $content,
		'sidebar' => $sidebar,
		'filter' => $filter,
	);
	$body = elgg_view_layout('content', $params);

	echo elgg_view_page(elgg_echo('myTrips:all'), $body);
}

function myTrips_search_page() {
	elgg_push_breadcrumb(elgg_echo('search'));

	$tag = get_input("tag");
	$display_query = _elgg_get_display_query($tag);
	$title = elgg_echo('myTrips:search:title', array($display_query));

	// myTrips plugin saves tags as "interests" - see myTrips_fields_setup() in start.php
	$params = array(
		'metadata_name' => 'interests',
		'metadata_value' => $tag,
		'type' => 'trip',
		'full_view' => false,
		'no_results' => elgg_echo('myTrips:search:none'),
	);
	$content = elgg_list_entities_from_metadata($params);

	$sidebar = elgg_view('myTrips/sidebar/find');
	$sidebar .= elgg_view('myTrips/sidebar/featured');

	$params = array(
		'content' => $content,
		'sidebar' => $sidebar,
		'filter' => false,
		'title' => $title,
	);
	$body = elgg_view_layout('content', $params);

	echo elgg_view_page($title, $body);
}

/**
 * List owned myTrips
 */
function myTrips_handle_owned_page() {

	$page_owner = elgg_get_page_owner_entity();

	if ($page_owner->guid == elgg_get_logged_in_user_guid()) {
		$title = elgg_echo('myTrips:owned');
	} else {
		$title = elgg_echo('myTrips:owned:user', array($page_owner->name));
	}
	elgg_push_breadcrumb($title);

	if (elgg_get_plugin_setting('limited_myTrips', 'myTrips') != 'yes' || elgg_is_admin_logged_in()) {
		elgg_register_title_button();
	}

	$dbprefix = elgg_get_config('dbprefix');
	$content = elgg_list_entities(array(
		'type' => 'trip',
		'owner_guid' => elgg_get_page_owner_guid(),
		'joins' => array("JOIN {$dbprefix}myTrips_entity ge ON e.guid = ge.guid"),
		'order_by' => 'ge.name ASC',
		'full_view' => false,
		'no_results' => elgg_echo('myTrips:none'),
		'distinct' => false,
	));

	$params = array(
		'content' => $content,
		'title' => $title,
		'filter' => '',
	);
	$body = elgg_view_layout('content', $params);

	echo elgg_view_page($title, $body);
}

/**
 * List myTrips the user is memober of
 */
function myTrips_handle_mine_page() {

	$page_owner = elgg_get_page_owner_entity();

	if ($page_owner->guid == elgg_get_logged_in_user_guid()) {
		$title = elgg_echo('myTrips:yours');
	} else {
		$title = elgg_echo('myTrips:user', array($page_owner->name));
	}
	elgg_push_breadcrumb($title);

	if (elgg_get_plugin_setting('limited_myTrips', 'myTrips') != 'yes' || elgg_is_admin_logged_in()) {
		elgg_register_title_button();
	}

	$dbprefix = elgg_get_config('dbprefix');

	$content = elgg_list_entities_from_relationship(array(
		'type' => 'trip',
		'relationship' => 'member',
		'relationship_guid' => elgg_get_page_owner_guid(),
		'inverse_relationship' => false,
		'full_view' => false,
		'joins' => array("JOIN {$dbprefix}myTrips_entity ge ON e.guid = ge.guid"),
		'order_by' => 'ge.name ASC',
		'no_results' => elgg_echo('myTrips:none'),
	));

	$params = array(
		'content' => $content,
		'title' => $title,
		'filter' => '',
	);
	$body = elgg_view_layout('content', $params);

	echo elgg_view_page($title, $body);
}

/**
 * Create or edit a trip
 *
 * @param string $page
 * @param int $guid
 */
function myTrips_handle_edit_page($page, $guid = 0) 
{
	elgg_gatekeeper();

	elgg_require_js('elgg/myTrips/edit');

	if ($page == 'add') 
	{
		system_message("en add 2");
		elgg_set_page_owner_guid(elgg_get_logged_in_user_guid());
		$title = elgg_echo('myTrips:add');
		elgg_push_breadcrumb($title);

		if (elgg_get_plugin_setting('limited_myTrips', 'myTrips') != 'yes' || elgg_is_admin_logged_in()) {
			$content = elgg_view('myTrips/edit');
		} else {
			$content = elgg_echo('myTrips:cantcreate');
		}
	} else {
		$title = elgg_echo("myTrips:edit");
		$trip = get_entity($guid);

		if (elgg_instanceof($trip, 'trip') && $trip->canEdit()) {
			elgg_set_page_owner_guid($trip->getGUID());
			elgg_push_breadcrumb($trip->name, $trip->getURL());
			elgg_push_breadcrumb($title);
			$content = elgg_view("myTrips/edit", array('entity' => $trip));
		} else {
			$content = elgg_echo('myTrips:noaccess');
		}
	}

	$params = array(
		'content' => $content,
		'title' => $title,
		'filter' => '',
	);
	$body = elgg_view_layout('content', $params);

	echo elgg_view_page($title, $body);
}

/**
 * trip invitations for a user
 */
function myTrips_handle_invitations_page() {
	elgg_gatekeeper();

	$username = get_input('username');
	if ($username) {
		$user = get_user_by_username($username);
		elgg_set_page_owner_guid($user->guid);
	} else {
		$user = elgg_get_logged_in_user_entity();
		elgg_set_page_owner_guid($user->guid);
	}

	if (!$user || !$user->canEdit()) {
		register_error(elgg_echo('noaccess'));
		forward('');
	}

	$title = elgg_echo('myTrips:invitations');
	elgg_push_breadcrumb($title);

	$content = elgg_view('myTrips/invitationrequests');

	$params = array(
		'content' => $content,
		'title' => $title,
		'filter' => '',
	);
	$body = elgg_view_layout('content', $params);

	echo elgg_view_page($title, $body);
}

/**
 * trip profile page
 *
 * @param int $guid trip entity GUID
 */
function myTrips_handle_profile_page($guid) {
	elgg_set_page_owner_guid($guid);

	// turn this into a core function
	global $autofeed;
	$autofeed = true;

	elgg_push_context('trip_profile');

	elgg_entity_gatekeeper($guid, 'trip');

	$trip = get_entity($guid);

	elgg_push_breadcrumb($trip->name);

	myTrips_register_profile_buttons($trip);

	$content = elgg_view('myTrips/profile/layout', array('entity' => $trip));
	$sidebar = '';

	if (elgg_trip_gatekeeper(false)) {
		if (elgg_is_active_plugin('search')) {
			$sidebar .= elgg_view('myTrips/sidebar/search', array('entity' => $trip));
		}
		$sidebar .= elgg_view('myTrips/sidebar/members', array('entity' => $trip));
		$sidebar .= elgg_view('myTrips/sidebar/followers', array('entity' => $trip));
		$sidebar .= elgg_view('myTrips/sidebar/preorder', array('entity' => $trip));
		$sidebar .= elgg_view('myTrips/sidebar/confirmed', array('entity' => $trip));
		$subscribed = false;
		if (elgg_is_active_plugin('notifications')) {
			$NOTIFICATION_HANDLERS = _elgg_services()->notifications->getMethodsAsDeprecatedGlobal();
			foreach ($NOTIFICATION_HANDLERS as $method => $foo) {
				$relationship = check_entity_relationship(elgg_get_logged_in_user_guid(),
						'notify' . $method, $guid);

				if ($relationship) {
					$subscribed = true;
					break;
				}
			}
		}

		$sidebar .= elgg_view('myTrips/sidebar/my_status', array(
			'entity' => $trip,
			'subscribed' => $subscribed
		));
	}

	$params = array(
		'content' => $content,
		'sidebar' => $sidebar,
		'title' => $trip->name,
	);
	$body = elgg_view_layout('one_sidebar', $params);

	echo elgg_view_page($trip->name, $body);
}

/**
 * trip activity page
 *
 * @param int $guid trip entity GUID
 */
function myTrips_handle_activity_page($guid) {

	elgg_entity_gatekeeper($guid, 'trip');

	elgg_set_page_owner_guid($guid);

	elgg_trip_gatekeeper();

	$trip = get_entity($guid);

	$title = elgg_echo('myTrips:activity');

	elgg_push_breadcrumb($trip->name, $trip->getURL());
	elgg_push_breadcrumb($title);

	$db_prefix = elgg_get_config('dbprefix');

	$content = elgg_list_river(array(
		'joins' => array(
			"JOIN {$db_prefix}entities e1 ON e1.guid = rv.object_guid",
			"LEFT JOIN {$db_prefix}entities e2 ON e2.guid = rv.target_guid",
		),
		'wheres' => array(
			"(e1.container_guid = $trip->guid OR e2.container_guid = $trip->guid)",
		),
		'no_results' => elgg_echo('myTrips:activity:none'),
	));

	$params = array(
		'content' => $content,
		'title' => $title,
		'filter' => '',
	);
	$body = elgg_view_layout('content', $params);

	echo elgg_view_page($title, $body);
}

/**
 * trip members page
 *
 * @param int $guid trip entity GUID
 */
function myTrips_handle_members_page($guid) {

	elgg_entity_gatekeeper($guid, 'trip');

	$trip = get_entity($guid);

	elgg_set_page_owner_guid($guid);

	elgg_trip_gatekeeper();

	$title = elgg_echo('myTrips:members:title', array($trip->name));

	elgg_push_breadcrumb($trip->name, $trip->getURL());
	elgg_push_breadcrumb(elgg_echo('myTrips:members'));

	$user=elgg_get_logged_in_user_entity();

	$db_prefix = elgg_get_config('dbprefix');
	$content = elgg_list_entities_from_relationship(array(
		'relationship' => 'member',
		'relationship_guid' => $trip->guid,
		'inverse_relationship' => true,
		'type' => 'user',
		'limit' => (int)get_input('limit', max(20, elgg_get_config('default_limit')), false),
		'joins' => array("JOIN {$db_prefix}users_entity u ON e.guid=u.guid"),
		//'wheres'=>array("u.guid!=".$user->guid." AND u.guid!=".$trip["owner_guid"]),
		'order_by' => 'u.name ASC',
	));
	/*
	elgg_log("CREANDO myTrips/members/guid->","NOTICE");
	elgg_dump($content);
	*/
	$params = array(
		'content' => $content,
		'title' => $title,
		'filter' => '',
	);
	$body = elgg_view_layout('content', $params);

	echo elgg_view_page($title, $body);
}

/**
 * Invite users to a trip
 *
 * @param int $guid trip entity GUID
 */
function myTrips_handle_invite_page($guid) {
	elgg_gatekeeper();

	elgg_set_page_owner_guid($guid);

	$title = elgg_echo('myTrips:invite:title');

	$trip = get_entity($guid);
	if (!elgg_instanceof($trip, 'trip') || !$trip->canEdit()) {
		register_error(elgg_echo('myTrips:noaccess'));
		forward(REFERER);
	}

	$content = elgg_view_form('myTrips/invite', array(
		'id' => 'invite_to_trip',
		'class' => 'elgg-form-alt mtm',
	), array(
		'entity' => $trip,
	));

	elgg_push_breadcrumb($trip->name, $trip->getURL());
	elgg_push_breadcrumb(elgg_echo('myTrips:invite'));

	$params = array(
		'content' => $content,
		'title' => $title,
		'filter' => '',
	);
	$body = elgg_view_layout('content', $params);

	echo elgg_view_page($title, $body);
}

/**
 * Manage orders to a trip
 *
 * @param int $guid trip entity GUID
 */
function myTrips_handle_manageOrders_page($guid) {
	elgg_gatekeeper();

	elgg_set_page_owner_guid($guid);

	$title = elgg_echo('myTrips:manageOrders:title');

	$trip = get_entity($guid);
	if (!elgg_instanceof($trip, 'trip') || !$trip->canEdit()) {
		register_error(elgg_echo('myTrips:noaccess'));
		forward(REFERER);
	}

	$content = elgg_view_form('myTrips/manageOrders', array(
		'id' => 'manageOrders',
		'class' => 'elgg-form-alt mtm',
	), array(
		'entity' => $trip,
	));

	elgg_push_breadcrumb($trip->name, $trip->getURL());
	elgg_push_breadcrumb(elgg_echo('myTrips:manageOrders'));

	$params = array(
		'content' => $content,
		'title' => $title,
		'filter' => '',
	);
	$body = elgg_view_layout('content', $params);

	echo elgg_view_page($title, $body);
}

function myTrips_handle_summaryPreOrder_page($guid) {
	elgg_gatekeeper();

	elgg_set_page_owner_guid($guid);

	$title = elgg_echo('myTrips:summaryPreOrder:title');

	$trip = get_entity($guid);
	/*if (!elgg_instanceof($trip, 'trip') || !$trip->canEdit()) {
		register_error(elgg_echo('myTrips:noaccess'));
		forward(REFERER);
	}*/

	$content = elgg_view_form('myTrips/summaryPreOrder', array(
		'id' => 'summaryOrder',
		'class' => 'elgg-form-alt mtm',
	), array(
		'entity' => $trip,
	));

	elgg_push_breadcrumb($trip->name, $trip->getURL());
	elgg_push_breadcrumb(elgg_echo('myTrips:summaryOrder'));

	$params = array(
		'content' => $content,
		'title' => $title,
		'filter' => '',
	);
	$body = elgg_view_layout('content', $params);

	echo elgg_view_page($title, $body);
}


/**
 * Manage requests to join a trip
 *
 * @param int $guid trip entity GUID
 */
function myTrips_handle_requests_page($guid) {

	elgg_gatekeeper();

	elgg_set_page_owner_guid($guid);

	$trip = get_entity($guid);
	if (!elgg_instanceof($trip, 'trip') || !$trip->canEdit()) {
		register_error(elgg_echo('myTrips:noaccess'));
		forward(REFERER);
	}

	$title = elgg_echo('myTrips:membershiprequests');

	elgg_push_breadcrumb($trip->name, $trip->getURL());
	elgg_push_breadcrumb($title);

	$requests = elgg_get_entities_from_relationship(array(
		'type' => 'user',
		'relationship' => 'membership_request',
		'relationship_guid' => $guid,
		'inverse_relationship' => true,
		'limit' => 0,
	));
	$content = elgg_view('myTrips/membershiprequests', array(
		'requests' => $requests,
		'entity' => $trip,
	));

	$params = array(
		'content' => $content,
		'title' => $title,
		'filter' => '',
	);
	$body = elgg_view_layout('content', $params);

	echo elgg_view_page($title, $body);
}

/**
 * Registers the buttons for title area of the trip profile page
 *
 * @param trip $trip
 */
function myTrips_register_profile_buttons($trip) {

	$actions = array();

	// trip owners
	if ($trip->canEdit()) {
		// edit and invite
		$url = elgg_get_site_url() . "myTrips/edit/{$trip->getGUID()}";
		$actions[$url] = 'myTrips:edit';
		$url = elgg_get_site_url() . "myTrips/invite/{$trip->getGUID()}";
		$actions[$url] = 'myTrips:invite';
		$contar=0;
		for($i=2;$i<count($trip->summaryPreOrderConfirmed);$i++){
			if($trip->summaryPreOrderConfirmed[$i]==0){
				$contar++;
			}
		}
		if (count($trip->preorder)>2 || $contar>0){
			$url = elgg_get_site_url() . "myTrips/manageOrders/{$trip->getGUID()}";
		$actions[$url] = 'myTrips:manageOrders';
		}
		
	
	}
	//system_message("CREANDO BOTONES myTrips/libs/myTrips","NOTICE");
	
	
	// trip members
	if ($trip->isMember(elgg_get_logged_in_user_entity())) {
		if ($trip->getOwnerGUID() != elgg_get_logged_in_user_guid()) {
			
			$user=elgg_get_logged_in_user_entity();
			$asientosOcupados=0;
				$summaryPreOrderUserGuid=$trip->summaryPreOrderUserGuid;
				$summaryPreOrderConfirmed=$trip->summaryPreOrderConfirmed;
				$summaryPreOrderBultos=$trip->summaryPreOrderBultos;
				$summaryPreOrderTrayecto=$trip->summaryPreOrderTrayecto;
				$clave=array_search($user->guid,$summaryPreOrderUserGuid);
				/*for($i=2;$i<count($summaryPreOrderConfirmed);$i++)
					{
						if($summaryPreOrderConfirmed[$i]=="1") {
							$asientosOcupados++;
						}
					}*/
			if($summaryPreOrderConfirmed[$clave]=="1") {
				
				// Desconfirmed
				$url = elgg_get_site_url() . "action/myTrips/unconfirmtrip?trip_guid={$trip->getGUID()}";
				$url = elgg_add_action_tokens_to_url($url);
				$actions[$url] = 'myTrips:unconfirmTrip';
				
			}
			else if(in_array($user->guid,$trip->preorder)) {
				
				// despreorder
				$url = elgg_get_site_url() . "action/myTrips/unpreorder?trip_guid={$trip->getGUID()}";
				$url = elgg_add_action_tokens_to_url($url);
				$actions[$url] = 'myTrips:unPreorder';
				
				// confirmed
				/*$url = elgg_get_site_url() . "action/myTrips/confirmtrip?trip_guid={$trip->getGUID()}";
				$url = elgg_add_action_tokens_to_url($url);
				$actions[$url] = 'myTrips:confirmTrip';*/
				
			}
			else if(in_array($user->guid,$trip->follower)) {
				
				// leave trip
				$url = elgg_get_site_url() . "action/myTrips/leave?trip_guid={$trip->getGUID()}";
				$url = elgg_add_action_tokens_to_url($url);
				$actions[$url] = 'myTrips:leave';
				
				//calculo asientos para éste viaje
				$owner = $trip->getOwnerEntity();
				
				$asientosOcupados=0;
				if($trip->preorder!="") $asientosOcupados+=count($trip->preorder)-2;
				if($trip->confirmed!="") $asientosOcupados+=count($trip->confirmed)-2;
				
				$asientosLibres=0;
				//Si hay asientos disponibles para éste viaje podrá seguir haciendo el proceso
				if($owner->nAsientos!="") $asientosLibres=($owner->nAsientos-1);
				else if($trip->nplazas!="") $asientosLibres=($trip->nplazas-1);
				
				
				if($asientosLibres>=$asientosOcupados) {
					// preorder
					
					$url = elgg_get_site_url() . "myTrips/summaryPreOrder/{$trip->getGUID()}";
					$actions[$url] = 'myTrips:manageOrders';
					/*
					$url = elgg_get_site_url() . "action/myTrips/preorder?trip_guid={$trip->getGUID()}";
					$url = elgg_add_action_tokens_to_url($url);
					*/
					$actions[$url] = 'myTrips:preorder';
				}else {
					register_error(elgg_echo("myTrips:cantPreorderSeatMax"));
				}
				
				
			}
			else {
			
				// leave trip
				$url = elgg_get_site_url() . "action/myTrips/leave?trip_guid={$trip->getGUID()}";
				$url = elgg_add_action_tokens_to_url($url);
				$actions[$url] = 'myTrips:leave';
				
				// preOrder
				$url = elgg_get_site_url() . "action/myTrips/preorder?trip_guid={$trip->getGUID()}";
				$url = elgg_add_action_tokens_to_url($url);
				$actions[$url] = 'myTrips:preReservar';
			}
		}
	} elseif (elgg_is_logged_in()) {
		// join - admins can always join.
		$url = elgg_get_site_url() . "action/myTrips/join?trip_guid={$trip->getGUID()}";
		$url = elgg_add_action_tokens_to_url($url);
		if ($trip->isPublicMembership() || $trip->canEdit()) {
			$actions[$url] = 'myTrips:join';
		} else {
			// request membership
			$actions[$url] = 'myTrips:joinrequest';
		}
	}

	if ($actions) {
		foreach ($actions as $url => $text) {
			elgg_register_menu_item('title', array(
				'name' => $text,
				'href' => $url,
				'text' => elgg_echo($text),
				'link_class' => 'elgg-button elgg-button-action',
			));
		}
	}
}

/**
 * Prepares variables for the trip edit form view.
 *
 * @param mixed $trip trip or null. If a trip, uses values from the trip.
 * @return array
 */
function myTrips_prepare_form_vars($trip = null) {
	$values = array(
		'name' => '',
		'membership' => ACCESS_PUBLIC,
		'vis' => ACCESS_PUBLIC,
		'guid' => null,
		'entity' => null,
		'owner_guid' => elgg_get_logged_in_user_guid(),
		'content_access_mode' => ElggGroup::CONTENT_ACCESS_MODE_UNRESTRICTED
	);

	// handle customizable profile fields
	$fields = elgg_get_config('group'); ///check ***

	if ($fields) {
		foreach ($fields as $name => $type) {
			$values[$name] = '';
		}
	}

	// handle tool options
	$tools = elgg_get_config('trip_tool_options');
	if ($tools) {
		foreach ($tools as $trip_option) {
			$option_name = $trip_option->name . "_enable";
			$values[$option_name] = $trip_option->default_on ? 'yes' : 'no';
		}
	}

	// get current trip settings
	if ($trip) {
		foreach (array_keys($values) as $field) {
			if (isset($trip->$field)) {
				$values[$field] = $trip->$field;
			}
		}

		if ($trip->access_id != ACCESS_PUBLIC && $trip->access_id != ACCESS_LOGGED_IN) {
			// trip only access - this is done to handle access not created when trip is created
			$values['vis'] = ACCESS_PRIVATE;
		} else {
			$values['vis'] = $trip->access_id;
		}

		// The content_access_mode was introduced in 1.9. This method must be
		// used for backwards compatibility with myTrips created before 1.9.
		$values['content_access_mode'] = $trip->getContentAccessMode();

		$values['entity'] = $trip;
	}

	// get any sticky form settings
	if (elgg_is_sticky_form('myTrips')) {
		$sticky_values = elgg_get_sticky_values('myTrips');
		foreach ($sticky_values as $key => $value) {
			$values[$key] = $value;
		}
	}

	elgg_clear_sticky_form('myTrips');

	return $values;
}
