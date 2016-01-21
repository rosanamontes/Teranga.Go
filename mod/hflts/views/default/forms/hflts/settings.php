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
*	File: Settings form body
*
* 	@uses $vars['values']
*/

if (!elgg_is_xhr()) {
	echo '<p>' . elgg_echo('hflts:settings:explanation') . '</p>';
}

foreach ($vars['data'] as $name => $info) 
{
	$label = $info['readonly'] ? '<label class="elgg-state-disabled">' : '<label>';
	$class = $info['readonly'] ? 'elgg-state-disabled' : '';
	//$echo_vars = ($name === 'show_gear') ? ['<span class="elgg-icon-settings-alt elgg-icon"></span>'] : [];

	echo '<div>';
	if ($info['type'] == 'checkbox') 
	{
		echo $label;
		echo elgg_view("input/checkbox", array(
			'name' => $name,
			'value' => $info['value'],
			'checked' => $info['checked'],
			'class' => $class,
		));
		echo ' ' . elgg_echo("hflts:label:$name", $echo_vars) . '</label>';
	} 
	else if ($info['type'] == 'range') 
	{
		echo $label . elgg_echo("hflts:label:$name") . ' ';
		$slider = elgg_view('input/range', array(
			'name' => $name,
			'id' => $name,
			'value' => $info['value'],
			'range' =>true,
			'min' => 0,
			'max' => 100,
			'step' => 5,
		));
		$slider .= "<label for=".$name.">".$info['value']." %</label>";
		echo '</label>';
		echo elgg_format_element('div', ['class' => 'hflts-settings-range', 'id' => $name], $slider);
	}
	else
	{
		echo $label . elgg_echo("hflts:label:$name") . ' ';
		echo elgg_view("input/{$info['type']}", array(
			'name' => $name,
			'value' => $info['value'],
			'options_values' => $info['options_values'],
			'class' => $class,
		));
		echo '</label>';
	}
	echo '<span class="elgg-text-help">' . elgg_echo("hflts:help:$name") . '</span>';
	if ($info['readonly']) {
		echo '<span class="elgg-text-help">' . elgg_echo('admin:settings:in_settings_file') . '</span>';
	}
	echo '</div>';
}

echo '<div class="elgg-foot">';
echo elgg_view('input/submit', array('value' => elgg_echo('hflts:label:submit')));
echo '</div>';



?>
<script type="text/javascript">
	$(document).ready(function() 
	{
		$(".hflts-settings-range").on('change', function(event)
		{
			var id = event.target.id;
			var value = event.target.value;
			//alert(id + " & " + value);  
			$("label[for='"+id+"']").text(value+" %");
		});
	});
</script>
