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
*	File: Muestra un objeto-evaluacion
*/

$evaluation = $vars['entity'];
$eval_by = $evaluation->getOwnerEntity();

//find out if the report is current or archive
if ($evaluation->state == 'archived') {
	$evaluationcontent_background = "evaluation-content-archived";
} else {
	$evaluationcontent_background = "evaluation-content-active";
}

if (elgg_in_context('admin'))
{
?>

<div class="evaluation-content <?php echo $evaluationcontent_background; ?>">
	<div class="clearfix">
		<div class="clearfix controls">
<?php
	if ($evaluation->state != 'archived') 
	{
		$attrs = [
			'class' => 'elgg-button elgg-button-action',
			'data-elgg-action' => json_encode([
				'name' => 'evaluationcontent/archive',
				'data' => [
					'guid' => $evaluation->guid,
				]
			]),
		];
		echo elgg_format_element('button', $attrs, elgg_echo('evaluationcontent:archive'));
	}
	$attrs = [
		'class' => 'elgg-button elgg-button-action',
		'data-elgg-action' => json_encode([
			'name' => 'evaluationcontent/delete',
			'data' => [
				'guid' => $evaluation->guid,
			]
		]),
	];
	echo elgg_format_element('button', $attrs, elgg_echo('evaluationcontent:delete'));
?>
		</div>
		<h3 class="mbm">
			<?php echo elgg_view('output/url', [
				'text' => $evaluation->name,
				'href' => $evaluation->url,
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
		<p><b><?php echo elgg_echo('evaluationcontent:by'); ?></b>
			<?php echo elgg_view('output/url', [
				'href' => $eval_by->getURL(),
				'text' => $eval_by->name,
				'is_trusted' => true,
			]);
			echo " " . elgg_view_friendly_time($evaluation->time_created);

			$trip = get_entity($evaluation->trip);
			echo " | <strong>" . elgg_echo("groups") . "</strong> " . $trip->name . ".";
			?>
		</p>

		<p>
			<?php 

   			//echo('C1: <pre>');	print_r($evaluation->criterion1);	echo('</pre><br>');
			if (!is_array($evaluation->criterion1))
				echo "H_1={".$evaluation->criterion1 . "} W_1=" . $evaluation->weight1 ." - "; 
			else
			{
				echo "H_1={";
				for ($x=0;$x<count($evaluation->criterion1)-1;$x++)
					echo $evaluation->criterion1[$x] . ",";
				echo $evaluation->criterion1[$x] . "} W_1=" . $evaluation->weight1 ." - "; 
			}

			if (!is_array($evaluation->criterion2))
				echo "H_2={".$evaluation->criterion2 . "} W_2=" . $evaluation->weight2 ." - "; 
			else
			{
				echo "H_2={";
				for ($x=0;$x<count($evaluation->criterion2)-1;$x++)
					echo $evaluation->criterion2[$x] . ",";
				echo $evaluation->criterion2[$x] . "} W_2=" . $evaluation->weight2 ." - "; 
			}

			if (!is_array($evaluation->criterion3))
				echo "H_3={".$evaluation->criterion3 . "} W_3=" . $evaluation->weight3 ." - ";
			else
			{
				echo "H_3={";
				for ($x=0;$x<count($evaluation->criterion3)-1;$x++)
					echo $evaluation->criterion3[$x] . ",";
				echo $evaluation->criterion3[$x] . "} W_3=" . $evaluation->weight3 ." - ";
			}

			if (!is_array($evaluation->criterion4))
				echo "H_4={".$evaluation->criterion4 . "} W_4=" . $evaluation->weight4 ; 
			else
			{
				echo "H_4={";
				for ($x=0;$x<count($evaluation->criterion4)-1;$x++)
					echo $evaluation->criterion4[$x] . ",";
				echo $evaluation->criterion4[$x] . "} W_4=" . $evaluation->weight4 ; 
			}
}
else//normal user
{
?>
<div class="evaluation-content <?php echo $evaluationcontent_background; ?>">
	<div class="clearfix">
		<p class="mbm">
			<b><?php echo "<span class='elgg-subtext'>" . elgg_echo("groups:owner") . ":</span> ";
			echo elgg_view('output/url', [
				'text' => $evaluation->name,
				'href' => $evaluation->url,
				'is_trusted' => true,
				'class' => 'elgg-evaluation-content-address elgg-lightbox',
				'data-colorbox-opts' => json_encode([
					'width' => '85%',
					'height' => '85%',
					'iframe' => true,
					]),
				]);
			echo "</b><br><span class='elgg-subtext'>" . elgg_echo('evaluationcontent:by') . "</span> " . elgg_view('output/url', [
				'href' => $eval_by->getURL(),
				'text' => $eval_by->name,
				'is_trusted' => true,
			]);
			echo " <span class='elgg-subtext'>" . elgg_view_friendly_time($evaluation->time_created) . "</span>";
		
}
//common to both cases

			if (($evaluation->criterion5 != -1) || ($evaluation->criterion6 != -1))
				echo "<br>";

			if ($evaluation->criterion5 != -1)
			{
				if ($evaluation->criterion5 == 1)
					echo "<span class='elgg-subtext'>" . elgg_echo('evaluationcontent:hint:reason5'). ":</span> ". elgg_echo('custom:rating:si') . ". ";
				else
					echo "<span class='elgg-subtext'>" . elgg_echo('evaluationcontent:hint:reason5'). ":</span> ". elgg_echo('custom:rating:no') . ". ";
			}

			if ($evaluation->criterion6 != -1)
			{
				if ($evaluation->criterion6 == 1)
					echo "<span class='elgg-subtext'>" . elgg_echo('evaluationcontent:hint:reason6'). ":</span> ". elgg_echo('custom:rating:si') . ". ";
				else
					echo "<span class='elgg-subtext'>" . elgg_echo('evaluationcontent:hint:reason6'). ":</span> ". elgg_echo('custom:rating:no') . ". ";
			}

			?>

		<?php if ($evaluation->description): ?>
			<br>
			<span class="elgg-subtext"><?php echo elgg_echo("comments"); ?>:</span>
			<?php echo " " . $evaluation->description; ?>
			</p>
		<?php endif; ?>
	</div>
</div>
