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
	'trip_filter:settings:listing:default' => "Default trip listing tab",
	'trip_filter:settings:listing:available' => "Available trip listing tabs",

	// trip listing
	'trip_filter:trips:sorting:open' => "Active trips",
	'trip_filter:trips:sorting:closed' => "Old trips",
	'trip_filter:trips:sorting:ordered' => "Ordered",
	'trip_filter:trips:sorting:suggested' => "Suggested",
	
	// suggested mytrips
	'trip_filter:suggested:info' => "The following trips might be interesting for you. ",
	'trip_filter:suggested:none' => "We can't suggest a trip for you. This can happen if we have to little information about you.",	
);

add_translation("en", $english);
