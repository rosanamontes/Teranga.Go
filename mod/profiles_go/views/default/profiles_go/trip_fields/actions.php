<?php
/**
* Trip Fields actions
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

$header = '<h3>';
$header .= elgg_echo('profiles_go:actions:title');
$header .= elgg_format_element('span', ['class' => 'custom_fields_more_info', 'id' => 'more_info_actions']);
$header .= '</h3>';

$body = '<div class="pvm">';
$body .= elgg_view("output/url", array("text" => elgg_echo("reset"), "title" => elgg_echo("profiles_go:actions:reset:description"), "href" => "action/profiles_go/reset?type=trip", "confirm" => elgg_echo("profiles_go:actions:reset:confirm"), "class" => "elgg-button elgg-button-action"));
$body .= elgg_view("output/url", array("text" => elgg_echo("profiles_go:actions:import:from_default"), "title" => elgg_echo("profiles_go:actions:import:from_default:description"), "href" => "action/profiles_go/importFromDefault?type=trip", "confirm" => elgg_echo("profiles_go:actions:import:from_default:confirm"), "class" => "elgg-button elgg-button-action"));
$body .= elgg_view("output/url", array("title" => elgg_echo("profiles_go:actions:export:description"),"text" => elgg_echo("export"), "href" => "admin/mytrips/export", "class" => "elgg-button elgg-button-action"));
$body .= elgg_view("output/url", array("text" => elgg_echo("profiles_go:actions:configuration:backup"), "href" => "action/profiles_go/configuration/backup?fieldtype=" . CUSTOM_PROFILE_FIELDS_TRIP_SUBTYPE, "confirm" => elgg_echo("profiles_go:actions:configuration:backup:description"), "class" => "elgg-button elgg-button-action"));
$body .= elgg_view("output/url", array("text" => elgg_echo("profiles_go:actions:configuration:restore"), "onclick" => "$('#restoreForm').toggle();", "class" => "elgg-button elgg-button-action"));
		
$form_body = "<div class='mtm'>" . elgg_echo("profiles_go:actions:configuration:restore:description") . "</div>";
$form_body .= elgg_view("input/file", array("name" => "restoreFile"));
$form_body .= elgg_view("input/submit", array("value" => elgg_echo("profiles_go:actions:configuration:restore:upload")));

$body .= elgg_view("input/form", array("action" => "action/profiles_go/configuration/restore?fieldtype=" . CUSTOM_PROFILE_FIELDS_TRIP_SUBTYPE, "id" => "restoreForm", "body" => $form_body, "enctype" => "multipart/form-data", 'class' => 'hidden'));
$body .= '</div>';

$footer = elgg_format_element('div', ['class' => 'hidden', 'id' => 'text_more_info_actions'], elgg_echo("profiles_go:tooltips:actions"));

echo elgg_view_module('inline', null, $body, ['header' => $header, 'footer' => $footer]);
