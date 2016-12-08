<?php
/**
 * trip activity widget settings
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


// once autocomplete is working use that
$myTrips = elgg_get_logged_in_user_entity()->getmyTrips(array('limit' => 0));

$mymyTrips = array();
if (!$vars['entity']->trip_guid) {
	$mymyTrips[0] = '';
}

foreach ($myTrips as $trip) 
{
	$mymyTrips[$trip->guid] = $trip->name;
}

$params = array(
	'name' => 'params[trip_guid]',
	'value' => $vars['entity']->trip_guid,
	'options_values' => $mymyTrips,
);

$trip_dropdown = elgg_view('input/select', $params);
?>

<div>
	<?php echo elgg_echo('myTrips:widget:trip_activity:edit:select'); ?>:
	<?php echo $trip_dropdown; ?>
</div>

<?php
// set default value for number to display
if (!isset($vars['entity']->num_display)) 
{
	$vars['entity']->num_display = 8;
}

$params = array(
	'name' => 'params[num_display]',
	'value' => $vars['entity']->num_display,
	'options' => array(5, 8, 10, 12, 15, 20),
);
$num_dropdown = elgg_view('input/select', $params);

?>
<div>
	<?php echo elgg_echo('widget:numbertodisplay'); ?>:
	<?php echo $num_dropdown; ?>
</div>

<?php

$title_input = elgg_view('input/hidden', array('name' => 'title'));
echo $title_input;
