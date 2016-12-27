<?php 
/**
 * Teranga Go! trip entity view
 * 
* 	Plugin: mytripsTeranga
*	Author: Rosana Montes Soldado from previous version of @package ElggGroups
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
*/
$group = $vars['entity'];

$icon = elgg_view_entity_icon($group, 'tiny', $vars);

$metadata = elgg_view_menu('entity', array(
	'entity' => $group,
	'handler' => 'mytrips',
	'sort_by' => 'priority',
	'class' => 'elgg-menu-hz',
));

if (elgg_in_context('owner_block') || elgg_in_context('widgets')) {
	$metadata = '';
}


if ($vars['full_view']) {
	echo elgg_view('mytrips/profile/summary', $vars);
} 
else 
{
	// brief view en la misma línea, o los listados se alargan demasiado
	$paththeme = elgg_get_site_url() . "mod/custom_index/graphics";
	$dots = "&nbsp;<img src='". $paththeme."/dots.png' width='5px'>&nbsp;" ;
	$trip_description = $group->briefdescription." ".elgg_echo('mytrips:fechaIda').": ".date("d / m / Y", strtotime($group->fechaIda));
		if(date("d / m / Y", strtotime($group->fechaVuelta))!="" && date("d / m / Y", strtotime($group->fechaVuelta))>="01/01/1970"){
				$trip_description.=$dots. elgg_echo('mytrips:fechaVuelta').": ".date("d / m / Y", strtotime($group->fechaVuelta)) ;
		}
		// elgg_echo('mytrips:fechaVuelta').": ".date("d / m / Y", strtotime($group->fechaVuelta)) ;
	
	if ($group->servicioPaqueteria == 'custom:rating:si')
		$trip_description .= $dots . elgg_echo('mytrips:servicioPaqueteria').": ".elgg_echo($group->servicioPaqueteria);

	$params = array(
		'entity' => $group,
		'metadata' => $metadata,
		'subtitle' => $trip_description
	);
	
	$params = $params + $vars;
	$list_body = elgg_view('group/elements/summary', $params);

	echo elgg_view_image_block($icon, $list_body, $vars);
}
