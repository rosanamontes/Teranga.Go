<?php
/**
 * Trip profile fields
 *
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


$trip = $vars['entity'];

$trip_fields = profiles_go_get_categorized_trip_fields();
		
if (count($trip_fields["fields"]) > 0) {
	$trip_fields = $trip_fields["fields"];
	$even_odd = 'odd';
	
	foreach ($trip_fields as $field) {
		$metadata_name = $field->metadata_name;
		$value = $trip->$metadata_name;
		
		if ($value) {
			// make title
			$title = $field->getTitle();
			
			// adjust output type
			if ($field->output_as_tags == "yes") {
				$output_type = "tags";
				$value = string_to_tag_array($value);
			} else {
				$output_type = $field->metadata_type;
			}
			
			if ($field->metadata_type == "url") {
				$target = "_blank";
			} else {
				$target = null;
			}
	
			echo "<div class=\"{$even_odd}\">";
			echo "<b>";
			echo $title;
			echo ": </b>";
			echo elgg_view("output/$output_type",  array('value' => $value, "target" => $target));
			echo "</div>";
			
			$even_odd = ($even_odd == 'even') ? 'odd' : 'even';
		}
	}
}
