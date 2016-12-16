<?php
/**
 * trip edit form
 *
* 	Plugin: myTripsTeranga from previous version of @package ElggGroup
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

$entity = elgg_extract("entity", $vars, false);//a trip

// context needed for input/access view
elgg_push_context("trip-edit");

// build the trip profile fields
echo elgg_view("myTrips/edit/profile", $vars);

// build the trip access options. In teranga only admins couls change the options
echo elgg_view("myTrips/edit/access", $vars);

// build the trip tools options. In teranga only admins couls change the options
echo elgg_view("myTrips/edit/tools", $vars);

// display the save button and some additional form data
?>
<div class="elgg-foot">
<?php

if ($entity) 
{
	echo elgg_view("input/hidden", array(
		"name" => "trip_guid",
		"value" => $entity->getGUID(),
	));
}

echo elgg_view("input/submit", array("value" => elgg_echo("save")));

if ($entity) 
{
	$delete_url = "action/myTrips/delete?guid=" . $entity->getGUID();
	echo elgg_view("output/url", array(
		"text" => elgg_echo("mytrips:delete"),
		"href" => $delete_url,
		"confirm" => elgg_echo("mytrips:deletewarning"),
		"class" => "elgg-button elgg-button-delete float-alt",
	));
}
elgg_pop_context();
?>
<input id="guidtrip" type="hidden" value="<?php 
if($entity->owner_guid!="") echo $entity->owner_guid;
else echo elgg_get_logged_in_user_entity()->guid;
 ?>" />
</div>