<?php
/**
* Admin settings
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


$yesno_options = array(
	"yes" => elgg_echo("option:yes"),
	"no" => elgg_echo("option:no")
);

$noyes_options = array_reverse($yesno_options);

$profile_icon_options = $noyes_options;
$profile_icon_options["optional"] = elgg_echo("profiles_go:settings:profile_icon_on_register:option:optional");

$extra_fields_options = array(
	"extend" => elgg_echo("profiles_go:settings:registration:extra_fields:extend"),
	"beside" => elgg_echo("profiles_go:settings:registration:extra_fields:beside")
);

$enable_username_change_options = array(
	"no" => elgg_echo("option:no"),
	"admin" => elgg_echo("profiles_go:settings:enable_username_change:option:admin"),
	"yes" => elgg_echo("option:yes")
);

$profile_types = array();

$profile_types_options = array(
	"type" => "object",
	"subtype" => CUSTOM_PROFILE_FIELDS_PROFILE_TYPE_SUBTYPE,
	"owner_guid" => elgg_get_site_entity()->getGUID(),
	"limit" => false
);

$profile_type_entities = elgg_get_entities($profile_types_options);

if (!empty($profile_type_entities)) {
	$profile_types[""] = elgg_echo("profiles_go:profile:edit:custom_profile_type:default");
	foreach ($profile_type_entities as $type) {
		$profile_types[$type->guid] = $type->getTitle();
	}
}

echo elgg_view("profiles_go/admin/tabs", array("settings_selected" => true));

$trip_limit_options = array(
		"" => elgg_echo("profiles_go:settings:trip:limit:unlimited"),
		0 => elgg_echo("never"),
		1 => 1,
		2 => 2,
		3 => 3,
		4 => 4,
		5 => 5,
		6 => 6,
		7 => 7,
		8 => 8,
		9 => 9,
		10 => 10
	);
?>
<table>
	<tr>
		<td colspan="2">
			<div class='elgg-module-inline'>
				<div class='elgg-head'>
				<h3><?php echo elgg_echo("profiles_go:settings:registration"); ?></h3>
				</div>
			</div>
		</td>
	</tr>
	<tr>
		<td>
			<?php echo elgg_echo('profiles_go:settings:generate_username_from_email'); ?>
		</td>
		<td>
			<?php echo elgg_view("input/dropdown", array("name" => "params[generate_username_from_email]", "options_values" => $noyes_options, "value" => $vars['entity']->generate_username_from_email)); ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php echo elgg_echo('profiles_go:settings:profile_icon_on_register'); ?>
		</td>
		<td>
			<?php
				echo elgg_view("input/dropdown", array(
					"name" => "params[profile_icon_on_register]", 
					"options_values" => $profile_icon_options, 
					"value" => $vars['entity']->profile_icon_on_register
				));
			?>
		</td>
	</tr>
	<tr>
		<td>
			<?php echo elgg_echo('profiles_go:settings:show_account_hints'); ?>
		</td>
		<td>
			<?php echo elgg_view("input/dropdown", array("name" => "params[show_account_hints]", "options_values" => $noyes_options, "value" => $vars['entity']->show_account_hints)); ?>
		</td>
	</tr>
	<tr>
		<td colspan="2">
			<?php echo elgg_echo('profiles_go:settings:registration:terms'); ?>
		</td>
	</tr>
	<tr>
		<td colspan="2">
			<?php echo elgg_view("input/text", array("name" => "params[registration_terms]", "value" => $vars['entity']->registration_terms)); ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php echo elgg_echo('profiles_go:settings:registration:extra_fields'); ?>
		</td>
		<td>
			<?php echo elgg_view("input/dropdown", array("name" => "params[registration_extra_fields]", "options_values" => $extra_fields_options, "value" => $vars['entity']->registration_extra_fields)); ?>
		</td>
	</tr>
	<?php if (!empty($profile_types)) {?>
	<tr>
		<td>
			<?php echo elgg_echo('profiles_go:settings:default_profile_type'); ?>
		</td>
		<td>
			<?php echo elgg_view("input/dropdown", array("name" => "params[default_profile_type]", "options_values" => $profile_types, "value" => $vars['entity']->default_profile_type)); ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php echo elgg_echo('profiles_go:settings:hide_profile_type_default'); ?>
		</td>
		<td>
			<?php echo elgg_view("input/dropdown", array("name" => "params[hide_profile_type_default]", "options_values" => $noyes_options, "value" => $vars['entity']->hide_profile_type_default)); ?>
		</td>
	</tr>
	<?php } ?>
	<tr>
		<td colspan="2">
			<?php echo elgg_echo('profiles_go:settings:registration:free_text'); ?>
		</td>
	</tr>
	<tr>
		<td colspan="2">
			<?php echo elgg_view("input/longtext", array("name" => "params[registration_free_text]", "value" => $vars['entity']->registration_free_text)); ?>
		</td>
	</tr>
	<tr>
		<td colspan="2">
			<div class='elgg-module-inline'>
				<div class='elgg-head'>
				<h3><?php echo elgg_echo("profiles_go:settings:edit_profile"); ?></h3>
				</div>
			</div>
		</td>
	</tr>
	<tr>
		<td>
			<?php echo elgg_echo('profiles_go:settings:simple_access_control'); ?>
		</td>
		<td>
			<?php echo elgg_view("input/dropdown", array("name" => "params[simple_access_control]", "options_values" => $noyes_options, "value" => $vars['entity']->simple_access_control)); ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php echo elgg_echo('profiles_go:settings:hide_non_editables'); ?>
		</td>
		<td>
			<?php echo elgg_view("input/dropdown", array("name" => "params[hide_non_editables]", "options_values" => $noyes_options, "value" => $vars['entity']->hide_non_editables)); ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php echo elgg_echo('profiles_go:settings:edit_profile_mode'); ?>
		</td>
		<td>
			<?php
				$edit_profile_mode_options = array("list" => elgg_echo('profiles_go:settings:edit_profile_mode:list'), "tabbed" => elgg_echo('profiles_go:settings:edit_profile_mode:tabbed'));
				echo elgg_view("input/dropdown", array("name" => "params[edit_profile_mode]", "options_values" => $edit_profile_mode_options, "value" => $vars['entity']->edit_profile_mode));
			?>
		</td>
	</tr>
	<tr>
		<td>
			<?php echo elgg_echo('profiles_go:settings:profile_type_selection'); ?>
		</td>
		<td>
			<?php
				$profile_type_selection_options = array("user" => elgg_echo('profiles_go:settings:profile_type_selection:option:user'), "admin" => elgg_echo('profiles_go:settings:profile_type_selection:option:admin'));
				echo elgg_view("input/dropdown", array("name" => "params[profile_type_selection]", "options_values" => $profile_type_selection_options, "value" => $vars['entity']->profile_type_selection));
			?>
		</td>
	</tr>
	<tr>
		<td colspan="2">
			<div class='elgg-module-inline'>
				<div class='elgg-head'>
				<h3><?php echo elgg_echo("profiles_go:settings:view_profile"); ?></h3>
				</div>
			</div>
		</td>
	</tr>
	<tr>
		<td>
			<?php echo elgg_echo('profiles_go:settings:show_profile_type_on_profile'); ?>
		</td>
		<td>
			<?php echo elgg_view("input/dropdown", array("name" => "params[show_profile_type_on_profile]", "options_values" => $yesno_options, "value" => $vars['entity']->show_profile_type_on_profile)); ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php echo elgg_echo('profiles_go:settings:display_categories'); ?>
		</td>
		<td>
			<?php
				$display_categories_options = array("plain" => elgg_echo('profiles_go:settings:display_categories:option:plain'), "accordion" => elgg_echo('profiles_go:settings:display_categories:option:accordion'));
				echo elgg_view("input/dropdown", array("name" => "params[display_categories]", "options_values" => $display_categories_options, "value" => $vars['entity']->display_categories));
			?>
		</td>
	</tr>
	<tr>
		<td>
			<?php echo elgg_echo('profiles_go:settings:display_system_category'); ?>
		</td>
		<td>
			<?php echo elgg_view("input/dropdown", array("name" => "params[display_system_category]", "options_values" => $noyes_options, "value" => $vars['entity']->display_system_category)); ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php echo elgg_echo('profiles_go:settings:user_summary_control'); ?>
		</td>
		<td>
			<?php echo elgg_view("input/dropdown", array("name" => "params[user_summary_control]", "options_values" => $noyes_options, "value" => $vars['entity']->user_summary_control)); ?>
		</td>
	</tr>
	<tr>
		<td colspan="2">
			<div class='elgg-module-inline'>
				<div class='elgg-head'>
				<h3><?php echo elgg_echo("profiles_go:settings:trip"); ?></h3>
				</div>
			</div>
		</td>
	</tr>
	<tr>
		<td>
			<?php echo elgg_echo('profiles_go:settings:trip:trip_limit_name'); ?>
		</td>
		<td>
			<?php echo elgg_view("input/dropdown", array("name" => "params[trip_limit_name]", "options_values" => $trip_limit_options, "value" => $vars['entity']->trip_limit_name)); ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php echo elgg_echo('profiles_go:settings:trip:trip_limit_description'); ?>
		</td>
		<td>
			<?php echo elgg_view("input/dropdown", array("name" => "params[trip_limit_description]", "options_values" => $trip_limit_options, "value" => $vars['entity']->trip_limit_description)); ?>
		</td>
	</tr>
	<tr>
		<td colspan="2" class="elgg-subtext">
			<?php echo elgg_echo("profiles_go:settings:trip:limit:info"); ?>
		</td>
	</tr>
	<tr>
		<td colspan="2">
			<div class='elgg-module-inline'>
				<div class='elgg-head'>
				<h3><?php echo elgg_echo("other"); ?></h3>
				</div>
			</div>
		</td>
	</tr>
	<tr>
		<td>
			<?php echo elgg_echo('profiles_go:settings:enable_profile_completeness_widget'); ?>
		</td>
		<td>
			<?php echo elgg_view("input/dropdown", array("name" => "params[enable_profile_completeness_widget]", "options_values" => $noyes_options, "value" => $vars['entity']->enable_profile_completeness_widget)); ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php echo elgg_echo('profiles_go:settings:enable_username_change'); ?>
		</td>
		<td>
			<?php echo elgg_view("input/dropdown", array("name" => "params[enable_username_change]", "options_values" => $enable_username_change_options, "value" => $vars['entity']->enable_username_change)); ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php echo elgg_echo('profiles_go:settings:enable_site_join_river_event'); ?>
		</td>
		<td>
			<?php echo elgg_view("input/dropdown", array("name" => "params[enable_site_join_river_event]", "options_values" => $yesno_options, "value" => $vars['entity']->enable_site_join_river_event)); ?>
		</td>
	</tr>
</table>
<br />