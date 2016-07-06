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
*	File: Elemento vista objeto valoración que muestra solo elementos públicos
*/
$item = $vars['item'];
/* @var ElggRiverItem $item */

$object = $item->getObjectEntity();
$excerpt = elgg_get_excerpt($object->description);

echo('river-create: <pre>');	print_r($excerpt);	echo('</pre><br>');
system_message("river " .$excerpt );


echo elgg_view('river/elements/layout', array(
	'item' => $item,
	'message' => $excerpt,
	'attachments' => elgg_view('output/url', array('href' => $object->url)),
));


