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
*	File: Muestra un objeto-método
*/

$model = $vars['entity'];
$name = $model->getDisplayName();
$url="#";

?>

<div class="evaluation-content evaluation-content-activ>">
	<div class="clearfix">
		<h3 class="mbm">
			<?php echo elgg_view('output/url', [
				'text' => $name,
				'href' => $url,
				'is_trusted' => true,
				'class' => 'elgg-evaluation-content-address elgg-lightbox',
				'data-colorbox-opts' => json_encode([
					'width' => '85%',
					'height' => '85%',
					'iframe' => true,
				]),
			]);
			?>
		</h3>


			<p><?php echo $model->description . "<br>Escala=" . $model->scale . " términos. <br>Result=" . $model->collectiveValoration; ?></p>
	</div>
</div>
