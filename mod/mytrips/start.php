<?php
/**
 * Elgg mytrips start page 
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

elgg_register_event_handler('init', 'system', 'mytrips_init');

// Ensure this runs after other plugins
elgg_register_event_handler('init', 'system', 'mytrips_fields_setup', 10000);

/**
 * Initialize the mytrips plugin.
 */
function mytrips_init() 
{
	elgg_register_library('elgg:mytrips', elgg_get_plugins_path() . 'mytrips/lib/mytrips.php');

	// register trip entities for search
	elgg_register_entity_type('trip', '');

	// Set up the menu
	$item = new ElggMenuItem('mytrips', elgg_echo('mytrips'), 'mytrips/all');
	elgg_register_menu_item('site', $item);

	// Register a page handler, so we can have nice URLs
	elgg_register_page_handler('mytrips', 'mytrips_page_handler');

	// Register URL handlers for mytrips
	elgg_register_plugin_hook_handler('entity:url', 'trip', 'mytrips_set_url');
	elgg_register_plugin_hook_handler('entity:icon:url', 'trip', 'mytrips_set_icon_url');

	// Register an icon handler for mytrips
	elgg_register_page_handler('tripicon', 'mytrips_icon_handler');

	// Register some actions
	$action_base = elgg_get_plugins_path() . 'mytrips/actions/mytrips';
	elgg_register_action("mytrips/edit", "$action_base/edit.php");
	elgg_register_action("mytrips/delete", "$action_base/delete.php");
	elgg_register_action("mytrips/featured", "$action_base/featured.php", 'admin');

	$action_base .= '/membership';
	elgg_register_action("mytrips/manageOrders", "$action_base/manageOrders.php");
	elgg_register_action("mytrips/summaryPreOrder", "$action_base/summaryPreOrder.php");
	elgg_register_action("mytrips/invite", "$action_base/invite.php");
	elgg_register_action("mytrips/join", "$action_base/join.php");
	elgg_register_action("mytrips/leave", "$action_base/leave.php");
	elgg_register_action("mytrips/preorder", "$action_base/preorder.php");
	elgg_register_action("mytrips/unpreorder", "$action_base/unpreorder.php");
	elgg_register_action("mytrips/confirmtrip", "$action_base/confirmtrip.php");
	elgg_register_action("mytrips/unconfirmtrip", "$action_base/unconfirmtrip.php");
	elgg_register_action("mytrips/remove", "$action_base/remove.php");
	elgg_register_action("mytrips/killrequest", "$action_base/delete_request.php");
	elgg_register_action("mytrips/killinvitation", "$action_base/delete_invite.php");
	elgg_register_action("mytrips/addtotrip", "$action_base/add.php");

	// Add some widgets
	elgg_register_widget_type('a_users_mytrips', elgg_echo('mytrips:widget:membership'), elgg_echo('mytrips:widgets:description'));

	elgg_register_widget_type(
			'trip_activity',
			elgg_echo('mytrips:widget:trip_activity:title'),
			elgg_echo('mytrips:widget:trip_activity:description'),
			array('dashboard'),
			true
	);

	// add activity tool option
	add_group_tool_option('activity', elgg_echo('mytrips:enableactivity'), true);
	elgg_extend_view('mytrips/tool_latest', 'mytrips/profile/activity_module');

	// add link to owner block
	elgg_register_plugin_hook_handler('register', 'menu:owner_block', 'mytrips_activity_owner_block_menu');

	// trip entity menu
	elgg_register_plugin_hook_handler('register', 'menu:entity', 'mytrips_entity_menu_setup');

	elgg_register_plugin_hook_handler('register', 'menu:user_hover', 'mytrips_user_entity_menu_setup');
	// trip user hover menu

	// invitation request actions
	elgg_register_plugin_hook_handler('register', 'menu:invitationrequest', 'mytrips_invitationrequest_menu_setup');

	//extend some views
	elgg_extend_view('css/elgg', 'mytrips/css');
	elgg_extend_view('js/elgg', 'mytrips/js');

	// Access permissions
	elgg_register_plugin_hook_handler('access:collections:write', 'all', 'mytrips_write_acl_plugin_hook');
	elgg_register_plugin_hook_handler('default', 'access', 'mytrips_access_default_override');

	// Register profile menu hook
	elgg_register_plugin_hook_handler('profile_menu', 'profile', 'activity_profile_menu');

	// allow ecml in discussion and profiles
	elgg_register_plugin_hook_handler('get_views', 'ecml', 'mytrips_ecml_views_hook');
	elgg_register_plugin_hook_handler('get_views', 'ecml', 'tripprofile_ecml_views_hook');

	// Register a handler for create mytrips
	elgg_register_event_handler('create', 'trip', 'mytrips_create_event_listener');

	elgg_register_event_handler('join', 'trip', 'mytrips_user_join_event_listener');
	elgg_register_event_handler('leave', 'trip', 'mytrips_user_leave_event_listener');
	elgg_register_event_handler('pagesetup', 'system', 'mytrips_setup_sidebar_menus');

	elgg_register_plugin_hook_handler('access:collections:add_user', 'collection', 'mytrips_access_collection_override');

}

/**
 * This function loads a set of default fields into the profile, then triggers
 * a hook letting other plugins to edit add and delete fields.
 *
 * Note: This is a system:init event triggered function and is run at a super
 * low priority to guarantee that it is called after all other plugins have
 * initialized.
 */
