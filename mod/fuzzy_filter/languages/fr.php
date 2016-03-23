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
*	File: French strings
*/

$french = array(

	// plugin settings
	'fuzzy_filter:settings:listing:default' => "Onglets par défaut à la liste Voyage",
	'fuzzy_filter:settings:listing:available' => "Onglets de filtrage disponibles pour Voyage",

	// group listing
	'fuzzy_filter:trips:sorting:open' => "Voyage actif",
	'fuzzy_filter:trips:sorting:closed' => "Passé de Voyage",
	'fuzzy_filter:trips:sorting:ordered' => "Ordered",
	'fuzzy_filter:trips:sorting:suggested' => "Suggéré",
	
	// suggested groups
	'fuzzy_filter:suggested:info' => "Les voyages suivants pourrait être intéressant pour vous.",
	'fuzzy_filter:suggested:none' => "Nous ne pouvons pas proposer un voyage pour vous. Cela peut se produire si nous avons à peu d'informations sur vous.",
);

add_translation("fr", $french);
