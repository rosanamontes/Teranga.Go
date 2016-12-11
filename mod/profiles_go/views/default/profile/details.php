<?php
/**
 * Elgg user display (details)
 * @uses $vars['entity'] The user entity
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
 

$user = elgg_get_page_owner_entity();
	
echo '<div id="profile-details" class="elgg-body pll">';
echo "<h2>{$user->name}</h2>";

echo elgg_view("profile/status", array("entity" => $user));

$show_profile_type_on_profile = elgg_get_plugin_setting("show_profile_type_on_profile", "profiles_go");

$categorized_fields = profiles_go_get_categorized_fields($user);
$cats = $categorized_fields['categories'];
$fields = $categorized_fields['fields'];

$details_result = "";
	
if ($show_profile_type_on_profile != "no") {
	if ($profile_type_guid = $user->custom_profile_type) {
		if (($profile_type = get_entity($profile_type_guid)) && ($profile_type instanceof ProfileManagerCustomProfileType)) {
			$details_result .= "<div class='even'><b>" . elgg_echo("profiles_go:user_details:profile_type") . "</b>: " . $profile_type->getTitle() . " </div>";
		}
	}
}
	
if (count($cats) > 0) {
			
	// only show category headers if more than 1 category available
	if (count($cats) > 1) {
		$show_header = true;
	} else {
		$show_header = false;
	}
	
	foreach ($cats as $cat_guid => $cat) {
		$cat_title = "";
		$field_result = "";
		$even_odd = "even";
		
		if ($show_header) {
			// make nice title
			if ($cat_guid == -1) {
				$title = elgg_echo("profiles_go:categories:list:system");
			} elseif ($cat_guid == 0) {
				if (!empty($cat)) {
					$title = $cat;
				} else {
					$title = elgg_echo("profiles_go:categories:list:default");
				}
			} elseif ($cat instanceof ProfileManagerCustomFieldCategory) {
				$title = $cat->getTitle();
			} else {
				$title = $cat;
			}
//echo "<p>categories " . $title."</p>";						
			$params = array(
				'text' => ' ',
				'href' => "#",
				'class' => 'elgg-widget-collapse-button',
				'rel' => 'toggle',
			);
			$collapse_link = elgg_view('output/url', $params);
			
			$cat_title = "<h3>" . elgg_echo($title) . "</h3>";
		}
			
		foreach ($fields[$cat_guid] as $field) {
			
			$metadata_name = $field->metadata_name;
			
			// give correct class
			if ($even_odd != "even") {
				$even_odd = "even";
			} else {
				$even_odd = "odd";
			}
			
			// make nice title
			$title = $field->getTitle();

			// get user value
			$value = $user->$metadata_name;
			
			// adjust output type
			if ($field->output_as_tags == "yes") {
				$output_type = "tags";
				if (!is_array($value)) {
					$value = string_to_tag_array($value);
				}
			} else {
				$output_type = $field->metadata_type;
			}
			
			if ($field->metadata_type == "url") {
				$target = "_blank";
				// validate urls
				if (!preg_match('~^https?\://~i', $value)) {
					$value = "http://$value";
				}
			} else {
				$target = null;
			}

			/* ahora le hago su propio output
			if ($field->metadata_type == "go_range")
			{
				$output_type="text"; 
				$value .= " % " . elgg_echo("profile:hint") ;	
			} */
			
			if (strpos($value,'custom:') !== false)
			{
				$value = elgg_echo($value);//necesario para traducir los radio-item 
			}

			// build result
			$field_result .= "<div class='" . $even_odd . "'>";
			$field_result .= "<b>" . $title . "</b>:&nbsp;";
			$field_result .= elgg_view("output/" . $output_type, array("value" => $value, "target" => $target));
			$field_result .= "</div>";
		}
			
		if (!empty($field_result)) {
			$details_result .= $cat_title;
			$details_result .= "<div>" . $field_result . "</div>";
		}
	}
}
	
if (!empty($details_result)) {
	if (elgg_get_plugin_setting("display_categories", "profiles_go") == "accordion") {
		echo "<div id='custom_fields_userdetails' class='profile-manager-accordion'>";
	} else {
		echo "<div id='custom_fields_userdetails'>";
	}
	echo $details_result . "</div>";
}

if ($user->isBanned()) {
	echo "<p class='profile-banned-user'>" . elgg_echo('banned') . "</p>";
}

echo "</div>";