function mytrips_fields_setup() {

	$profile_defaults = array(
		'description' => 'longtext',
		'briefdescription' => 'text',
		'interests' => 'tags',
		//'website' => 'url',
	);

	$profile_defaults = elgg_trigger_plugin_hook('profile:fields', 'trip', NULL, $profile_defaults);

	elgg_set_config('trip', $profile_defaults);

	// register any tag metadata names
	foreach ($profile_defaults as $name => $type) {
		if ($type == 'tags') {
			elgg_register_tag_metadata_name($name);

			// only shows up in search but why not just set this in en.php as doing it here
			// means you cannot override it in a plugin
			add_translation(get_current_language(), array("tag_names:$name" => elgg_echo("mytrips:$name")));
		}
	}
}

/**
 * Configure the mytrips sidebar menu. Triggered on page setup
 *
 */
function mytrips_setup_sidebar_menus() {

	// Get the page owner entity
	$page_owner = elgg_get_page_owner_entity();

	if (elgg_in_context('trip_profile')) {
		if (!elgg_instanceof($page_owner, 'trip')) {
			forward('', '404');
		}

		if (elgg_is_logged_in() && $page_owner->canEdit() && !$page_owner->isPublicMembership()) {
			$url = elgg_get_site_url() . "mytrips/requests/{$page_owner->getGUID()}";

			$count = elgg_get_entities_from_relationship(array(
				'type' => 'user',
				'relationship' => 'membership_request',
				'relationship_guid' => $page_owner->getGUID(),
				'inverse_relationship' => true,
				'count' => true,
			));

			if ($count) {
				$text = elgg_echo('mytrips:membershiprequests:pending', array($count));
			} else {
				$text = elgg_echo('mytrips:membershiprequests');
			}

			elgg_register_menu_item('page', array(
				'name' => 'membership_requests',
				'text' => $text,
				'href' => $url,
			));
		}
	}
	if (elgg_get_context() == 'mytrips' && !elgg_instanceof($page_owner, 'trip')) {
		elgg_register_menu_item('page', array(
			'name' => 'mytrips:all',
			'text' => elgg_echo('mytrips:all'),
			'href' => 'mytrips/all',
		));

		$user = elgg_get_logged_in_user_entity();
		if ($user) {
			$url =  "mytrips/owner/$user->username";
			$item = new ElggMenuItem('mytrips:owned', elgg_echo('mytrips:owned'), $url);
			elgg_register_menu_item('page', $item);

			$url = "mytrips/member/$user->username";
			$item = new ElggMenuItem('mytrips:member', elgg_echo('mytrips:yours'), $url);
			elgg_register_menu_item('page', $item);

			$url = "mytrips/invitations/$user->username";
			$invitation_count = mytrips_get_invited_mytrips($user->getGUID(), false, array('count' => true));

			if ($invitation_count) {
				$text = elgg_echo('mytrips:invitations:pending', array($invitation_count));
			} else {
				$text = elgg_echo('mytrips:invitations');
			}

			$item = new ElggMenuItem('mytrips:user:invites', $text, $url);
			elgg_register_menu_item('page', $item);
		}
	}
}

/**
 * mytrips page handler
 *
 * URLs take the form of
 *  All mytrips:           mytrips/all
 *  User's owned mytrips:  mytrips/owner/<username>
 *  User's member mytrips: mytrips/member/<username>
 *  trip profile:        mytrips/profile/<guid>/<title>
 *  New trip:            mytrips/add/<guid>
 *  Edit trip:           mytrips/edit/<guid>
 *  trip invitations:    mytrips/invitations/<username>
 *  Invite to trip:      mytrips/invite/<guid>
 *  Membership requests:  mytrips/requests/<guid>
 *  trip activity:       mytrips/activity/<guid>
 *  trip members:        mytrips/members/<guid>
 *
 * @param array $page Array of url segments for routing
 * @return bool
 */
function mytrips_page_handler($page) 
{
	system_message("hola");

	elgg_load_library('elgg:mytrips');

	if (!isset($page[0])) {
		$page[0] = 'all';
	}

	elgg_push_breadcrumb(elgg_echo('mytrips'), "mytrips/all");

	switch ($page[0]) {
		case 'all':
			mytrips_handle_all_page();
			break;
		case 'search':
			mytrips_search_page();
			break;
		case 'owner':
			mytrips_handle_owned_page();
			break;
		case 'member':
			set_input('username', $page[1]);
			mytrips_handle_mine_page();
			break;
		case 'invitations':
			set_input('username', $page[1]);
			mytrips_handle_invitations_page();
			break;
		case 'add':
			system_message("en add 1");
			mytrips_handle_edit_page('add');
			break;
		case 'edit':
			mytrips_handle_edit_page('edit', $page[1]);
			break;
		case 'profile':
			mytrips_handle_profile_page($page[1]);
			break;
		case 'activity':
			mytrips_handle_activity_page($page[1]);
			break;
		case 'members':
			mytrips_handle_members_page($page[1]);
			break;
		case 'invite':
			mytrips_handle_invite_page($page[1]);
			break;
		case 'manageOrders':
			mytrips_handle_manageOrders_page($page[1]);
			break;
		case 'summaryPreOrder':
			mytrips_handle_summaryPreOrder_page($page[1]);
			break;
		case 'requests':
			mytrips_handle_requests_page($page[1]);
			break;
		default:
			return false;
	}
	return true;
}

