<?php
/**
* Register profile icon input field
*
* 	Plugin: profiles_go from previous version of @package profile_manager of Coldtrick IT Solutions 2009
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


$profile_icon = elgg_get_plugin_setting("profile_icon_on_register", "profiles_go");
if ($profile_icon == "yes") {
	// mandatory	
	echo "<div class='mandatory'>";	
} else {
	echo "<div>";	
}

echo "<label for='register-profile_icon'>" . elgg_echo("profiles_go:register:profile_icon") . "</label><br />";
echo elgg_view("input/file", array("name" => "profile_icon", "id" => "register-profile_icon"));
echo "</div>";
?>
<script type="text/javascript">
	$(document).ready(function(){
		$(".elgg-form-register").attr("enctype", "multipart/form-data").attr("encoding", "multipart/form-data");
	});
</script>