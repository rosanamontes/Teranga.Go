<?php
/**
 * Discussion topic add/edit form body
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

$title = elgg_extract('title', $vars, '');
$desc = elgg_extract('description', $vars, '');
$status = elgg_extract('status', $vars, '');
$tags = elgg_extract('tags', $vars, '');
$access_id = elgg_extract('access_id', $vars, ACCESS_DEFAULT);
$container_guid = elgg_extract('container_guid', $vars);
$guid = elgg_extract('guid', $vars, null);

?>
<div>
	<label><?php echo elgg_echo('title'); ?></label><br />
	<?php echo elgg_view('input/text', array('name' => 'title', 'value' => $title)); ?>
</div>
<div>
	<label><?php echo elgg_echo('myTrips:topicmessage'); ?></label>
	<?php echo elgg_view('input/longtext', array('name' => 'description', 'value' => $desc)); ?>
</div>
<div>
	<label><?php echo elgg_echo('tags'); ?></label>
	<?php echo elgg_view('input/tags', array('name' => 'tags', 'value' => $tags)); ?>
</div>
<div>
    <label><?php echo elgg_echo("myTrips:topicstatus"); ?></label><br />
	<?php
		echo elgg_view('input/select', array(
			'name' => 'status',
			'value' => $status,
			'options_values' => array(
				'open' => elgg_echo('status:open'),
				'closed' => elgg_echo('status:closed'),
			),
		));
	?>
</div>

<?php
// No se puede establecer opciones por defecto de los viajes teranga del tipo 
// if ( elgg_is_admin_logged_in() ) else echo elgg_view('input/hidden'
//(rosana, despues de pelerar un buen rato)
?>
	<div>
		<label><?php echo elgg_echo('access'); ?></label><br />
		<?php echo elgg_view('input/access', array(
			'name' => 'access_id',
			'value' => $access_id,
			'entity' => get_entity($guid),
			'entity_type' => 'object',
			'entity_subtype' => 'tripforumtopic',
		)); ?>
	</div>


<div class="elgg-foot">
<?php

echo elgg_view('input/hidden', array('name' => 'container_guid', 'value' => $container_guid));

if ($guid) {
	echo elgg_view('input/hidden', array('name' => 'topic_guid', 'value' => $guid));
}

echo elgg_view('input/submit', array('value' => elgg_echo("save")));

?>
</div>