/**
 * Handle trip icons.
 *
 * @param array $page
 * @return bool
 */
function mytrips_icon_handler($page) {

	// The username should be the file we're getting
	if (isset($page[0])) {
		set_input('trip_guid', $page[0]);
	}
	if (isset($page[1])) {
		set_input('size', $page[1]);
	}
	// Include the standard profile index
	$plugin_dir = elgg_get_plugins_path();
	include("$plugin_dir/mytrips/icon.php");
	return true;
}

/**
 * Populates the ->getUrl() method for trip objects
 *
 * @param string $hook
 * @param string $type
 * @param string $url
 * @param array  $params
 * @return string
 */
function mytrips_set_url($hook, $type, $url, $params) {
	$entity = $params['entity'];
	$title = elgg_get_friendly_title($entity->name);
	return "mytrips/profile/{$entity->guid}/$title";
}

/**
 * Override the default entity icon for mytrips
 *
 * @param string $hook
 * @param string $type
 * @param string $url
 * @param array  $params
 * @return string Relative URL
 */
function mytrips_set_icon_url($hook, $type, $url, $params) 
{
	$trip = $params['entity'];
	$size = $params['size'];

	$icontime = $trip->icontime;
	// handle missing metadata (pre 1.7 installations)
	if (null === $icontime) {
		$file = new ElggFile();
		$file->owner_guid = $trip->owner_guid;
		$file->setFilename("mytrips/" . $trip->guid . "large.jpg");
		$icontime = $file->exists() ? time() : 0;
		create_metadata($trip->guid, 'icontime', $icontime, 'integer', $trip->owner_guid, ACCESS_PUBLIC);
	}
	if ($icontime) {
		// return thumbnail
		return "tripicon/$trip->guid/$size/$icontime.jpg";
	}

	return "mod/mytrips/graphics/default{$size}.gif";
}

/**
 * Add owner block link
 */
function mytrips_activity_owner_block_menu($hook, $type, $return, $params) {
	if (elgg_instanceof($params['entity'], 'trip')) {
		if ($params['entity']->activity_enable != "no") {
			$url = "mytrips/activity/{$params['entity']->guid}";
			$item = new ElggMenuItem('activity', elgg_echo('mytrips:activity'), $url);
			$return[] = $item;
		}
	}

	return $return;
}

/**
 * Add links/info to entity menu particular to trip entities
 */
function mytrips_entity_menu_setup($hook, $type, $return, $params) {
	if (elgg_in_context('widgets')) {
		return $return;
	}

	/* @var trip $entity */
	$entity = $params['entity'];
	$handler = elgg_extract('handler', $params, false);
	if ($handler != 'mytrips') {
		return $return;
	}

	/* @var ElggMenuItem $item */
	foreach ($return as $index => $item) {
		if (in_array($item->getName(), array('access', 'likes', 'unlike', 'edit', 'delete'))) {
			unset($return[$index]);
		}
	}

	// membership type
	if ($entity->isPublicMembership()) {
		$mem = elgg_echo("mytrips:open");
	} else {
		$mem = elgg_echo("mytrips:closed");
	}

	$options = array(
		'name' => 'membership',
		'text' => $mem,
		'href' => false,
		'priority' => 100,
	);
	$return[] = ElggMenuItem::factory($options);

	// number of members
	$num_members = $entity->getMembers(array('count' => true));
	$members_string = elgg_echo('mytrips:member');
	$options = array(
		'name' => 'members',
		'text' => ($num_members-1) . ' ' . $members_string,
		'href' => false,
		'priority' => 200,
	);
	$return[] = ElggMenuItem::factory($options);

	// feature link
	if (elgg_is_admin_logged_in()) {
		$isFeatured = $entity->featured_trip == "yes";

		$return[] = ElggMenuItem::factory(array(
			'name' => 'feature',
			'text' => elgg_echo("mytrips:makefeatured"),
			'href' => elgg_add_action_tokens_to_url("action/mytrips/featured?trip_guid={$entity->guid}&action_type=feature"),
			'priority' => 300,
			'item_class' => $isFeatured ? 'hidden' : '',
		));

		$return[] = ElggMenuItem::factory(array(
			'name' => 'unfeature',
			'text' => elgg_echo("mytrips:makeunfeatured"),
			'href' => elgg_add_action_tokens_to_url("action/mytrips/featured?trip_guid={$entity->guid}&action_type=unfeature"),
			'priority' => 300,
			'item_class' => $isFeatured ? '' : 'hidden',
		));
	}

	return $return;
}

/**
 * Add a remove user link to user hover menu when the page owner is a trip
 */
