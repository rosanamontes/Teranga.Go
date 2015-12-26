<?php
/**
* 	Plugin: Valoraciones linguisticas con HFLTS
*	Author: Rosana Montes Soldado
*			Universidad de Granada
*	Licence: 	CC-ByNCSA
*	Reference:	Microproyecto CEI BioTIC Ref. 11-2015
* 	Project coordinator: @rosanamontes
*	Website: http://lsi.ugr.es/rosana
*	
*	File: testing 
*/

?>
<div>
<label>Message:</label>
<?php
	//This is an instance of the ElggWidget class that represents our widget.
	$widget = $vars['entity'];
	// Give the user a plain text box to input a message
	echo elgg_view('input/text', array(
		'name' => 'params[message]',
		'value' => $widget->message,
		'class' => 'input-text',
	));
	//the edit view remembers what the user typed in the previous time he changed the value of his message text.
?>
</div>
