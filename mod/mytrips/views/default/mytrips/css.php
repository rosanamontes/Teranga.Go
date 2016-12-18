<?php
/**
 * Elgg mytrips css
 * 
* 	Plugin: mytripsTeranga from previous version of @package ElggGroup
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
.mytrips-profile > .elgg-image {
	margin-right: 10px;
}
.mytrips-stats {
	background: #eeeeee;
	padding: 5px;
	margin-top: 10px;
	border-radius: 5px;
}

.mytrips-profile-fields .odd,
.mytrips-profile-fields .even {
	background: #f4f4f4;
	border-radius: 4px;	
	padding: 2px 4px;
	margin-bottom: 7px;
}

.mytrips-profile-fields .elgg-output {
	margin: 0;
}

#mytrips-tools > li {
	width: 48%;
	min-height: 200px;
	margin-bottom: 40px;
}

#mytrips-tools > li:nth-child(odd) {
	margin-right: 4%;
}

.mytrips-widget-viewall {
	float: right;
	font-size: 85%;
}

.mytrips-latest-reply {
	float: right;
}

.elgg-menu-mytrips-my-status li a {
	display: block;
	border-radius: 8px;
	background-color: white;
	margin: 3px 0 5px 0;
	padding: 2px 4px 2px 8px;
}
.elgg-menu-mytrips-my-status li a:hover {
	background-color: #0054A7;
	color: white;
	text-decoration: none;
}
.elgg-menu-mytrips-my-status li.elgg-state-selected > a {
	background-color: #4690D6;
	color: white;
}

/* no se como tiene que ser - le pongo colores chillones para resaltar */
.elgg-module-trip
{
	background-color: orange;
	color: yellow;
}