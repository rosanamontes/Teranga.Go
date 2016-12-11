<?php
/**
* Trip Fields list view
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

$options = array(
		"type" => "object",
		"subtype" => CUSTOM_PROFILE_FIELDS_TRIP_SUBTYPE,
		"limit" => false,
		"order_by_metadata" => array(array('name' => 'order', 'direction' => "asc", 'as' => "integer")),
		"owner_guid" => elgg_get_site_entity()->getGUID(),
		"pagination" => false,
		"full_view" => false
	);

$list = elgg_list_entities_from_metadata($options);

if (empty($list)) {
	$list = elgg_echo("profiles_go:profile_fields:no_fields");
}
?>

<div class="elgg-module elgg-module-inline">
	<div class="elgg-head">
		<?php echo elgg_view("output/url", array("text" => elgg_echo("add"), "href" => "ajax/view/forms/profiles_go/trip_field", "class" => "elgg-button elgg-button-action profile-manager-popup elgg-lightbox"));?>
		<h3>
			<?php echo elgg_echo('profiles_go:trip_fields:list:title'); ?>
		</h3>
	</div>
	<div class="elgg-body" id="custom_fields_ordering">
		<?php echo $list; ?>
	</div>
</div>


