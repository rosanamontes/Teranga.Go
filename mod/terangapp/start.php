<?php

/**
* 	Plugin: TerangApp Popup Plugin
*	Author: Rosana Montes Soldado from previous version of Marek Lompart
*			Universidad de Granada
*	Licence: 	CC-ByNCSA
*	Reference:	Microproyecto CEI BioTIC Ref. 11-2015
* 	Project coordinator: @rosanamontes
*	Website: http://lsi.ugr.es/rosana
* 	Resources: <A HREF="javascript:void(window.close('http://funradio.sk/play?select=1'))">close radio</A><BR>
*	
*	File: main entry
*/  

elgg_register_event_handler('init', 'system', 'terangapp_init');
	
function terangapp_init() 
{
	//add the widget
	elgg_register_widget_type('terangapp',elgg_echo("terangapp:title"),elgg_echo("terangapp:description"));			
}
		

?>