function mytrips_user_entity_menu_setup($hook, $type, $return, $params) 
{	
	if (elgg_is_logged_in()) {
		$trip = elgg_get_page_owner_entity();

		// Check for valid trip
		if (!elgg_instanceof($trip, 'trip')) {
			return $return;
		}

		$entity = $params['entity'];

		// Make sure we have a user and that user is a member of the trip
		if (!elgg_instanceof($entity, 'user') || !$trip->isMember($entity)) {
			return $return;
		}

		// Add remove link if we can edit the trip, and if we're not trying to remove the trip owner
		if ($trip->canEdit() && $trip->getOwnerGUID() != $entity->guid) {
			$remove = elgg_view('output/url', array(
				'href' => "action/mytrips/remove?user_guid={$entity->guid}&trip_guid={$trip->guid}",
				'text' => elgg_echo('mytrips:removeuser'),
				'confirm' => true,
			));

			$options = array(
				'name' => 'removeuser',
				'text' => $remove,
				'priority' => 999,
			);
			$return[] = ElggMenuItem::factory($options);
		}
	}

	return $return;
}

/**
 * mytrips created so create an access list for it
 */
function mytrips_create_event_listener($event, $object_type, $object) {
	$ac_name = elgg_echo('mytrips:trip') . ": " . $object->name;
	$ac_id = create_access_collection($ac_name, $object->guid);
	if ($ac_id) {
		$object->trip_acl = $ac_id;
	} else {
		// delete trip if access creation fails
		return false;
	}

	return true;
}

/**
 * Return the write access for the current trip if the user has write access to it.
 */
function mytrips_write_acl_plugin_hook($hook, $entity_type, $returnvalue, $params) {

	$user_guid = sanitise_int(elgg_extract('user_id', $params), false);
	$user = get_user($user_guid);
	if (empty($user)) {
		return $returnvalue;
	}

	$page_owner = elgg_get_page_owner_entity();
	if (!($page_owner instanceof trip)) {
		return $returnvalue;
	}

	if (!$page_owner->canWriteToContainer($user_guid)) {
		return $returnvalue;
	}

	// check trip content access rules
	$allowed_access = array(
		ACCESS_PRIVATE
	);

	if ($page_owner->getContentAccessMode() !== ElggGroup::CONTENT_ACCESS_MODE_MEMBERS_ONLY) {
		$allowed_access[] = ACCESS_LOGGED_IN;
		$allowed_access[] = ACCESS_PUBLIC;
	}

	foreach ($returnvalue as $access_id => $access_string) {
		if (!in_array($access_id, $allowed_access)) {
			unset($returnvalue[$access_id]);
		}
	}

	// add write access to the trip
	$returnvalue[$page_owner->trip_acl] = elgg_echo('mytrips:acl', array($page_owner->name));

	return $returnvalue;
}

/**
 * Listens to a trip join event and adds a user to the trip's access control
 *
 */
function mytrips_user_join_event_listener($event, $object_type, $object) {

	$trip = $object['trip'];
	$user = $object['user'];
	$acl = $trip->trip_acl;

	add_user_to_access_collection($user->guid, $acl);

	return true;
}

/**
 * Make sure users are added to the access collection
 */
function mytrips_access_collection_override($hook, $entity_type, $returnvalue, $params) {
	if (isset($params['collection'])) {
		if (elgg_instanceof(get_entity($params['collection']->owner_guid), 'trip')) {
			return true;
		}
	}
}

/**
 * Listens to a trip leave event and removes a user from the trip's access control
 *
 */
function mytrips_user_leave_event_listener($event, $object_type, $object) {

	$trip = $object['trip'];
	$user = $object['user'];
	$acl = $trip->trip_acl;

	remove_user_from_access_collection($user->guid, $acl);

	return true;
}

/**
 * The default access for members only content is this trip only. This makes
 * for better display of access (can tell it is trip only), but does not change
 * access to the content.
 *
 * @param string $hook   Hook name
 * @param string $type   Hook type
 * @param int    $access Current default access
 * @return int
 */
function mytrips_access_default_override($hook, $type, $access) {
	$page_owner = elgg_get_page_owner_entity();

	if (elgg_instanceof($page_owner, 'trip')) {
		if ($page_owner->getContentAccessMode() == ElggGroup::CONTENT_ACCESS_MODE_MEMBERS_ONLY) {
			$access = $page_owner->trip_acl;
		}
	}

	return $access;
}

/**
 * Grabs mytrips by invitations
 * Have to override all access until there's a way override access to getter functions.
 *
 * @param int   $user_guid    The user's guid
 * @param bool  $return_guids Return guids rather than trip objects
 * @param array $options      Additional options
 *
 * @return mixed Elggmytrips or guids depending on $return_guids, or count
 */
function mytrips_get_invited_mytrips($user_guid, $return_guids = false, $options = array()) {

	$ia = elgg_set_ignore_access(true);

	$defaults = array(
		'relationship' => 'invited',
		'relationship_guid' => (int) $user_guid,
		'inverse_relationship' => true,
		'limit' => 0,
	);

	$options = array_merge($defaults, $options);
	$mytrips = elgg_get_entities_from_relationship($options);

	elgg_set_ignore_access($ia);

	if ($return_guids) {
		$guids = array();
		foreach ($mytrips as $trip) {
			$guids[] = $trip->getGUID();
		}

		return $guids;
	}

	return $mytrips;
}

/**
 * Join a user to a trip, add river event, clean-up invitations
 *
 * @param trip $trip
 * @param ElggUser  $user
 * @return bool
 */
