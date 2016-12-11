<?php
/**
* Object view of a custom profile field category
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

$entity = $vars["entity"];

// get title
$title = $entity->getTitle();
	
echo "<div class='custom_fields_category' id='custom_profile_field_category_" . $entity->guid . "'>";
echo elgg_view_icon("drag-arrow");

// filter link
echo elgg_view("output/url", array(
	"href" => "javascript:elgg.profiles_go.filter_custom_fields(" . $entity->guid . ")",
	"text" => $title
));

// edit link
echo elgg_view("output/url", array(
	"href" => "ajax/view/forms/profiles_go/category?guid=" . $entity->guid,
	"class" => "elgg-lightbox",
	"title" => elgg_echo("edit"),
	"text" => elgg_view_icon("settings-alt")
));

// delete link
echo elgg_view("output/url", array(
	"href" => "action/profiles_go/categories/delete?guid=" . $entity->guid,
	"title" => elgg_echo("delete"),
	"text" => elgg_view_icon("delete"),
	"confirm" => elgg_echo("profiles_go:categories:delete:confirm")
));

echo "</div>";
