<?php

/**
 * profile trip edit form - uses custom profile fields from @package profiles_go
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


$name = elgg_extract("name", $vars);
$trip_profile_fields = elgg_get_config("trip");
//system_message(" profile name " . $name);
?>
<div>
<label><?php echo elgg_echo("mytrips:icon"); ?></label><br />
	<?php echo elgg_view("input/file", array("name" => "icon")); ?>
</div>
<!--div>
	<label><?php echo elgg_echo("mytrips:name"); ?></label><br />
	<?php echo elgg_view("input/text", array(
		"name" => "name",
		"value" => $name,
	));
	?>
</div-->
<?php

// show the configured trip profile fields - it includes name
foreach ((array)$trip_profile_fields as $shortname => $valtype) 
{
	if ($valtype == "hidden") 
	{
		echo elgg_view("input/{$valtype}", array(
			"name" => $shortname,
			"value" => elgg_extract($shortname, $vars),
		));
		continue;
	}

	//system_message(" custom field name = " . $shortname);	
	$line_break = ($valtype == "longtext") ? "" : "<br />";
	$label = elgg_echo("mytrips:{$shortname}");
	$input = elgg_view("input/{$valtype}", array(
		"name" => $shortname,
		"value" => elgg_extract($shortname, $vars),
	));
		
	echo "<div><label>{$label}</label>{$line_break}{$input}</div>";
}