function mytrips_join_trip($trip, $user) {

	// access ignore so user can be added to access collection of invisible trip
	$ia = elgg_set_ignore_access(TRUE);
	$result = $trip->join($user);
	elgg_set_ignore_access($ia);

	if ($result) {
		// flush user's access info so the collection is added
		get_access_list($user->guid, 0, true);

		// Remove any invite or join request flags
		remove_entity_relationship($trip->guid, 'invited', $user->guid);
		remove_entity_relationship($user->guid, 'membership_request', $trip->guid);

		elgg_create_river_item(array(
			'view' => 'river/relationship/member/create',
			'action_type' => 'join',
			'subject_guid' => $user->guid,
			'object_guid' => $trip->guid,
		));

		return true;
	}

	return false;
}

/**
 * Function to use on mytrips for access. It will house private, loggedin, public,
 * and the trip itself. This is when you don't want other mytrips or access lists
 * in the access options available.
 *
 * @return array
 */
function trip_access_options($trip) {
	$access_array = array(
		ACCESS_PRIVATE => 'private',
		ACCESS_LOGGED_IN => 'logged in users',
		ACCESS_PUBLIC => 'public',
		$trip->trip_acl => elgg_echo('mytrips:acl', array($trip->name)),
	);
	return $access_array;
}

function activity_profile_menu($hook, $entity_type, $return_value, $params) {

	if ($params['owner'] instanceof trip) {
		$return_value[] = array(
			'text' => elgg_echo('mytrips:activity'),
			'href' => "mytrips/activity/{$params['owner']->getGUID()}"
		);
	}
	return $return_value;
}

/**
 * Parse ECML on trip discussion views
 */
function mytrips_ecml_views_hook($hook, $entity_type, $return_value, $params) {
	$return_value['forum/viewposts'] = elgg_echo('mytrips:ecml:discussion');

	return $return_value;
}

/**
 * Parse ECML on trip profiles
 */
function tripprofile_ecml_views_hook($hook, $entity_type, $return_value, $params) {
	$return_value['mytrips/tripprofile'] = elgg_echo('mytrips:ecml:tripprofile');

	return $return_value;
}



/**
 * Discussion
 *
 */

elgg_register_event_handler('init', 'system', 'discussion_init');

/**
 * Initialize the discussion component
 */
function discussion_init() {

	elgg_register_library('elgg:discussion', elgg_get_plugins_path() . 'mytrips/lib/discussion.php');

	elgg_register_page_handler('discussion', 'discussion_page_handler');

	elgg_register_plugin_hook_handler('entity:url', 'object', 'discussion_set_topic_url');

	// commenting not allowed on discussion topics (use a different annotation)
	elgg_register_plugin_hook_handler('permissions_check:comment', 'object', 'discussion_comment_override');
	elgg_register_plugin_hook_handler('permissions_check', 'object', 'discussion_can_edit_reply');

	// discussion reply menu
	elgg_register_plugin_hook_handler('register', 'menu:entity', 'discussion_reply_menu_setup');

	// allow non-owners to add replies to trip discussion
	elgg_register_plugin_hook_handler('container_permissions_check', 'object', 'discussion_reply_container_permissions_override');

	elgg_register_event_handler('update:after', 'object', 'discussion_update_reply_access_ids');

	$action_base = elgg_get_plugins_path() . 'mytrips/actions/discussion';
	elgg_register_action('discussion/save', "$action_base/save.php");
	elgg_register_action('discussion/delete', "$action_base/delete.php");
	elgg_register_action('discussion/reply/save', "$action_base/reply/save.php");
	elgg_register_action('discussion/reply/delete', "$action_base/reply/delete.php");

	// add link to owner block
	elgg_register_plugin_hook_handler('register', 'menu:owner_block', 'discussion_owner_block_menu');

	// Register for search.
	elgg_register_entity_type('object', 'tripforumtopic');
	elgg_register_plugin_hook_handler('search', 'object:tripforumtopic', 'discussion_search_tripforumtopic');

	// because replies are not comments, need of our menu item
	elgg_register_plugin_hook_handler('register', 'menu:river', 'discussion_add_to_river_menu');

	// add the forum tool option
	add_group_tool_option('forum', elgg_echo('mytrips:enableforum'), true);
	elgg_extend_view('mytrips/tool_latest', 'discussion/trip_module');

	$discussion_js_path = elgg_get_site_url() . 'mod/mytrips/views/default/js/discussion/';
	elgg_register_js('elgg.discussion', $discussion_js_path . 'discussion.js');

	elgg_register_ajax_view('ajax/discussion/reply/edit');

	// notifications
	elgg_register_plugin_hook_handler('get', 'subscriptions', 'discussion_get_subscriptions');
	elgg_register_notification_event('object', 'tripforumtopic');
	elgg_register_plugin_hook_handler('prepare', 'notification:create:object:tripforumtopic', 'discussion_prepare_notification');
	elgg_register_notification_event('object', 'discussion_reply');
	elgg_register_plugin_hook_handler('prepare', 'notification:create:object:discussion_reply', 'discussion_prepare_reply_notification');
}

/**
 * Discussion page handler
 *
 * URLs take the form of
 *  All topics in site:    discussion/all
 *  List topics in forum:  discussion/owner/<guid>
 *  View discussion topic: discussion/view/<guid>
 *  Add discussion topic:  discussion/add/<guid>
 *  Edit discussion topic: discussion/edit/<guid>
 *
 * @param array $page Array of url segments for routing
 * @return bool
 */
