<?php
/**
 * Elgg mytrips plugin edit action.
 *
* 	Plugin: mytripsTeranga from previous version of @package ElggGroup
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

//system_message("action edit!");
elgg_make_sticky_form('mytrips');

/**
 * wrapper for recursive array walk decoding
 */
function profile_array_decoder(&$v) {
	$v = _elgg_html_decode($v);
}

// Get trip fields
$input = array();

foreach (elgg_get_config('trip') as $shortname => $valuetype) 
{
	$input[$shortname] = get_input($shortname);
	system_message($shortname . " action_edit_mytrips  " . $input[$shortname] ." --- " . $valuetype);

	// @todo treat profile fields as unescaped: don't filter, encode on output
	if (is_array($input[$shortname])) {
		array_walk_recursive($input[$shortname], 'profile_array_decoder');
	} else {
		$input[$shortname] = _elgg_html_decode($input[$shortname]);
	}

	if ($valuetype == 'tags') {
		$input[$shortname] = string_to_tag_array($input[$shortname]);
	}
}

$input['name'] = htmlspecialchars(get_input('name', '', false), ENT_QUOTES, 'UTF-8');
print_r($input);

$user = elgg_get_logged_in_user_entity();

$trip_guid = (int)get_input('trip_guid');
$is_new_trip = $trip_guid == 0;

if ($is_new_trip
		&& (elgg_get_plugin_setting('limited_mytrips', 'mytrips') == 'yes')
		&& !$user->isAdmin()) 
{
	register_error(elgg_echo("mytrips:cantcreate"));
	forward(REFERER);
}

if ($trip_guid !=0) 
{
	$trip = get_entity($trip_guid);
	system_message($trip_guid . " is already a trip_ ".$trip );
}
else
{
	$trip = new ElggGroup() ; // ElggObject does not work
	system_message($trip . " is new trip!");
}

			//featured by default
			$trip->featured_trip = "yes";		
			
			//Teranga metadata initilization
			if(!is_array($trip->follower))
			{
				$trip->follower = array('_','_');
			}
			if(!is_array($trip->preorder))
			{
				$trip->preorder = array('_','_');
			}
			if(!is_array($trip->confirmed))
			{
				$trip->confirmed = array('_','_');
			}
			if(!is_array($trip->grade))
			{
				$trip->grade = array('_','_');
			}
			if(!is_array($trip->summaryPreOrderUserGuid))
			{
				$trip->summaryPreOrderUserGuid = array('_','_');
			}
			if(!is_array($trip->summaryPreOrderTrayecto))
			{
				$trip->summaryPreOrderTrayecto = array('_','_');
			}
			if(!is_array($trip->summaryPreOrderBultos))
			{
				$trip->summaryPreOrderBultos = array('_','_');
			}
			if(!is_array($trip->summaryPreOrderConfirmed))
			{
				$trip->summaryPreOrderConfirmed = array('_','_');
			}
			//initialize variable to the given by the trip promoter
			$trip->bultosDisponibles=$trip->nbultos;


if (!$trip->canEdit() && ($trip instanceof ElggGroup)) 
//if (elgg_instanceof($trip, "trip") && !$trip->canEdit()) 
{
	register_error(elgg_echo("mytrips:cantedit"));
	forward(REFERER);
}

// Assume we can edit or this is a new trip
if (sizeof($input) > 0) 
{
	foreach($input as $shortname => $value) 
	{
		// update access collection name if trip name changes
		if (!$is_new_trip && $shortname == 'name' && $value != $trip->name) 
		{
			$trip_name = html_entity_decode($value, ENT_QUOTES, 'UTF-8');
			system_message("action edit trip name=".$trip_name);
			$ac_name = sanitize_string(elgg_echo('mytrips:trip') . ": " . $trip_name);
			$acl = get_access_collection($trip->trip_acl);
			if ($acl) 
			{
				// @todo Elgg api does not support updating access collection name
				$db_prefix = elgg_get_config('dbprefix');
				$query = "UPDATE {$db_prefix}access_collections SET name = '$ac_name'
					WHERE id = $trip->trip_acl";
				update_data($query);
			}
		}

		if ($value === '') 
		{
			// The trip profile displays all profile fields that have a value.
			// We don't want to display fields with empty string value, so we
			// remove the metadata completely.
			$trip->deleteMetadata($shortname);
			continue;
		}

		$trip->$shortname = $value;
	}
}else
    system_message("action_edit_input array empty!");

// Validate create
if (!$trip->name) {
	register_error(elgg_echo("mytrips:notitle"));
	forward(REFERER);
}


