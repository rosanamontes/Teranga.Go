<?php
/**
* Object view of a custom trip field
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

$handle = "<div onclick='$(\"#" . $vars['entity']->guid . "\").toggle();' class='custom_field_handle'></div>";

$title = "<div>";
$title .= "<b>" . $vars['entity']->metadata_name . "</b> [" . $vars['entity']->metadata_type . "]";
$title .= elgg_view("output/url", array(
	"href" => "ajax/view/forms/profiles_go/trip_field?guid=" . $vars['entity']->guid,
	"class" => "elgg-lightbox",
	"title" => elgg_echo("edit"),
	"text" => elgg_view_icon("settings-alt")
		
));
$title .= elgg_view("output/url", array(
	"href" => false,
	"onclick" => "elgg.profiles_go.remove_field(" . $vars['entity']->guid . ");",
	"title" => elgg_echo("delete"),
	"text" => elgg_view_icon("delete-alt")
));
$title .= "</div>";

$extra_info = "<div id='" . $vars['entity']->guid . "' class='hidden'>";

// label information
if (!empty($vars['entity']->metadata_label)) {
	$extra_info .= elgg_echo("profiles_go:admin:metadata_label") . ": " . $vars['entity']->metadata_label . "<br />";
} else {
	if (elgg_echo("profile:" . $vars['entity']->metadata_name) == "mytrips:" . $vars['entity']->metadata_name) {
		$extra_info .= elgg_echo("profiles_go:admin:metadata_label_untranslated") . ": <i>" . elgg_echo("mytrips:" . $vars['entity']->metadata_name) . "</i><br />";
	} else {
		$extra_info .= elgg_echo("profiles_go:admin:metadata_label_translated") . ": " . elgg_echo("mytrips:" . $vars['entity']->metadata_name) . "<br />";
	}
}

// options
if (!empty($vars['entity']->metadata_options)) {
	$extra_info .= elgg_echo("profiles_go:admin:metadata_options") . ": " . $vars['entity']->metadata_options . "<br />";
}

// Hint
if (!empty($vars['entity']->metadata_hint)) {
	$extra_info .= elgg_echo("profiles_go:admin:metadata_hint") . ": " . $vars['entity']->metadata_hint . "<br />";
}

$extra_info .= "</div>";
	
// set default display values
if (empty($vars['entity']->user_editable)) {
	$vars['entity']->user_editable = "yes";
}
if (empty($vars['entity']->output_as_tags)) {
	$vars['entity']->output_as_tags = "no";
}

$metadata = "<div class='float-alt'>";

// output_as_tags
$metadata .= elgg_view("profiles_go/toggle_metadata", array("entity" => $vars['entity'], "metadata_name" => "output_as_tags"));

// admin_only
$metadata .= elgg_view("profiles_go/toggle_metadata", array("entity" => $vars['entity'], "metadata_name" => "admin_only"));
	
$metadata .= "</div>";

$info = $handle . $metadata . $title . $extra_info;

echo "<div id='custom_profile_field_" . $vars['entity']->guid . "' class='custom_field' rel=''>"  . $info . "</div>";
	