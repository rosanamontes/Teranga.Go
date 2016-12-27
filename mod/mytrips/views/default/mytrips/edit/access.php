<?php

/**
 * trip edit form
 *
* 	Plugin: mytripsTeranga from previous version of @package ElggGroup
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


$entity = elgg_extract("entity", $vars, false);
$owner_guid = elgg_extract("owner_guid", $vars);

$membership = elgg_extract("membership", $vars);
$visibility = elgg_extract("vis", $vars);
$content_access_mode = elgg_extract("content_access_mode", $vars);



/*if ( elgg_is_admin_logged_in() )
{

	$visibility_options =  array(
		ACCESS_PUBLIC => elgg_echo("PUBLIC"),
		ACCESS_PRIVATE => elgg_echo("mytrips:access:trip"),
		ACCESS_LOGGED_IN => elgg_echo("LOGGED_IN"),
	);

	$opt_access = array(
		ElggGroup::CONTENT_ACCESS_MODE_MEMBERS_ONLY => elgg_echo("mytrips:content_access_mode:membersonly"),
		ElggGroup::CONTENT_ACCESS_MODE_UNRESTRICTED => elgg_echo("mytrips:content_access_mode:unrestricted"),
	);
} 
else === These settings are common in Teranga Go */
{
	//$opt_member = array(ACCESS_PUBLIC => elgg_echo("mytrips:access:public"));
	$opt_member = array(
		ACCESS_PUBLIC => elgg_echo("mytrips:access:public"),
		ACCESS_PRIVATE => elgg_echo("mytrips:access:private"),
	);


	$visibility_options =  array( ACCESS_PUBLIC => elgg_echo("PUBLIC"));
	$opt_access = array(ElggGroup::CONTENT_ACCESS_MODE_MEMBERS_ONLY => elgg_echo("mytrips:content_access_mode:membersonly"));
}


?>
<div>
	<label for="mytrips-membership"><?php echo elgg_echo("mytrips:membership"); ?></label><br />
	<?php 

	/*echo elgg_view("input/text", array(
		"name" => "membership",
		"id" => "mytrips-membership",
		"value" => $opt_member,
		'disabled' => true, //en true no manda el valor al action

	));*/

	echo elgg_view("input/select", array(
		"name" => "membership",
		"id" => "mytrips-membership",
		"value" => $membership,
		"options_values" => $opt_member,
	));
	?>
</div>

<?php if (elgg_get_plugin_setting("hidden_mytrips", "mytrips") == "yes"): ?>
	<div>
		<label for="mytrips-vis"><?php echo elgg_echo("mytrips:visibility"); ?></label><br />
		<?php

		if (elgg_get_config("walled_garden")) {
			unset($visibility_options[ACCESS_PUBLIC]);
		}

		echo elgg_view("input/text", array(
			"name" => "vis",
			"id" => "mytrips-vis",
			"value" => $$visibility_options,
			'entity' => $entity,
			'entity_type' => 'group',
			'disabled' => true, //en true no manda el valor al action
		));//teranga on */
		
		echo elgg_view("input/access", array(
			"name" => "vis",
			"id" => "mytrips-vis",
			"value" => $visibility,
			"options_values" => $visibility_options,
			'entity' => $entity,
			'entity_type' => 'group',
			'entity_subtype' => '',
		));
		?>
	</div>
<?php endif; ?>

<?php

$access_mode_params = array(
	"name" => "content_access_mode",
	"id" => "mytrips-content-access-mode",
	"value" => $content_access_mode,
	"options_values" => $opt_access,
);

if ($entity) {
	// Disable content_access_mode field for hidden mytrips because the setting
	// will be forced to members_only regardless of the entered value
	//if ($entity->access_id === $entity->trip_acl) {
	//	$access_mode_params['disabled'] = 'disabled';
	//}
}
?>
<div>
	<label for="mytrips-content-access-mode"><?php echo elgg_echo("mytrips:content_access_mode"); ?></label><br />
	<?php
		//echo elgg_view("input/select", $access_mode_params);
		echo elgg_view("input/text", array(
			"name" => "content_access_mode",
			"id" => "mytrips-content-access-mode",
			"value" => $opt_access,
			'disabled' => true, //en true no manda el valor al action
		));

		/* ver si es necesario un teranga warning
		if ($entity && $entity->getContentAccessMode() == ElggGroup::CONTENT_ACCESS_MODE_UNRESTRICTED) {
			// Warn the user that changing the content access mode to more
			// restrictive will not affect the existing trip content
			$access_mode_warning = elgg_echo("mytrips:content_access_mode:warning");
			echo "<span class='elgg-text-help'>$access_mode_warning</span>";
		}*/
	?>
</div>

<?php

if ($entity && ($owner_guid == elgg_get_logged_in_user_guid() || elgg_is_admin_logged_in())) 
{
	$members = array();

	$options = array(
		"relationship" => "member",
		"relationship_guid" => $entity->getGUID(),
		"inverse_relationship" => true,
		"type" => "user",
		"limit" => 0,
	);

	$batch = new ElggBatch("elgg_get_entities_from_relationship", $options);
	foreach ($batch as $member) 
	{
		$option_text = "$member->name (@$member->username)";
		$members[$member->guid] = htmlspecialchars($option_text, ENT_QUOTES, "UTF-8", false);
	}
	?>

	<div>
		<label for="mytrips-owner-guid"><?php echo elgg_echo("mytrips:owner"); ?></label><br />
		<?php
			echo elgg_view("input/text", array(
				"name" => "owner_guid",
				"id" => "mytrips-owner-guid",
				"value" =>  $members,
				'disabled' => true, //en true no manda el valor al action
			));

			/*echo elgg_view("input/select", array(
				"name" => "owner_guid",
				"id" => "mytrips-owner-guid",
				"value" =>  $owner_guid,
				"options_values" => $members,
				"class" => "mytrips-owner-input",
			));*/

			if ($owner_guid == elgg_get_logged_in_user_guid()) {
				echo "<span class='elgg-text-help'>" . elgg_echo("mytrips:owner:warning") . "</span>";
			}
		?>
	</div>
<?php
}
