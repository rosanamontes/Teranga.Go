<?php
/**
* Replaces default Elgg profile edit form
*
* @uses $vars['entity'] The user entity
* @uses $vars['profile'] Profile items from get_config('profile_fields'), defined in profile/start.php for now
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


elgg_require_js("profiles_go/profile_edit");

echo elgg_view("profile/edit/name", $vars);

// Build fields

$categorized_fields = profiles_go_get_categorized_fields($vars['entity'], true);
$cats = $categorized_fields['categories'];
$fields = $categorized_fields['fields'];

$edit_profile_mode = elgg_get_plugin_setting("edit_profile_mode", "profiles_go");
$simple_access_control = elgg_get_plugin_setting("simple_access_control","profiles_go");

$access_id = get_default_access($vars["entity"]);

if (!empty($cats)) {
	
	// Profile type selector
	$setting = elgg_get_plugin_setting("profile_type_selection", "profiles_go");
	if (empty($setting)) {
		// default value
		$setting = "user";
	}
	
	$profile_type = $vars['entity']->custom_profile_type;
	
	// can user edit? or just admins
	if ($setting == "user" || elgg_is_admin_logged_in()) {
		// get profile types
		
		$options = array(
			"type" => "object",
			"subtype" => CUSTOM_PROFILE_FIELDS_PROFILE_TYPE_SUBTYPE,
			"limit" => false,
			"owner_guid" => elgg_get_site_entity()->getGUID()
		);
		$types = elgg_get_entities($options);
		if ($types) {
			$types_description = "";
			
			$dropdown_options = array();
			$dropdown_options[""] = elgg_echo("profiles_go:profile:edit:custom_profile_type:default");
			
			foreach ($types as $type) 
			{	
				$dropdown_options[$type->getGUID()] = $type->getTitle();
				
				// preparing descriptions of profile types
				$description = $type->getDescription();
				
				if (!empty($description)) { 
					$types_description .= "<div id='custom_profile_type_description_" . $type->getGUID() . "' class='custom_profile_type_description'>";
					//$types_description .= "<h3>" . elgg_echo("profiles_go:profile:edit:custom_profile_type:description") . " - ". $type->getTitle(). "</h3>";
					$types_description .= "<strong>" . $type->getTitle(). "</strong>";
					$types_description .= "<ul>".$description."</ul>";
					$types_description .= "</div>";
				}
			}
			
			echo "<div>";
			echo "<label>" . elgg_echo("profiles_go:profile:edit:custom_profile_type:label") . "</label>";
			echo elgg_view("input/dropdown", array("name" => "custom_profile_type",
													"id" => "custom_profile_type",
													"options_values" => $dropdown_options,
													"onchange" => "elgg.profiles_go.change_profile_type();",
													"value" => $vars['entity']->custom_profile_type));
			echo elgg_view('input/hidden', array('name' => 'accesslevel[custom_profile_type]', 'value' => ACCESS_PUBLIC));
			echo "</div>";
			
			echo $types_description;
		}
	} else {
		if (!empty($profile_type)) {
			echo elgg_view("input/hidden", array("name" => "custom_profile_type", "value" => $profile_type));
			echo elgg_view("input/hidden", array("name" => "accesslevel[custom_profile_type]", "value" => ACCESS_PUBLIC));
		}
	}
	
	$tabs = array();
	$tab_content = "";
	$list_content = "";
	
	foreach ($cats as $cat_guid => $cat) {
		// make nice title for category
		if (empty($cat_guid) || !($cat instanceof ProfileManagerCustomFieldCategory)) {
			$cat_title = elgg_echo("profiles_go:categories:list:default");
		} else {
			$cat_title = $cat->getTitle();
		}
	
		$class = "elgg-module elgg-module-info";
		if (!empty($cat_guid) && ($cat instanceof ProfileManagerCustomFieldCategory)) {
			
			$profile_type_options = array(
					"type" => "object",
					"subtype" => CUSTOM_PROFILE_FIELDS_PROFILE_TYPE_SUBTYPE,
					"limit" => false,
					"owner_guid" => $cat->getOwnerGUID(),
					"site_guid" => $cat->site_guid,
					"relationship" => CUSTOM_PROFILE_FIELDS_PROFILE_TYPE_CATEGORY_RELATIONSHIP,
					"relationship_guid" => $cat_guid,
					"inverse_relationship" => true
				);
			
			if ($profile_types = elgg_get_entities_from_relationship($profile_type_options)) {
				
				$class .= " custom_fields_edit_profile_category";
				
				// add extra class so it can be toggle in the display
				$hidden_category = true;
				foreach ($profile_types as $type) {
					$class .= " custom_profile_type_" . $type->getGUID();
					if ($type->getGUID() === (int) $profile_type) {
						$hidden_category = false;
					}
				}
				
				if ($hidden_category) {
					$class .= " hidden";
				}
			}
		}
				
		$tab_content .= "<div id='profiles_go_profile_edit_tab_content_" . $cat_guid . "' class='profiles_go_profile_edit_tab_content'>";
			
		$list_content .= "<div id='" . $cat_guid . "' class='" . $class . "'>";
		if (count($cats) > 1) {
			$list_content .= "<div class='elgg-head'>";
			$list_content .= "<h3>" . $cat_title . "</h3>";
			$list_content .= "</div>";
		}
		$list_content .= "<div class='elgg-body'>";
		$list_content .= "<fieldset>";
		
		// display each field for currect category
		$hide_non_editables = elgg_get_plugin_setting("hide_non_editables", "profiles_go");
		
		$visible_fields = 0;
		
		foreach ($fields[$cat_guid] as $field) {
			$metadata_name = $field->metadata_name;
			
			// get options
			$options = $field->getOptions();
			
			// get type of field
			if ($field->user_editable == "no") {
				$valtype = "non_editable";
			} else {
				$valtype = $field->metadata_type;
			}
			// make title
			$title = $field->getTitle();
							
			// get value
			$metadata = elgg_get_metadata(array(
				'guid' => $vars['entity']->guid,
				'metadata_name' => $metadata_name,
				'limit' => false
			));
			
			if ($metadata) {
				$metadata = $metadata[0];
				
				$value = $vars['entity']->$metadata_name;
				$access_id = $metadata->access_id;
			} else {
				$value = '';
				$access_id = get_default_access($vars["entity"]);
			}

			if ($hide_non_editables == "yes" && ($valtype == "non_editable")) {
				$field_result = "<div class='hidden'>";
			} else {
				$visible_fields++;
				$field_result = "<div>";
			}
			
			$field_result .= "<label>" . $title . "</label>";
			
			if ($hint = $field->getHint()) {
				$field_result .= "<span class='custom_fields_more_info' id='more_info_" . $metadata_name . "'></span>";
				$field_result .= "<span class='hidden' id='text_more_info_" . $metadata_name . "'>" . $hint . "</span>";
			}
			
			if ($valtype == "dropdown") {
				// add div around dropdown to let it act as a block level element
				$field_result .= "<div>";
			}
			
			$field_options = array(
				'name' => $metadata_name,
				'value' => $value,
				'options' => $options
			);

			$field_placeholder = $field->getPlaceholder();
			if (!empty($field_placeholder)) {
				$field_options["placeholder"] = $field_placeholder;
			}

			/* para depurar en caso de que $value esté vacio
			if ($valtype == "go_range")
			{	
				//Inserto a mano 50 y ya sí se muestra ...	
				//echo($value . ' teranga <pre>');	print_r($field_options);	echo('</pre><br>');	
			}
			*/
			$field_result .= elgg_view("input/" . $valtype, $field_options);
			
			if ($valtype == "dropdown") {
				$field_result .= "</div>";
			}
			
			$field_result .= elgg_view('input/access', array('name' => 'accesslevel[' . $metadata_name . ']', 'value' => $access_id));
			$field_result .= "</div>";
			
			$tab_content .= $field_result;
			$list_content .= $field_result;
		}
		
		if ($visible_fields) {
			// only add tab if there are visible fields
			$tabs[] = array(
					'title' => $cat_title,
					'url' => "#" . $cat_guid,
					'id' => $cat_guid,
					'class' => $class
			);
		}
		
		$tab_content .= "</div>";
		
		$list_content .= "</fieldset>";
		$list_content .= "</div>";
		$list_content .= "</div>";
	}
	
	if (($edit_profile_mode == "tabbed") && (count($cats) > 1)) {
		?>
		<div id="profiles_go_profile_edit_tabs">
			<?php echo elgg_view('navigation/tabs', array('tabs' => $tabs)); ?>
		</div>
		<div id="profiles_go_profile_edit_tab_content_wrapper">
			<?php echo $tab_content; ?>
		</div>
		<?php
	} else {
		echo $list_content;
	}
}



if ($simple_access_control == "yes") {
	?>
	<div class="profile-manager-simple-access-control">
		<label><?php echo elgg_echo("profiles_go:simple_access_control"); ?></label>
		<?php echo elgg_view('input/access',array('name' => 'simple_access_control', 'value' => $access_id, 'class' => 'simple_access_control', 'onchange' => 'set_access_control(this.value)')); ?>
	</div>
	<script type="text/javascript">
		$(document).ready(function(){
			$(".simple_access_control").val($(".elgg-input-access:first").val()).trigger("change");
		});
	
		function set_access_control(val){
			$(".elgg-input-access").not(".simple_access_control").val(val);
		}
	</script>
	<style type="text/css">
		.elgg-input-access {
			display: none;
		}
		.simple_access_control {
			display: inline-block;
		}
	</style>
	<?php
}
?>

<div class="elgg-foot">
<?php
	echo elgg_view('input/hidden', array('name' => 'guid', 'value' => $vars['entity']->guid));
	echo elgg_view('input/submit', array('value' => elgg_echo('save')));
?>
</div>