function discussion_page_handler($page) {

	elgg_load_library('elgg:discussion');

	if (!isset($page[0])) {
		$page[0] = 'all';
	}

	elgg_push_breadcrumb(elgg_echo('discussion'), 'discussion/all');

	switch ($page[0]) {
		case 'all':
			discussion_handle_all_page();
			break;
		case 'owner':
			discussion_handle_list_page(elgg_extract(1, $page));
			break;
		case 'add':
			discussion_handle_edit_page('add', elgg_extract(1, $page));
			break;
		case 'reply':
			switch (elgg_extract(1, $page)) {
				case 'edit':
					discussion_handle_reply_edit_page('edit', elgg_extract(2, $page));
					break;
				case 'view':
					discussion_redirect_to_reply(elgg_extract(2, $page), elgg_extract(3, $page));
					break;
				default:
					return false;
			}
			break;
		case 'edit':
			discussion_handle_edit_page('edit', elgg_extract(1, $page));
			break;
		case 'view':
			discussion_handle_view_page(elgg_extract(1, $page));
			break;
		default:
			return false;
	}
	return true;
}

/**
 * Redirect to the reply in context of the containing topic
 *
 * @param int $reply_guid    GUID of the reply
 * @param int $fallback_guid GUID of the topic
 *
 * @return void
 * @access private
 */
function discussion_redirect_to_reply($reply_guid, $fallback_guid) {
	$fail = function () {
		register_error(elgg_echo('discussion:reply:error:notfound'));
		forward(REFERER);
	};

	$reply = get_entity($reply_guid);
	if (!$reply) {
		// try fallback
		$fallback = get_entity($fallback_guid);
		if (!elgg_instanceof($fallback, 'object', 'tripforumtopic')) {
			$fail();
		}

		register_error(elgg_echo('discussion:reply:error:notfound_fallback'));
		forward($fallback->getURL());
	}

	if (!$reply instanceof ElggDiscussionReply) {
		$fail();
	}

	// start with topic URL
	$topic = $reply->getContainerEntity();

	// this won't work with threaded comments, but core doesn't support that yet
	$count = elgg_get_entities([
		'type' => 'object',
		'subtype' => $reply->getSubtype(),
		'container_guid' => $topic->guid,
		'count' => true,
		'wheres' => ["e.guid < " . (int)$reply->guid],
	]);
	$limit = (int)get_input('limit', 0);
	if (!$limit) {
		$limit = _elgg_services()->config->get('default_limit');
	}
	$offset = floor($count / $limit) * $limit;
	if (!$offset) {
		$offset = null;
	}

	$url = elgg_http_add_url_query_elements($topic->getURL(), [
			'offset' => $offset,
		]) . "#elgg-object-{$reply->guid}";

	forward($url);
}

/**
 * Override the url for discussion topics and replies
 *
 * Discussion replies do not have their own page so their url is
 * the same as the topic url.
 *
 * @param string $hook
 * @param string $type
 * @param string $url
 * @param array  $params
 * @return string
 */
function discussion_set_topic_url($hook, $type, $url, $params) {
	$entity = $params['entity'];

	if (!$entity instanceof ElggObject) {
		return;
	}

	if ($entity->getSubtype() === 'tripforumtopic') {
		$title = elgg_get_friendly_title($entity->title);
		return "discussion/view/{$entity->guid}/{$title}";
	}

	if (!$entity instanceof ElggDiscussionReply) {
		return;
	}

	$topic = $entity->getContainerEntity();

	return "discussion/reply/view/{$entity->guid}/{$topic->guid}";
}

/**
 * We don't want people commenting on topics in the river
 *
 * @param string $hook
 * @param string $type
 * @param string $return
 * @param array  $params
 * @return bool
 */
function discussion_comment_override($hook, $type, $return, $params) {
	if (elgg_instanceof($params['entity'], 'object', 'tripforumtopic')) {
		return false;
	}
}

/**
 * Add owner block link
 *
 * @param string          $hook    'register'
 * @param string          $type    'menu:owner_block'
 * @param ElggMenuItem[]  $return
 * @param array           $params
 * @return ElggMenuItem[]  $return
 */
function discussion_owner_block_menu($hook, $type, $return, $params) {
	if (elgg_instanceof($params['entity'], 'trip')) {
		if ($params['entity']->forum_enable != "no") {
			$url = "discussion/owner/{$params['entity']->guid}";
			$item = new ElggMenuItem('discussion', elgg_echo('discussion:trip'), $url);
			$return[] = $item;
		}
	}

	return $return;
}

/**
 * Set up menu items for river items
 *
 * Add reply button for discussion topic. Remove the possibility
 * to comment on a discussion reply.
 *
 * @param string         $hook   'register'
 * @param string         $type   'menu:river'
 * @param ElggMenuItem[] $return
 * @param array          $params
 * @return ElggMenuItem[] $return
 */
