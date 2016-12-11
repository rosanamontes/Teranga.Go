<?php

/*
 * Shows a selection dropdown for the profile types on the registration form
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
 

$value = elgg_extract('value', $vars);

$types_options = array(
	'type' => 'object',
	'subtype' => CUSTOM_PROFILE_FIELDS_PROFILE_TYPE_SUBTYPE,
	'limit' => false,
	'owner_guid' => elgg_get_site_entity()->getGUID()
);
$types = elgg_get_entities($types_options);

if (empty($types)) {
	return;
}

$types_options_values = [];
if (elgg_get_plugin_setting('hide_profile_type_default', 'profiles_go') !== 'yes') {
	$types_options_values[''] = elgg_echo('profiles_go:profile:edit:custom_profile_type:default');
}

// Generate type descriptions for all profile types
$types_description = '';
foreach ($types as $type) {
	$types_options_values[$type->guid] = $type->getTitle();
		
	// preparing descriptions of profile types
	$description = $type->getDescription();
		
	if (!empty($description)) {
		$description_class = ['custom_profile_type_description'];
		if ($value != $type->guid) {
			$description_class[] = 'hidden';
		}
		$types_description .= elgg_format_element('div', ['id' => $type->guid, 'class' => $description_class], $description);
	}
}

$result = elgg_format_element('label', [], elgg_echo('profiles_go:profile:edit:custom_profile_type:label'));
$result .='<br />';
$result .= elgg_view('input/dropdown', [
	'name' => 'custom_profile_fields_custom_profile_type',
	'id' => 'custom_profile_fields_custom_profile_type',
	'options_values' => $types_options_values,
	'onchange' => 'elgg.profiles_go.change_profile_type_register();',
	'value' => $value
]);

$result .= $types_description;

echo elgg_format_element('div', [], $result);
