<?php
/**
* Object view of a custom profile field type
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
	
echo "<div class='custom_profile_type' id='custom_profile_type_" . $entity->guid . "'>";
echo $title;

// edit link
echo elgg_view("output/url", array(
	"href" => "ajax/view/forms/profiles_go/type?guid=" .  $entity->guid,
	"class" => "elgg-lightbox",
	"title" => elgg_echo("edit"),
	"text" => elgg_view_icon("settings-alt")
));

// delete link
echo elgg_view("output/url", array(
	"href" => "action/profiles_go/profile_types/delete?guid=" . $entity->guid,
	"title" => elgg_echo("delete"),
	"text" => elgg_view_icon("delete"),
	"confirm" => elgg_echo("profiles_go:profile_types:delete:confirm")
));

echo "</div>";
