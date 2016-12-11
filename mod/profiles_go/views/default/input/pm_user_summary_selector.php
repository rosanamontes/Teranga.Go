<?php
/*
* 	Plugin: profiles_go 
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


$value = elgg_extract("value", $vars);
unset($vars["value"]);

$spacers = array("new_line", "space", "dash","teranga_car", "teranga_asientos");

$field_selector = "<select " . elgg_format_attributes($vars) . " class='elgg-input-dropdown profile-manager-user-summary-config-options'>";

$field_selector .= "<option></option>";

$profile_fields = elgg_get_config("profile_fields");
if ($profile_fields) {
	$field_options = array();

	foreach ($profile_fields as $metadata_name => $type) {
		$label = $metadata_name;

		$translation_key = "profile:" . $metadata_name;
		$translated_label = elgg_echo($translation_key);

		if ($translated_label !== $translation_key) {
			$label = $translated_label;
		}
		$field_options[$metadata_name] = $label;
	}

	ksort($field_options);

	$field_selector .= "<opttrip label='" . elgg_echo("profiles_go:profile_fields:list:title") . "'>";
	foreach ($field_options as $name => $label) {
		$selected = "";
		if ($name == $value) {
			$selected = " selected='selected'";
		}
		$field_selector .= "<option value='" . $name . "'" . $selected . ">" . $label . "</option>";
	}
	$field_selector .= "</opttrip>";
}

$field_selector .= "<opttrip label='" . elgg_echo("profiles_go:user_summary_control:options:spacers") . "'>";
foreach ($spacers as $spacer) {
	$selected = "";
	if ("spacer_" . $spacer == $value) {
		$selected = " selected='selected'";
	}
	$field_selector .= "<option value='spacer_" . $spacer . "'" . $selected . ">" . elgg_echo("profiles_go:user_summary_control:options:spacers:" . $spacer) . "</option>";
}
$field_selector .= "</opttrip>";

$field_selector .= "<option class='profile-manager-user-summary-config-options-delete'>" . elgg_echo("delete") . "</option>";

$field_selector .= "</select>";

echo $field_selector;
