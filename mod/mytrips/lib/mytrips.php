<?php
/**
 * Trips function library
* 	Plugin: mytripsTeranga
*	Author: Rosana Montes Soldado from previous version of @package Elggmytrips
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

/**
 * List all mytrips
 */
function mytrips_handle_all_page() {

	// all mytrips doesn't get link to self
	elgg_pop_breadcrumb();
	elgg_push_breadcrumb(elgg_echo('mytrips'));

	if (elgg_get_plugin_setting('limited_mytrips', 'mytrips') != 'yes' || elgg_is_admin_logged_in()) {
		elgg_register_title_button();
	}

	$selected_tab = get_input('filter', 'newest');

	switch ($selected_tab) {
		case 'popular':
			$content = elgg_list_entities_from_relationship_count(array(
				'type' => 'group',
				'relationship' => 'member',
				'inverse_relationship' => false,
				'full_view' => false,
				'no_results' => elgg_echo('mytrips:none'),
			));
			break;
		case 'discussion':
			$content = elgg_list_entities(array(
				'type' => 'object',
				'subtype' => 'groupforumtopic',
				'order_by' => 'e.last_action desc',
				'limit' => 40,
				'full_view' => false,
				'no_results' => elgg_echo('discussion:none'),
				'distinct' => false,
				'preload_containers' => true
			));
			break;
		case 'featured':
			$content = elgg_list_entities_from_metadata(array(
				'type' => 'group',
				'metadata_name' => 'featured_group',
				'metadata_value' => 'yes',
				'full_view' => false,
			));
			if (!$content) {
				$content = elgg_echo('mytrips:nofeatured');
			}
			break;
		case 'newest':
		default:
			$content = elgg_list_entities(array(
				'type' => 'group',
				'full_view' => false,
				'no_results' => elgg_echo('mytrips:none'),
				'distinct' => false
				
			));
			break;
	}

	$filter = elgg_view('mytrips/group_sort_menu', array('selected' => $selected_tab));

	$sidebar = elgg_view('mytrips/sidebar/find');
	$sidebar .= elgg_view('mytrips/sidebar/featured');

	$params = array(
		'content' => $content,
		'sidebar' => $sidebar,
		'filter' => $filter,
	);
	$body = elgg_view_layout('content', $params);

	echo elgg_view_page(elgg_echo('mytrips:all'), $body);
}