// Set trip tool options: trip_companions & forum
$tool_options = elgg_get_config('group_tool_options');
if ($tool_options) 
{
	foreach ($tool_options as $trip_option) 
	{
		$option_toggle_name = $trip_option->name . "_enable";
		$option_default = $trip_option->default_on ? 'yes' : 'no';
		$trip->$option_toggle_name = get_input($option_toggle_name, $option_default);
	}
}

// trip membership - should these be treated with same constants as access permissions?
$is_public_membership = (get_input('membership') == ACCESS_PUBLIC);
$trip->membership = $is_public_membership ? ACCESS_PUBLIC : ACCESS_PRIVATE;

$trip->setContentAccessMode(get_input('content_access_mode'));

if ($is_new_trip) {
	$trip->access_id = ACCESS_PUBLIC;
}

$old_owner_guid = $is_new_trip ? 0 : $trip->owner_guid;
$new_owner_guid = (int) get_input('owner_guid');

$owner_has_changed = false;
$old_icontime = null;
if (!$is_new_trip && $new_owner_guid && $new_owner_guid != $old_owner_guid) 
{
	// verify new owner is member and old owner/admin is logged in
	if ($trip->isMember(get_user($new_owner_guid)) && ($old_owner_guid == $user->guid || $user->isAdmin())) 
	{
		$trip->owner_guid = $new_owner_guid;
		if ($trip->container_guid == $old_owner_guid) 
		{
			// Even though this action defaults container_guid to the logged in user guid,
			// the trip may have initially been created with a custom script that assigned
			// a different container entity. We want to make sure we preserve the original
			// container if it the trip is not contained by the original owner.
			$trip->container_guid = $new_owner_guid;
		}

		$metadata = elgg_get_metadata(array(
			'guid' => $trip_guid,
			'limit' => false,
		));

		if ($metadata) 
		{
			foreach ($metadata as $md) {
				if ($md->owner_guid == $old_owner_guid) {
					$md->owner_guid = $new_owner_guid;
					$md->save();
				}
			}
		}

		// @todo Remove this when #4683 fixed
		$owner_has_changed = true;
		$old_icontime = $trip->icontime;
	}
}

$must_move_icons = ($owner_has_changed && $old_icontime);

if ($is_new_trip) 
{
	// if new trip, we need to save so trip acl gets set in event handler
	if (!$trip->save()) 
	{
		register_error(elgg_echo("mytrips:save_error"));
		forward(REFERER);
	} 
	else 
	{
		/* Foros generados automáticamente para cada trip are discussions*/
		$topic = new ElggObject();
		$topic->subtype = 'tripforumtopic';
		$topic->title = elgg_echo('mytrips:discussion:title1');
		$topic->description = elgg_echo('mytrips:discussion:description1');
		$topic->status = "open";
		$topic->access_id = "2";
		$topic->container_guid = $trip->guid;
		$resultDiscussion = $topic->save();
		elgg_create_river_item(array(
			'view' => 'river/object/tripforumtopic/create',
			'action_type' => 'create',
			'subject_guid' => elgg_get_logged_in_user_guid(),
			'object_guid' => $topic->guid,
		));
		
		$topic = new ElggObject();
		$topic->subtype = 'tripforumtopic';
		$topic->title = elgg_echo('mytrips:discussion:title2');
		$topic->description = elgg_echo('mytrips:discussion:description2');
		$topic->status = "open";
		$topic->access_id = "2";
		$topic->container_guid = $trip->guid;
		$resultDiscussion = $topic->save();
		elgg_create_river_item(array(
			'view' => 'river/object/tripforumtopic/create',
			'action_type' => 'create',
			'subject_guid' => elgg_get_logged_in_user_guid(),
			'object_guid' => $topic->guid,
		));


		if ($trip->servicioPaqueteria=="custom:rating:si")
		{
			$topic = new ElggObject();
			$topic->subtype = 'tripforumtopic';
			$topic->title = elgg_echo('mytrips:discussion:title3');
			$topic->description = elgg_echo('mytrips:discussion:description3');
			$topic->status = "open";
			$topic->access_id = "2";
			$topic->container_guid = $trip->guid;
			$resultDiscussion = $topic->save();
			elgg_create_river_item(array(
				'view' => 'river/object/tripforumtopic/create',
				'action_type' => 'create',
				'subject_guid' => elgg_get_logged_in_user_guid(),
				'object_guid' => $topic->guid,
			));	
		}
		
system_message("mytrip_URL_".$trip->getUrl());
		if (!$resultDiscussion) 
		{
			register_error(elgg_echo('discussion:error:notsaved')." | ".$resultDiscussion);
			forward(REFERER);
		}
	}
}

