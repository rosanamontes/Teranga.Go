<?php
/**
* 	Plugin: Teranga Trip Filtering Tool 0.1
*	Author: Rosana Montes Soldado
*			Universidad de Granada
*	Licence: 	CC-ByNCSA
*	Reference:	Microproyecto CEI BioTIC Ref. 11-2015
* 	Project coordinator: @rosanamontes
*	Website: http://lsi.ugr.es/rosana
*	
*	File: English strings
*/

$english = array(

	// plugin settings
	'fuzzy_filter:settings:listing:default' => "Default trip listing tab",
	'fuzzy_filter:settings:listing:available' => "Available group listing tabs",

	// group listing
	'fuzzy_filter:trips:sorting:open' => "Active trips",
	'fuzzy_filter:trips:sorting:closed' => "Old trips",
	'fuzzy_filter:trips:sorting:ordered' => "Ordered",
	'fuzzy_filter:trips:sorting:suggested' => "Suggested",
	
	// suggested groups
	'fuzzy_filter:suggested:info' => "The following groups might be interesting for you. ",
	'fuzzy_filter:suggested:none' => "We can't suggest a trip for you. This can happen if we have to little information about you.",	
);

add_translation("en", $english);
