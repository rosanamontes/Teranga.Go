<?php

/**
* 	Plugin: Valoraciones linguisticas con HFLTS
*	Author: Rosana Montes Soldado
*			Universidad de Granada
*	Licence: 	CC-ByNCSA
*	Reference:	Microproyecto CEI BioTIC Ref. 11-2015
* 	Project coordinator: @rosanamontes
*	Website: http://lsi.ugr.es/rosana
*	
*	File: testing
*/

// get the form inputs
$title = get_input('title');
$body = get_input('body');
$tags = string_to_tag_array(get_input('tags'));

// create a new agnaret_hflts object
$entry = new ElggObject();
$entry->subtype = "hflts";
$entry->title = $title;
$entry->description = $body;

// access_id possibilities
	//ACCESS_PRIVATE (value: 0) Private.
	//ACCESS_LOGGED_IN (value: 1) Logged in users.
	//ACCESS_PUBLIC (value: 2) Public data.
	//ACCESS_FRIENDS (value: -2) Owner and his/her friends.

$entry->access_id = ACCESS_PRIVATE;
// owner is logged in user
$entry->owner_guid = elgg_get_logged_in_user_guid();
// save tags as metadata
$entry->tags = $tags;
// save to database and get id of the new agnaret_hflts
$entry_guid = $entry->save();

// if the my_entry was saved, we want to display the new post
// otherwise, we want to register an error and forward back to the form
if ($entry_guid) {
	system_message(elgg_echo("hflts:msgOk"));
	forward($entry->getURL());
} else {
	register_error(elgg_echo("hflts:msgWrong"));
	forward(REFERER); // REFERER is a global variable that defines the previous page
}

?>
