<?php 
/**
 * trip entity view - brief text description
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

$trip = $vars['entity'];

$icon = elgg_view_entity_icon($trip, 'tiny', $vars);

$metadata = elgg_view_menu('entity', array(
	'entity' => $trip,
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
	$trip_description = $trip->briefdescription." ".elgg_echo('mytrips:fechaIda').": ".date("d / m / Y", strtotime($trip->fechaIda));
		if(date("d / m / Y", strtotime($trip->fechaVuelta))!="" && date("d / m / Y", strtotime($trip->fechaVuelta))>="01/01/1970"){
				$trip_description.=$dots. elgg_echo('mytrips:fechaVuelta').": ".date("d / m / Y", strtotime($trip->fechaVuelta)) ;
		}
		// elgg_echo('mytrips:fechaVuelta').": ".date("d / m / Y", strtotime($trip->fechaVuelta)) ;
	
	if ($trip->servicioPaqueteria == 'custom:rating:si')
		$trip_description .= $dots . elgg_echo('mytrips:servicioPaqueteria').": ".elgg_echo($trip->servicioPaqueteria);

	$params = array(
		'entity' => $trip,
		'metadata' => $metadata,
		'subtitle' => $trip_description
	);
	
	$params = $params + $vars;
	$list_body = elgg_view('trip/elements/summary', $params);

	echo elgg_view_image_block($icon, $list_body, $vars);
}
