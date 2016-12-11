<?php
/**
* Multiselect tipoBultos
*
* 	Plugin: profiles_go 
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


global $multiselect;
if (empty($multiselect)) {
	$multiselect = 1;
} else {
	$multiselect++;
}
$selected_items = elgg_extract("value", $vars, "");

if (!is_array($selected_items)) {
	$selected_items = string_to_tag_array($selected_items);
}

$selected_items = array_map("strtolower", $selected_items);


$internal_id = str_replace("]", "_", str_replace("[" , "_" ,$vars['name']));

if ($internal_id == "tipoBultos")
	$img = true;
else 
	$img = false;

$internal_id .= $multiselect; 

	
if (elgg_is_xhr()) {
	// register form for walled garden could load via ajax, so we need to load library manually
	$location = elgg_get_site_url() . "mod/profiles_go/vendors/jquery_ui_multiselect/jquery.multiselect.js";
	echo "<script type='text/javascript' src='" . $location . "'></script>";
} else {
	elgg_load_js("jquery.ui.multiselect");
}
?>
<script type="text/javascript">
	$(document).ready(function() {
		$("#<?php echo $internal_id;?>").multiselect({
			header: false,
			selectedList: 4,
			noneSelectedText: "<?php echo elgg_echo("profiles_go:input:multi_select:empty_text"); ?>"
		});
	});
</script>
<div>
	<select id="<?php echo $internal_id;?>" name="<?php echo $vars['name'];?>[]" multiple="multiple">
<?php
if (!empty($vars["options_values"])) 
{
	//system_message( " not empy OV " . $vars["options_values"]);//no entra
	foreach ($vars['options_values'] as $value => $option) 
	{
		$encoded_value = htmlentities($value, ENT_QUOTES, 'UTF-8');
		$encoded_option = htmlentities($option, ENT_QUOTES, 'UTF-8');

		if (in_array(strtolower($value), $selected_items)) {
			echo "<option value=\"$encoded_value\" selected=\"selected\">$encoded_option</option>";
		} else {
			echo "<option value=\"$encoded_value\">$encoded_option</option>";
		}
	}
} 
elseif (!empty($vars["options"])) 
{
	//system_message($img.  " not empy O " . $vars["options"] );
	$bulto = array ('raton.png','gato.png','tigre.png');
	$x = 0;
	foreach ($vars['options'] as $option) 
	{
		$selected = "";
		if (in_array(strtolower($option), $selected_items)) {
			$selected = " selected='selected'";
		}
		$encoded_option = htmlentities($option, ENT_QUOTES, 'UTF-8');

		if ($img)
		{
			//system_message($bulto[$x] . " +++ " . $option);
			echo "<option value=\"$bulto[$x]\"" . $selected . ">" . $option . "</option>";
			$x++;
		}
		else	
			echo "<option value=\"$encoded_option\"" . $selected . ">" . $encoded_option . "</option>";
		
	}
}
//else system_message( " empy " );//no entra
?>
	</select>
</div>


