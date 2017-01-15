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
*	File: Spanish strings
*/

$spanish = array(

	// plugin settings
	'trip_filter:settings:listing:default' => "Pestañas por defecto para listar viajes",
	'trip_filter:settings:listing:available' => "Pestañas disponibles para filtrar viajes",

	// trip listing
	'trip_filter:trips:sorting:open' => "Viajes activos",
	'trip_filter:trips:sorting:closed' => "Viajes pasados",
	'trip_filter:trips:sorting:ordered' => "Ordered",
	'trip_filter:trips:sorting:suggested' => "Sugeridos",
	
	// suggested trip
	'trip_filter:suggested:info' => "Los siguientes viajes podrían ser de su interes.",
	'trip_filter:suggested:none' => "Actualmente no podemos sugerirle un viaje. Puede deberse a que no disponemos de suficiente  información acerca de usted.",
);

add_translation("es", $spanish);
