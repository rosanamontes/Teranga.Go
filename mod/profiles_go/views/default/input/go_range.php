<?php
/**
* 	Plugin: Valoraciones linguisticas con HFLTS (original class type)
*	Author: Rosana Montes Soldado
*			Universidad de Granada
*	Licence: 	CC-ByNCSA
*	Reference:	Microproyecto CEI BioTIC Ref. 11-2015
* 	Project coordinator: @rosanamontes
*	Website: http://lsi.ugr.es/rosana
*	
*	File: input/go_range
*		Elemento input de formulario para introducir una peso asociado a un criterio de valoracion en el perfil de usuario. 
*		Puesto que el formulario profile lo guarda ELGG creo que éste no sabe cómo coger el valor de un input/range. 
*		Por eso incluyo un hidden como field asociado a este tipo. El JS lo actualiza.
*		En algun momento $vars['value'] tiene que recuperar el valor del hidden
*/

//elgg_require_js("profiles_go/range");

//tb sirve $value = elgg_extract("value", $vars);
//tb sirve $selected_items = elgg_extract("value", $vars, "");
$value = sanitise_int($vars['value'], false);
$range_id = $vars["name"] ;
//system_message($slide. " ***  " . $range_id ." value " . $value);

$body = elgg_view("input/hidden", $vars);
$body .= elgg_view('input/range', array(
	'name' => $range_id,
	'id' => $range_id,
	'value' => $value,
));
$body .= "<label for=".$range_id.">".$value." %</label>";

echo elgg_format_element('div', ['class' => 'profile-manager-input-pm-range', 'id' => $range_id], $body);

?>
<script type="text/javascript">
	$(document).ready(function() {
		$(".profile-manager-input-pm-range").on('change', function(event)
		{
			var id = event.target.id;
			var value = event.target.value;

        	$("label[for='"+id+"']").text(value+" %");
			//alert(id + " = " + value);  			
		});
	});
</script>
