<?php
/**
 * Elgg myTrips css
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

?>
.myTrips-profile > .elgg-image {
	margin-right: 10px;
}
.myTrips-stats {
	background: #eeeeee;
	padding: 5px;
	margin-top: 10px;
	border-radius: 5px;
}

.myTrips-profile-fields .odd,
.myTrips-profile-fields .even {
	background: #f4f4f4;
	border-radius: 4px;	
	padding: 2px 4px;
	margin-bottom: 7px;
}

.myTrips-profile-fields .elgg-output {
	margin: 0;
}

#myTrips-tools > li {
	width: 48%;
	min-height: 200px;
	margin-bottom: 40px;
}

#myTrips-tools > li:nth-child(odd) {
	margin-right: 4%;
}

.myTrips-widget-viewall {
	float: right;
	font-size: 85%;
}

.myTrips-latest-reply {
	float: right;
}

.elgg-menu-myTrips-my-status li a {
	display: block;
	border-radius: 8px;
	background-color: white;
	margin: 3px 0 5px 0;
	padding: 2px 4px 2px 8px;
}
.elgg-menu-myTrips-my-status li a:hover {
	background-color: #0054A7;
	color: white;
	text-decoration: none;
}
.elgg-menu-myTrips-my-status li.elgg-state-selected > a {
	background-color: #4690D6;
	color: white;
}

/* no se como tiene que ser - le pongo colores chillones para resaltar */
.elgg-module-trip
{
	background-color: orange;
	color: yellow;
}