// Invisible trip support
// @todo this requires save to be called to create the acl for the trip. This
// is an odd requirement and should be removed. Either the acl creation happens
// in the action or the visibility moves to a plugin hook
if (elgg_get_plugin_setting('hidden_mytrips', 'mytrips') == 'yes') 
{
	$visibility = (int)get_input('vis');

	if ($visibility == ACCESS_PRIVATE) 
	{
		// Make this trip visible only to trip members. We need to use
		// ACCESS_PRIVATE on the form and convert it to trip_acl here
		// because new mytrips do not have acl until they have been saved once.
		$visibility = $trip->trip_acl;

		// Force all new trip content to be available only to members
		$trip->setContentAccessMode(ElggGroup::CONTENT_ACCESS_MODE_MEMBERS_ONLY);
	}

	$trip->access_id = $visibility;
}

if (!$trip->save()) {
	register_error(elgg_echo("mytrips:save_error"));
	forward(REFERER);
}

// trip saved so clear sticky form
elgg_clear_sticky_form('mytrips');

// trip creator needs to be member of new trip and river entry created
if ($is_new_trip) {

	// @todo this should not be necessary...
	elgg_set_page_owner_guid($trip->guid);

	$trip->join($user);
	elgg_create_river_item(array(
		'view' => 'river/trip/create',
		'action_type' => 'create',
		'subject_guid' => $user->guid,
		'object_guid' => $trip->guid,
	));
}

$has_uploaded_icon = (!empty($_FILES['icon']['type']) && substr_count($_FILES['icon']['type'], 'image/'));

if ($has_uploaded_icon) {

	$icon_sizes = elgg_get_config('icon_sizes');

	$prefix = "mytrips/" . $trip->guid;

	$filehandler = new ElggFile();
	$filehandler->owner_guid = $trip->owner_guid;
	$filehandler->setFilename($prefix . ".jpg");
	$filehandler->open("write");
	$filehandler->write(get_uploaded_file('icon'));
	$filehandler->close();
	$filename = $filehandler->getFilenameOnFilestore();

	$sizes = array('tiny', 'small', 'medium', 'large', 'master');

	$thumbs = array();
	foreach ($sizes as $size) {
		$thumbs[$size] = get_resized_image_from_existing_file(
			$filename,
			$icon_sizes[$size]['w'],
			$icon_sizes[$size]['h'],
			$icon_sizes[$size]['square']
		);
	}

	if ($thumbs['tiny']) { // just checking if resize successful
		$thumb = new ElggFile();
		$thumb->owner_guid = $trip->owner_guid;
		$thumb->setMimeType('image/jpeg');

		foreach ($sizes as $size) {
			$thumb->setFilename("{$prefix}{$size}.jpg");
			$thumb->open("write");
			$thumb->write($thumbs[$size]);
			$thumb->close();
		}

		$trip->icontime = time();
	}
}

// @todo Remove this when #4683 fixed
if ($must_move_icons) {
	$filehandler = new ElggFile();
	$filehandler->setFilename('mytrips');
	$filehandler->owner_guid = $old_owner_guid;
	$old_path = $filehandler->getFilenameOnFilestore();

	$sizes = array('', 'tiny', 'small', 'medium', 'large');

	if ($has_uploaded_icon) {
		// delete those under old owner
		foreach ($sizes as $size) {
			unlink("$old_path/{$trip_guid}{$size}.jpg");
		}
	} else {
		// move existing to new owner
		$filehandler->owner_guid = $trip->owner_guid;
		$new_path = $filehandler->getFilenameOnFilestore();

		foreach ($sizes as $size) {
			rename("$old_path/{$trip_guid}{$size}.jpg", "$new_path/{$trip_guid}{$size}.jpg");
		}
	}

	if ($owner_changed_flag && $old_icontime) { // @todo Remove this when #4683 fixed

		$filehandler = new ElggFile();
		$filehandler->setFilename('mytrips');

		$filehandler->owner_guid = $old_owner_guid;
		$old_path = $filehandler->getFilenameOnFilestore();

		$sizes = array('', 'tiny', 'small', 'medium', 'large');

		foreach($sizes as $size) {
			unlink("$old_path/{$trip_guid}{$size}.jpg");
		}
	}

} elseif ($owner_changed_flag && $old_icontime) { // @todo Remove this when #4683 fixed

	$filehandler = new ElggFile();
	$filehandler->setFilename('mytrips');

	$filehandler->owner_guid = $old_owner_guid;
	$old_path = $filehandler->getFilenameOnFilestore();

	$filehandler->owner_guid = $trip->owner_guid;
	$new_path = $filehandler->getFilenameOnFilestore();

	$sizes = array('', 'tiny', 'small', 'medium', 'large');

	foreach($sizes as $size) {
		rename("$old_path/{$trip_guid}{$size}.jpg", "$new_path/{$trip_guid}{$size}.jpg");
	}
}

system_message(elgg_echo("mytrips:saved"));

forward($trip->getUrl());
