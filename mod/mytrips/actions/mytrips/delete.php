<?php
/**
 * Delete a trip
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

$guid = (int) get_input('guid');
if (!$guid) {
	// backward compatible
	elgg_deprecated_notice("Use 'guid' for trip delete action", 1.8);
	$guid = (int)get_input('trip_guid');
}
$entity = get_entity($guid);

if (!$entity->canEdit()) {
	register_error(elgg_echo('trip:notdeleted'));
	forward(REFERER);
}

if (($entity) && elgg_instanceof($entity, 'trip')) 
{
	// delete HFLTS assessments
	elgg_load_library('elgg:trip_companions');
	delete_trip_assessments($entity->guid);

	// delete trip icons
	$owner_guid = $entity->owner_guid;
	$prefix = "mytrips/" . $entity->guid;
	$imagenames = elgg_get_config('icon_sizes');
	$img = new ElggFile();
	$img->owner_guid = $owner_guid;
	foreach ($imagenames as $name => $value) {
		$img->setFilename("{$prefix}{$name}.jpg");
		$img->delete();
	}
	
	// delete original icon
	$img->setFilename("{$prefix}.jpg");
	$img->delete();

	// delete trip
	if ($entity->delete()) {
		system_message(elgg_echo('trip:deleted'));
	} else {
		register_error(elgg_echo('trip:notdeleted'));
	}
} else {
	register_error(elgg_echo('trip:notdeleted'));
}

$url_name = elgg_get_logged_in_user_entity()->username;
forward(elgg_get_site_url() . "mytrips/member/{$url_name}");
