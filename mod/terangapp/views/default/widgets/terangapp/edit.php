<?php

/**
* 	Plugin: TerangApp Popup Plugin
*	Author: Rosana Montes Soldado from previous version of Marek Lompart
*			Universidad de Granada
*	Licence: 	CC-ByNCSA
*	Reference:	Microproyecto CEI BioTIC Ref. 11-2015
* 	Project coordinator: @rosanamontes
*	Website: http://lsi.ugr.es/rosana
*
*	File: edit view
*/

if (elgg_get_plugin_setting('beta_version', 'terangapp') == 'no')
{
	$link = elgg_get_plugin_setting('opinaugr_link', 'terangapp');
	echo "<h6><a href=" . $link . " title='Teranga Go!' target='_blank'><span style='text-decoration:none;color:#400000;'>" . 
		elgg_echo('terangapp:description') . "</span></a><br></h6>";
}