function discussion_add_to_river_menu($hook, $type, $return, $params) {
	if (!elgg_is_logged_in() || elgg_in_context('widgets')) {
		return $return;
	}

	$item = $params['item'];
	$object = $item->getObjectEntity();

	if (elgg_instanceof($object, 'object', 'tripforumtopic')) {
		$trip = $object->getContainerEntity();

		if ($trip && ($trip->canWriteToContainer() || elgg_is_admin_logged_in())) {
				$options = array(
				'name' => 'reply',
				'href' => "#discussion-reply-{$object->guid}",
				'text' => elgg_view_icon('speech-bubble'),
				'title' => elgg_echo('reply:this'),
				'rel' => 'toggle',
				'priority' => 50,
			);
			$return[] = ElggMenuItem::factory($options);
		}
	} else {
		if (elgg_instanceof($object, 'object', 'discussion_reply', 'ElggDiscussionReply')) {
			// trip discussion replies cannot be commented
			foreach ($return as $key => $item) {
				if ($item->getName() === 'comment') {
					unset($return[$key]);
				}
			}
		}
	}

	return $return;
}

/**
 * Prepare a notification message about a new discussion topic
 *
 * @param string                          $hook         Hook name
 * @param string                          $type         Hook type
 * @param Elgg\Notifications\Notification $notification The notification to prepare
 * @param array                           $params       Hook parameters
 * @return Elgg\Notifications\Notification
 */
function discussion_prepare_notification($hook, $type, $notification, $params) {
	$entity = $params['event']->getObject();
	$owner = $params['event']->getActor();
	$recipient = $params['recipient'];
	$language = $params['language'];
	$method = $params['method'];

	$descr = $entity->description;
	$title = $entity->title;
	$trip = $entity->getContainerEntity();

	$notification->subject = elgg_echo('discussion:topic:notify:subject', array($title), $language);
	$notification->body = elgg_echo('discussion:topic:notify:body', array(
		$owner->name,
		$trip->name,
		$title,
		$descr,
		$entity->getURL()
	), $language);
	$notification->summary = elgg_echo('discussion:topic:notify:summary', array($entity->title), $language);

	return $notification;
}

/**
 * Prepare a notification message about a new discussion reply
 *
 * @param string                          $hook         Hook name
 * @param string                          $type         Hook type
 * @param Elgg\Notifications\Notification $notification The notification to prepare
 * @param array                           $params       Hook parameters
 * @return Elgg\Notifications\Notification
 */
function discussion_prepare_reply_notification($hook, $type, $notification, $params) {
	$reply = $params['event']->getObject();
	$topic = $reply->getContainerEntity();
	$poster = $reply->getOwnerEntity();
	$trip = $topic->getContainerEntity();
	$language = elgg_extract('language', $params);

	$notification->subject = elgg_echo('discussion:reply:notify:subject', array($topic->title), $language);
	$notification->body = elgg_echo('discussion:reply:notify:body', array(
		$poster->name,
		$topic->title,
		$trip->name,
		$reply->description,
		$reply->getURL(),
	), $language);
	$notification->summary = elgg_echo('discussion:reply:notify:summary', array($topic->title), $language);

	return $notification;
}

/**
 * Get subscriptions for trip notifications
 *
 * @param string $hook          'get'
 * @param string $type          'subscriptions'
 * @param array  $subscriptions Array containing subscriptions in the form
 *                       <user guid> => array('email', 'site', etc.)
 * @param array  $params        Hook parameters
 * @return array
 */
function discussion_get_subscriptions($hook, $type, $subscriptions, $params) {
	$reply = $params['event']->getObject();

	if (!elgg_instanceof($reply, 'object', 'discussion_reply', 'ElggDiscussionReply')) {
		return $subscriptions;
	}

	$trip_guid = $reply->getContainerEntity()->container_guid;
	$trip_subscribers = elgg_get_subscriptions_for_container($trip_guid);

	return ($subscriptions + $trip_subscribers);
}

/**
 * A simple function to see who can edit a trip discussion post
 *
 * @param ElggComment $entity      the  comment $entity
 * @param ELggUser    $trip_owner user who owns the trip $trip_owner
 * @return boolean
 */
function mytrips_can_edit_discussion($entity, $trip_owner) {

	//logged in user
	$user = elgg_get_logged_in_user_guid();

	if (($entity->owner_guid == $user) || $trip_owner == $user || elgg_is_admin_logged_in()) {
		return true;
	} else {
		return false;
	}
}


/**
 * Allow trip owner and discussion owner to edit discussion replies.
 *
 * @param string  $hook   'permissions_check'
 * @param string  $type   'object'
 * @param boolean $return
 * @param array   $params Array('entity' => ElggEntity, 'user' => ElggUser)
 * @return boolean True if user is discussion or trip owner
 */
function discussion_can_edit_reply($hook, $type, $return, $params) {
	/** @var $reply ElggEntity */
	$reply = $params['entity'];
	$user = $params['user'];

	if (!elgg_instanceof($reply, 'object', 'discussion_reply', 'ElggDiscussionReply')) {
		return $return;
	}

	if ($reply->owner_guid == $user->guid) {
	    return true;
	}

	$discussion = $reply->getContainerEntity();
	if ($discussion->owner_guid == $user->guid) {
		return true;
	}

	$trip = $discussion->getContainerEntity();
	if (elgg_instanceof($trip, 'trip') && $trip->owner_guid == $user->guid) {
		return true;
	}

	return false;
}

/**
 * Allow trip members to post to a trip discussion
 *
 * @param string $hook   'container_permissions_check'
 * @param string $type   'object'
 * @param array  $return
 * @param array  $params Array with container, user and subtype
 * @return boolean $return
 */