function mytrips_search_page() {
	elgg_push_breadcrumb(elgg_echo('search'));

	$tag = get_input("tag");
	$display_query = _elgg_get_display_query($tag);
	$title = elgg_echo('mytrips:search:title', array($display_query));

	// mytrips plugin saves tags as "interests" - see mytrips_fields_setup() in start.php
	$params = array(
		'metadata_name' => 'interests',
		'metadata_value' => $tag,
		'type' => 'group',
		'full_view' => false,
		'no_results' => elgg_echo('mytrips:search:none'),
	);
	$content = elgg_list_entities_from_metadata($params);

	$sidebar = elgg_view('mytrips/sidebar/find');
	$sidebar .= elgg_view('mytrips/sidebar/featured');

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
 * List owned mytrips
 */
function mytrips_handle_owned_page() {

	$page_owner = elgg_get_page_owner_entity();

	if ($page_owner->guid == elgg_get_logged_in_user_guid()) {
		$title = elgg_echo('mytrips:owned');
	} else {
		$title = elgg_echo('mytrips:owned:user', array($page_owner->name));
	}
	elgg_push_breadcrumb($title);

	if (elgg_get_plugin_setting('limited_mytrips', 'mytrips') != 'yes' || elgg_is_admin_logged_in()) {
		elgg_register_title_button();
	}

	$dbprefix = elgg_get_config('dbprefix');
	$content = elgg_list_entities(array(
		'type' => 'group',
		'owner_guid' => elgg_get_page_owner_guid(),
		'joins' => array("JOIN {$dbprefix}mytrips_entity ge ON e.guid = ge.guid"),
		'order_by' => 'ge.name ASC',
		'full_view' => false,
		'no_results' => elgg_echo('mytrips:none'),
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
 * List mytrips the user is memober of
 */
function mytrips_handle_mine_page() {

	$page_owner = elgg_get_page_owner_entity();

	if ($page_owner->guid == elgg_get_logged_in_user_guid()) {
		$title = elgg_echo('mytrips:yours');
	} else {
		$title = elgg_echo('mytrips:user', array($page_owner->name));
	}
	elgg_push_breadcrumb($title);

	if (elgg_get_plugin_setting('limited_mytrips', 'mytrips') != 'yes' || elgg_is_admin_logged_in()) {
		elgg_register_title_button();
	}

	$dbprefix = elgg_get_config('dbprefix');

	$content = elgg_list_entities_from_relationship(array(
		'type' => 'group',
		'relationship' => 'member',
		'relationship_guid' => elgg_get_page_owner_guid(),
		'inverse_relationship' => false,
		'full_view' => false,
		'joins' => array("JOIN {$dbprefix}mytrips_entity ge ON e.guid = ge.guid"),
		'order_by' => 'ge.name ASC',
		'no_results' => elgg_echo('mytrips:none'),
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
 * Create or edit a group
 *
 * @param string $page
 * @param int $guid
 */
function mytrips_handle_edit_page($page, $guid = 0) {
	elgg_gatekeeper();

	elgg_require_js('elgg/mytrips/edit');

	if ($page == 'add') {
		elgg_set_page_owner_guid(elgg_get_logged_in_user_guid());
		$title = elgg_echo('mytrips:add');
		elgg_push_breadcrumb($title);
		if (elgg_get_plugin_setting('limited_mytrips', 'mytrips') != 'yes' || elgg_is_admin_logged_in()) {
			$content = elgg_view('mytrips/edit');
		} else {
			$content = elgg_echo('mytrips:cantcreate');
		}
	} else {
		$title = elgg_echo("mytrips:edit");
		$group = get_entity($guid);

		if (elgg_instanceof($group, 'group') && $group->canEdit()) {
			elgg_set_page_owner_guid($group->getGUID());
			elgg_push_breadcrumb($group->name, $group->getURL());
			elgg_push_breadcrumb($title);
			$content = elgg_view("mytrips/edit", array('entity' => $group));
		} else {
			$content = elgg_echo('mytrips:noaccess');
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
 * Group invitations for a user
 */
function mytrips_handle_invitations_page() {
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

	$title = elgg_echo('mytrips:invitations');
	elgg_push_breadcrumb($title);

	$content = elgg_view('mytrips/invitationrequests');

	$params = array(
		'content' => $content,
		'title' => $title,
		'filter' => '',
	);
	$body = elgg_view_layout('content', $params);

	echo elgg_view_page($title, $body);
}

/**
 * Group profile page
 *
 * @param int $guid Group entity GUID
 */
function mytrips_handle_profile_page($guid) {
	elgg_set_page_owner_guid($guid);

	// turn this into a core function
	global $autofeed;
	$autofeed = true;

	elgg_push_context('group_profile');

	elgg_entity_gatekeeper($guid, 'group');

	$group = get_entity($guid);

	elgg_push_breadcrumb($group->name);

	mytrips_register_profile_buttons($group);

	$content = elgg_view('mytrips/profile/layout', array('entity' => $group));
	$sidebar = '';

	if (elgg_group_gatekeeper(false)) {
		if (elgg_is_active_plugin('search')) {
			$sidebar .= elgg_view('mytrips/sidebar/search', array('entity' => $group));
		}
		$sidebar .= elgg_view('mytrips/sidebar/members', array('entity' => $group));
		$sidebar .= elgg_view('mytrips/sidebar/followers', array('entity' => $group));
		$sidebar .= elgg_view('mytrips/sidebar/preorder', array('entity' => $group));
		$sidebar .= elgg_view('mytrips/sidebar/confirmed', array('entity' => $group));
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

		$sidebar .= elgg_view('mytrips/sidebar/my_status', array(
			'entity' => $group,
			'subscribed' => $subscribed
		));
	}

	$params = array(
		'content' => $content,
		'sidebar' => $sidebar,
		'title' => $group->name,
	);
	$body = elgg_view_layout('one_sidebar', $params);

	echo elgg_view_page($group->name, $body);
}

/**
 * Group activity page
 *
 * @param int $guid Group entity GUID
 */
function mytrips_handle_activity_page($guid) {

	elgg_entity_gatekeeper($guid, 'group');

	elgg_set_page_owner_guid($guid);

	elgg_group_gatekeeper();

	$group = get_entity($guid);

	$title = elgg_echo('mytrips:activity');

	elgg_push_breadcrumb($group->name, $group->getURL());
	elgg_push_breadcrumb($title);

	$db_prefix = elgg_get_config('dbprefix');

	$content = elgg_list_river(array(
		'joins' => array(
			"JOIN {$db_prefix}entities e1 ON e1.guid = rv.object_guid",
			"LEFT JOIN {$db_prefix}entities e2 ON e2.guid = rv.target_guid",
		),
		'wheres' => array(
			"(e1.container_guid = $group->guid OR e2.container_guid = $group->guid)",
		),
		'no_results' => elgg_echo('mytrips:activity:none'),
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
 * Group members page
 *
 * @param int $guid Group entity GUID
 */
function mytrips_handle_members_page($guid) {

	elgg_entity_gatekeeper($guid, 'group');

	$group = get_entity($guid);

	elgg_set_page_owner_guid($guid);

	elgg_group_gatekeeper();

	$title = elgg_echo('mytrips:members:title', array($group->name));

	elgg_push_breadcrumb($group->name, $group->getURL());
	elgg_push_breadcrumb(elgg_echo('mytrips:members'));

	$user=elgg_get_logged_in_user_entity();

	$db_prefix = elgg_get_config('dbprefix');
	$content = elgg_list_entities_from_relationship(array(
		'relationship' => 'member',
		'relationship_guid' => $group->guid,
		'inverse_relationship' => true,
		'type' => 'user',
		'limit' => (int)get_input('limit', max(20, elgg_get_config('default_limit')), false),
		'joins' => array("JOIN {$db_prefix}users_entity u ON e.guid=u.guid"),
		//'wheres'=>array("u.guid!=".$user->guid." AND u.guid!=".$group["owner_guid"]),
		'order_by' => 'u.name ASC',
	));
	/*
	elgg_log("CREANDO mytrips/members/guid->","NOTICE");
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
 * Invite users to a group
 *
 * @param int $guid Group entity GUID
 */
function mytrips_handle_invite_page($guid) {
	elgg_gatekeeper();

	elgg_set_page_owner_guid($guid);

	$title = elgg_echo('mytrips:invite:title');

	$group = get_entity($guid);
	if (!elgg_instanceof($group, 'group') || !$group->canEdit()) {
		register_error(elgg_echo('mytrips:noaccess'));
		forward(REFERER);
	}

	$content = elgg_view_form('mytrips/invite', array(
		'id' => 'invite_to_group',
		'class' => 'elgg-form-alt mtm',
	), array(
		'entity' => $group,
	));

	elgg_push_breadcrumb($group->name, $group->getURL());
	elgg_push_breadcrumb(elgg_echo('mytrips:invite'));

	$params = array(
		'content' => $content,
		'title' => $title,
		'filter' => '',
	);
	$body = elgg_view_layout('content', $params);

	echo elgg_view_page($title, $body);
}

/**
 * Manage orders to a group
 *
 * @param int $guid Group entity GUID
 */
function mytrips_handle_manageOrders_page($guid) {
	elgg_gatekeeper();

	elgg_set_page_owner_guid($guid);

	$title = elgg_echo('mytrips:manageOrders:title');

	$group = get_entity($guid);
	if (!elgg_instanceof($group, 'group') || !$group->canEdit()) {
		register_error(elgg_echo('mytrips:noaccess'));
		forward(REFERER);
	}

	$content = elgg_view_form('mytrips/manageOrders', array(
		'id' => 'manageOrders',
		'class' => 'elgg-form-alt mtm',
	), array(
		'entity' => $group,
	));

	elgg_push_breadcrumb($group->name, $group->getURL());
	elgg_push_breadcrumb(elgg_echo('mytrips:manageOrders'));

	$params = array(
		'content' => $content,
		'title' => $title,
		'filter' => '',
	);
	$body = elgg_view_layout('content', $params);

	echo elgg_view_page($title, $body);
}

function mytrips_handle_summaryPreOrder_page($guid) {
	elgg_gatekeeper();

	elgg_set_page_owner_guid($guid);

	$title = elgg_echo('mytrips:summaryPreOrder:title');

	$group = get_entity($guid);
	/*if (!elgg_instanceof($group, 'group') || !$group->canEdit()) {
		register_error(elgg_echo('mytrips:noaccess'));
		forward(REFERER);
	}*/

	$content = elgg_view_form('mytrips/summaryPreOrder', array(
		'id' => 'summaryOrder',
		'class' => 'elgg-form-alt mtm',
	), array(
		'entity' => $group,
	));

	elgg_push_breadcrumb($group->name, $group->getURL());
	elgg_push_breadcrumb(elgg_echo('mytrips:summaryOrder'));

	$params = array(
		'content' => $content,
		'title' => $title,
		'filter' => '',
	);
	$body = elgg_view_layout('content', $params);

	echo elgg_view_page($title, $body);
}


/**
 * Manage requests to join a group
 *
 * @param int $guid Group entity GUID
 */
function mytrips_handle_requests_page($guid) {

	elgg_gatekeeper();

	elgg_set_page_owner_guid($guid);

	$group = get_entity($guid);
	if (!elgg_instanceof($group, 'group') || !$group->canEdit()) {
		register_error(elgg_echo('mytrips:noaccess'));
		forward(REFERER);
	}

	$title = elgg_echo('mytrips:membershiprequests');

	elgg_push_breadcrumb($group->name, $group->getURL());
	elgg_push_breadcrumb($title);

	$requests = elgg_get_entities_from_relationship(array(
		'type' => 'user',
		'relationship' => 'membership_request',
		'relationship_guid' => $guid,
		'inverse_relationship' => true,
		'limit' => 0,
	));
	$content = elgg_view('mytrips/membershiprequests', array(
		'requests' => $requests,
		'entity' => $group,
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
 * Registers the buttons for title area of the group profile page
 *
 * @param ElggGroup $group
 */
function mytrips_register_profile_buttons($group) {

	$actions = array();

	// group owners
	if ($group->canEdit()) {
		// edit and invite
		$url = elgg_get_site_url() . "mytrips/edit/{$group->getGUID()}";
		$actions[$url] = 'mytrips:edit';
		$url = elgg_get_site_url() . "mytrips/invite/{$group->getGUID()}";
		$actions[$url] = 'mytrips:invite';
		$contar=0;
		for($i=2;$i<count($group->summaryPreOrderConfirmed);$i++){
			if($group->summaryPreOrderConfirmed[$i]==0){
				$contar++;
			}
		}
		if (count($group->preorder)>2 || $contar>0){
			$url = elgg_get_site_url() . "mytrips/manageOrders/{$group->getGUID()}";
		$actions[$url] = 'mytrips:manageOrders';
		}
		
	
	}
	//system_message("CREANDO BOTONES mytrips/libs/mytrips","NOTICE");
	
	
	// group members
	if ($group->isMember(elgg_get_logged_in_user_entity())) {
		if ($group->getOwnerGUID() != elgg_get_logged_in_user_guid()) {
			
			$user=elgg_get_logged_in_user_entity();
			$asientosOcupados=0;
				$summaryPreOrderUserGuid=$group->summaryPreOrderUserGuid;
				$summaryPreOrderConfirmed=$group->summaryPreOrderConfirmed;
				$summaryPreOrderBultos=$group->summaryPreOrderBultos;
				$summaryPreOrderTrayecto=$group->summaryPreOrderTrayecto;
				$clave=array_search($user->guid,$summaryPreOrderUserGuid);
				/*for($i=2;$i<count($summaryPreOrderConfirmed);$i++)
					{
						if($summaryPreOrderConfirmed[$i]=="1") {
							$asientosOcupados++;
						}
					}*/
			if($summaryPreOrderConfirmed[$clave]=="1") {
				
				// Desconfirmed
				$url = elgg_get_site_url() . "action/mytrips/unconfirmtrip?group_guid={$group->getGUID()}";
				$url = elgg_add_action_tokens_to_url($url);
				$actions[$url] = 'mytrips:unconfirmTrip';
				
			}
			else if(in_array($user->guid,$group->preorder)) {
				
				// despreorder
				$url = elgg_get_site_url() . "action/mytrips/unpreorder?group_guid={$group->getGUID()}";
				$url = elgg_add_action_tokens_to_url($url);
				$actions[$url] = 'mytrips:unPreorder';
				
				// confirmed
				/*$url = elgg_get_site_url() . "action/mytrips/confirmtrip?group_guid={$group->getGUID()}";
				$url = elgg_add_action_tokens_to_url($url);
				$actions[$url] = 'mytrips:confirmTrip';*/
				
			}
			else if(in_array($user->guid,$group->follower)) {
				
				// leave group
				$url = elgg_get_site_url() . "action/mytrips/leave?group_guid={$group->getGUID()}";
				$url = elgg_add_action_tokens_to_url($url);
				$actions[$url] = 'mytrips:leave';
				
				//calculo asientos para éste viaje
				$owner = $group->getOwnerEntity();
				
				$asientosOcupados=0;
				if($group->preorder!="") $asientosOcupados+=count($group->preorder)-2;
				if($group->confirmed!="") $asientosOcupados+=count($group->confirmed)-2;
				
				$asientosLibres=0;
				//Si hay asientos disponibles para éste viaje podrá seguir haciendo el proceso
				if($owner->nAsientos!="") $asientosLibres=($owner->nAsientos-1);
				else if($group->nplazas!="") $asientosLibres=($group->nplazas-1);
				
				
				if($asientosLibres>=$asientosOcupados) {
					// preorder
					
					$url = elgg_get_site_url() . "mytrips/summaryPreOrder/{$group->getGUID()}";
					$actions[$url] = 'mytrips:manageOrders';
					/*
					$url = elgg_get_site_url() . "action/mytrips/preorder?group_guid={$group->getGUID()}";
					$url = elgg_add_action_tokens_to_url($url);
					*/
					$actions[$url] = 'mytrips:preorder';
				}else {
					register_error(elgg_echo("mytrips:cantPreorderSeatMax"));
				}
				
				
			}
			else {
			
				// leave group
				$url = elgg_get_site_url() . "action/mytrips/leave?group_guid={$group->getGUID()}";
				$url = elgg_add_action_tokens_to_url($url);
				$actions[$url] = 'mytrips:leave';
				
				// preOrder
				$url = elgg_get_site_url() . "action/mytrips/preorder?group_guid={$group->getGUID()}";
				$url = elgg_add_action_tokens_to_url($url);
				$actions[$url] = 'mytrips:preReservar';
			}
		}
	} elseif (elgg_is_logged_in()) {
		// join - admins can always join.
		$url = elgg_get_site_url() . "action/mytrips/join?group_guid={$group->getGUID()}";
		$url = elgg_add_action_tokens_to_url($url);
		if ($group->isPublicMembership() || $group->canEdit()) {
			$actions[$url] = 'mytrips:join';
		} else {
			// request membership
			$actions[$url] = 'mytrips:joinrequest';
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
 * Prepares variables for the group edit form view.
 *
 * @param mixed $group ElggGroup or null. If a group, uses values from the group.
 * @return array
 */
function mytrips_prepare_form_vars($group = null) {
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
	$fields = elgg_get_config('group');

	if ($fields) {
		foreach ($fields as $name => $type) {
			$values[$name] = '';
		}
	}

	// handle tool options
	$tools = elgg_get_config('group_tool_options');
	if ($tools) {
		foreach ($tools as $group_option) {
			$option_name = $group_option->name . "_enable";
			$values[$option_name] = $group_option->default_on ? 'yes' : 'no';
		}
	}

	// get current group settings
	if ($group) {
		foreach (array_keys($values) as $field) {
			if (isset($group->$field)) {
				$values[$field] = $group->$field;
			}
		}

		if ($group->access_id != ACCESS_PUBLIC && $group->access_id != ACCESS_LOGGED_IN) {
			// group only access - this is done to handle access not created when group is created
			$values['vis'] = ACCESS_PRIVATE;
		} else {
			$values['vis'] = $group->access_id;
		}

		// The content_access_mode was introduced in 1.9. This method must be
		// used for backwards compatibility with mytrips created before 1.9.
		$values['content_access_mode'] = $group->getContentAccessMode();

		$values['entity'] = $group;
	}

	// get any sticky form settings
	if (elgg_is_sticky_form('mytrips')) {
		$sticky_values = elgg_get_sticky_values('mytrips');
		foreach ($sticky_values as $key => $value) {
			$values[$key] = $value;
		}
	}

	elgg_clear_sticky_form('mytrips');

	return $values;
}
