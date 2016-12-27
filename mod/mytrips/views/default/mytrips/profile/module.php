<?php
/**
 * Widget module 
 *
 * @uses $vars['title']    The title of the module
 * @uses $vars['content']  The module content
 * @uses $vars['all_link'] A link to list content
 * @uses $vars['add_link'] A link to create content
 *
* 	Plugin: mytripsTeranga
*	Author: Rosana Montes Soldado from previous version of @package ElggGroups
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
*/

$group = elgg_get_page_owner_entity();

$header = "<span class=\"mytrips-widget-viewall\">{$vars['all_link']}</span>";
$header .= '<h3>' . $vars['title'] . '</h3>';

if ($group->canWriteToContainer() && isset($vars['add_link'])) {
	$vars['content'] .= "<span class='elgg-widget-more'>{$vars['add_link']}</span>";
}

echo '<li>';
echo elgg_view_module('info', '', $vars['content'], array(
	'header' => $header,
	'class' => 'elgg-module-group',
));
echo '</li>';
