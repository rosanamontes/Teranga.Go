<?php
/*
* 	Plugin: mytripsTeranga
*	Author: Rosana Montes Soldado from previous version of @package ElggGroups
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
*/


$vars["CustomArray"];
?>
<ul class="elgg-gallery elgg-gallery-users">
<?php
for($i=2;$i<count($vars["CustomArray"]);$i++){
	$user=$vars["CustomArray"][$i];
$user=get_entity($user);

$guid = (int) $user->getGUID();
$page_owner_guid = (int) elgg_get_page_owner_guid();
$contexts = elgg_get_context_stack();
$input = (array) elgg_get_config("input");

// generate MAC so we don't have to trust the client's choice of contexts
$data = serialize([$guid, $page_owner_guid, $contexts, $input]);
$mac = elgg_build_hmac($data)->getToken();
?>


<li class="elgg-item" id="elgg-user-<?php echo $user->guid; ?>">
	<div class="elgg-avatar elgg-avatar-tiny">
		<!--<span class="elgg-icon-hover-menu elgg-icon" style="display: none;"></span>
		<ul rel="<?php echo $mac; ?>" class="elgg-menu elgg-menu-hover elgg-ajax-loader" data-elgg-menu-data=<?php 
		echo "{\"g\":$guid,\"pog\":$page_owner_guid,\"c\":[\"mytrips\",\"group_profile\",\"gallery\"],\"m\":\"$mac\",\"i\":[]}";
		/*json_encode([
		"g" => $guid,
		"pog" => $page_owner_guid,
		"c" => $contexts,
		"m" => $mac,
		"i" => $input,
		]);*/ ?>></ul>-->
		<a href="<?php echo $user->getURL(); ?>" class="">
		<img src="<?php echo get_entity_icon_url($user,'little'); ?>" alt="<?php echo $user->name; ?>" title="<?php echo $user->name; ?>" class=""></a>
	</div>
</li>
<?php }
?>
</ul>
