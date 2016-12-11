<?php
/**
 * Run Once functions 
*
* 	Plugin: profiles_go from previous version of @package profile_manager of Coldtrick IT Solutions 2009
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
 * Fixes a bug in previous profile manager versions that made all fields on register have access_id -1 instead of default access
 *
 * @return void
 */
function profiles_go_fix_access_default() {
	$dbprefix = elgg_get_config("dbprefix");
	
	update_data("UPDATE {$dbprefix}metadata set access_id='" . ACCESS_LOGGED_IN . "' WHERE access_id=" . ACCESS_DEFAULT);
}

/**
 * Run once function
 *
 * @return void
 *
* 	Plugin: profiles_go from previous version of @package profile_manager of Coldtrick IT Solutions 2009
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

 
function profiles_go_run_once() {
	$dbprefix = elgg_get_config("dbprefix");
	
	// upgrade class names for subtypes
	$profile_field_class_name = "ProfileManagerCustomProfileField";
	$trip_field_class_name = "ProfileManagerCustomTripField";
	$field_type_class_name = "ProfileManagerCustomProfileType";
	$field_category_class_name = "ProfileManagerCustomFieldCategory";
	
	if ($id = get_subtype_id('object', ProfileManagerCustomProfileField::SUBTYPE)) {
		update_data("UPDATE {$dbprefix}entity_subtypes set class='$profile_field_class_name' WHERE id=$id");
	} else {
		add_subtype('object', ProfileManagerCustomProfileField::SUBTYPE, $profile_field_class_name);
	}
	
	if ($id = get_subtype_id('object', ProfileManagerCustomTripField::SUBTYPE)) {
		update_data("UPDATE {$dbprefix}entity_subtypes set class='$trip_field_class_name' WHERE id=$id");
	} else {
		add_subtype('object', ProfileManagerCustomGroupField::SUBTYPE, $trip_field_class_name);
	}
	
	if ($id = get_subtype_id('object', ProfileManagerCustomProfileType::SUBTYPE)) {
		update_data("UPDATE {$dbprefix}entity_subtypes set class='$field_type_class_name' WHERE id=$id");
	} else {
		add_subtype('object', ProfileManagerCustomProfileType::SUBTYPE, $field_type_class_name);
	}
	
	if ($id = get_subtype_id('object', ProfileManagerCustomFieldCategory::SUBTYPE)) {
		update_data("UPDATE {$dbprefix}entity_subtypes set class='$field_category_class_name' WHERE id=$id");
	} else {
		add_subtype('object', ProfileManagerCustomFieldCategory::SUBTYPE, $field_category_class_name);
	}
	
	// update ownerships of profile manager field configuration
	// owner should be site instead of a user (prevents problems when upgrading)
	// Added in Profile Manager v5.6
	
	$options = array(
			"type" => "object",
			"subtypes" => array(
					ProfileManagerCustomProfileField::SUBTYPE,
					ProfileManagerCustomTripField::SUBTYPE,
					ProfileManagerCustomProfileType::SUBTYPE,
					ProfileManagerCustomFieldCategory::SUBTYPE
				),
			"limit" => false
		);
	$entities = elgg_get_entities($options);
	foreach ($entities as $entity) {
		$entity->owner_guid = $entity->site_guid;
		$entity->container_guid = $entity->site_guid;
		$entity->save();
	}
}