function discussion_reply_container_permissions_override($hook, $type, $return, $params) {
	/** @var $container ElggEntity */
	$container = $params['container'];
	$user = $params['user'];

	if (elgg_instanceof($container, 'object', 'tripforumtopic')) {
		$trip = $container->getContainerEntity();

		if ($trip->canWriteToContainer($user->guid) && $params['subtype'] === 'discussion_reply') {
			return true;
		}
	}

	return $return;
}

/**
 * Update access_id of discussion replies when topic access_id is updated.
 *
 * @param string     $event  'update'
 * @param string     $type   'object'
 * @param ElggObject $object ElggObject
 */
function discussion_update_reply_access_ids($event, $type, $object) {
	if (elgg_instanceof($object, 'object', 'tripforumtopic')) {
		$ia = elgg_set_ignore_access(true);
		$options = array(
			'type' => 'object',
			'subtype' => 'discussion_reply',
			'container_guid' => $object->getGUID(),
			'limit' => 0,
		);
		$batch = new ElggBatch('elgg_get_entities', $options);
		foreach ($batch as $reply) {
			if ($reply->access_id == $object->access_id) {
				// Assume access_id of the replies is up-to-date
				break;
			}

			// Update reply access_id
			$reply->access_id = $object->access_id;
			$reply->save();
		}

		elgg_set_ignore_access($ia);
	}
}

/**
 * Set up discussion reply entity menu
 *
 * @param string          $hook   'register'
 * @param string          $type   'menu:entity'
 * @param ElggMenuItem[]  $return
 * @param array           $params
 * @return ElggMenuItem[] $return
 */
function discussion_reply_menu_setup($hook, $type, $return, $params) {
	/** @var $reply ElggEntity */
	$reply = elgg_extract('entity', $params);

	if (empty($reply) || !elgg_instanceof($reply, 'object', 'discussion_reply')) {
		return $return;
	}

	if (!elgg_is_logged_in()) {
		return $return;
	}

	if (elgg_in_context('widgets')) {
		return $return;
	}

	// Reply has the same access as the topic so no need to view it
	$remove = array('access');

	$user = elgg_get_logged_in_user_entity();

	// Allow discussion topic owner, trip owner and admins to edit and delete
	if ($reply->canEdit() && !elgg_in_context('activity')) {
		$return[] = ElggMenuItem::factory(array(
			'name' => 'edit',
			'text' => elgg_echo('edit'),
			'href' => "discussion/reply/edit/{$reply->guid}",
			'priority' => 150,
		));

		$return[] = ElggMenuItem::factory(array(
			'name' => 'delete',
			'text' => elgg_view_icon('delete'),
			'href' => "action/discussion/reply/delete?guid={$reply->guid}",
			'priority' => 150,
			'is_action' => true,
			'confirm' => elgg_echo('deleteconfirm'),
		));
	} else {
		// Edit and delete links can be removed from all other users
		$remove[] = 'edit';
		$remove[] = 'delete';
	}

	// Remove unneeded menu items
	foreach ($return as $key => $item) {
		if (in_array($item->getName(), $remove)) {
			unset($return[$key]);
		}
	}

	return $return;
}


/**
 * Search in both forumtopics and topic replies
 *
 * @param string $hook   the name of the hook
 * @param string $type   the type of the hook
 * @param mixed  $value  the current return value
 * @param array  $params supplied params
 */
function discussion_search_tripforumtopic($hook, $type, $value, $params) {

	if (empty($params) || !is_array($params)) {
		return $value;
	}

	$subtype = elgg_extract("subtype", $params);
	if (empty($subtype) || ($subtype !== "tripforumtopic")) {
		return $value;
	}

	unset($params["subtype"]);
	$params["subtypes"] = array("tripforumtopic", "discussion_reply");

	// trigger the 'normal' object search as it can handle the added options
	return elgg_trigger_plugin_hook('search', 'object', $params, array());
}

/**
 * Setup invitation request actions
 *
 * @param string $hook   "register"
 * @param string $type   "menu:invitationrequest"
 * @param array  $menu   Menu items
 * @param array  $params Hook params
 * @return array
 */
function mytrips_invitationrequest_menu_setup($hook, $type, $menu, $params) {

	$trip = elgg_extract('entity', $params);
	$user = elgg_extract('user', $params);

	if (!$trip instanceof \trip) {
		return $menu;
	}

	if (!$user instanceof \ElggUser || !$user->canEdit()) {
		return $menu;
	}

	$accept_url = elgg_http_add_url_query_elements('action/mytrips/join', array(
		'user_guid' => $user->guid,
		'trip_guid' => $trip->guid,
	));

	$menu[] = \ElggMenuItem::factory(array(
		'name' => 'accept',
		'href' => $accept_url,
		'is_action' => true,
		'text' => elgg_echo('accept'),
		'link_class' => 'elgg-button elgg-button-submit',
		'is_trusted' => true,
	));

	$delete_url = elgg_http_add_url_query_elements('action/mytrips/killinvitation', array(
		'user_guid' => $user->guid,
		'trip_guid' => $trip->guid,
	));

	$menu[] = \ElggMenuItem::factory(array(
		'name' => 'delete',
		'href' => $delete_url,
		'is_action' => true,
		'confirm' => elgg_echo('mytrips:invite:remove:check'),
		'text' => elgg_echo('delete'),
		'link_class' => 'elgg-button elgg-button-delete mlm',
	));

	return $menu;
}

