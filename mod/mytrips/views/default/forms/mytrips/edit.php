<?php
/**
 * Trip edit form
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

/* @var ElggGroup $entity */
$entity = elgg_extract("entity", $vars, false);

// context needed for input/access view
elgg_push_context("group-edit");

// build the group profile fields
echo elgg_view("mytrips/edit/profile", $vars);

// build the group access options. In teranga only admins couls change the options
echo elgg_view("mytrips/edit/access", $vars);

// build the group tools options. In teranga only admins couls change the options
echo elgg_view("mytrips/edit/tools", $vars);

// display the save button and some additional form data
?>
<div class="elgg-foot">
<?php

if ($entity) {
	echo elgg_view("input/hidden", array(
		"name" => "group_guid",
		"value" => $entity->getGUID(),
	));
}

echo elgg_view("input/submit", array("value" => elgg_echo("save")));

if ($entity) {
	$delete_url = "action/mytrips/delete?guid=" . $entity->getGUID();
	echo elgg_view("output/url", array(
		"text" => elgg_echo("mytrips:delete"),
		"href" => $delete_url,
		"confirm" => elgg_echo("mytrips:deletewarning"),
		"class" => "elgg-button elgg-button-delete float-alt",
	));
}
elgg_pop_context();
?>
<input id="guidGroup" type="hidden" value="<?php 
if($entity->owner_guid!="") echo $entity->owner_guid;
else echo elgg_get_logged_in_user_entity()->guid;
 ?>" />
</div>