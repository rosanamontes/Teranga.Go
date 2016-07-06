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
*	File: Leo el fichero cvs para importar y ejecutar DM
*
*/

//valores por defecto del formulario
$nAlternativas = get_input('nAlternativas', 4);
$nCriterios = get_input('nCriterios', 4);
$nExpertos = get_input('nExpertos', 4);
$G = get_input('G', 6);
$import_file = get_input('import_file', "xxxx");
$weight_file = get_input('weight_file', "weight4classic");
?>

<div id="evaluation">
<div class="elgg-form-row">
	<label>
		<?php
			echo elgg_echo('evaluationcontent:import:size:p1');
			echo elgg_view('input/text', array(
				'name' => 'nAlternativas',
				'value' => $nAlternativas,
			));
		?>
	</label>
	<label>
		<?php
			echo elgg_echo('evaluationcontent:import:size:p2');
			echo elgg_view('input/text', array(
				'name' => 'nCriterios',
				'value' => $nCriterios,
			));
		?>
	</label>
	<label>
		<?php
			echo elgg_echo('evaluationcontent:import:size:p3');
			echo elgg_view('input/text', array(
				'name' => 'nExpertos',
				'value' => $nExpertos,
			));
		?>
	</label>
	<label>
		<?php
			echo elgg_echo('evaluationcontent:import:size:p4');
			echo elgg_view('input/text', array(
				'name' => 'G',
				'value' => $G,
			));
		?>
	</label>
	<label>
		<?php
			echo elgg_echo('evaluationcontent:import:filename');
			echo "<br><h5>". elgg_echo('evaluationcontent:import:filename:description')."</h5>";
			echo elgg_view('input/text', array(
				'name' => 'import_file',
				'value' => $import_file,
			));
		?>
	</label>	

	<label>
		<?php
			echo elgg_echo('evaluationcontent:import:filename:weight');
			echo "<br><h5>". elgg_echo('evaluationcontent:import:filename:weight:description')."</h5>";
			echo elgg_view('input/text', array(
				'name' => 'weight_file',
				'value' => $weight_file,
			));
		?>
	</label>		


</div>
</div> <!--container evaluation-->

<div class="elgg-foot">
	<?php
		echo elgg_view('input/submit', array(
			'value' => elgg_echo('evaluationcontent:import:description'),
		));
		echo elgg_view('input/button', [
			'class' => 'elgg-button-cancel mls',
			'value' => elgg_echo('cancel'),
		]);
	?>
</div>


