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
*	File: testing
*/
?>

<hr>
<div>
	<label><?php echo elgg_echo("title"); ?></label><br />
	<?php echo elgg_view('input/text',array('name' => 'title')); ?>
</div>
<div>
	<label><?php echo elgg_echo("body"); ?></label><br />
	<?php echo elgg_view('input/longtext',array('name' => 'body')); ?>
</div>
<div>
	<label><?php echo elgg_echo("tags"); ?></label><br />
	<?php echo elgg_view('input/tags',array('name' => 'tags')); ?>
</div>
<div>
	<?php echo elgg_view('input/submit', array('value' => elgg_echo('hflts:save'))); ?>
</div>
<hr>
