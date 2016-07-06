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
*	File:  Overview of community information regarding karma
*		Add a confirm before call action reset
*/

$ts = time ();
$token = generate_action_token ( $ts );

$html = "<h5>Karma</h5><p>" . elgg_echo('hflts:karma:none') . " vs {" . elgg_echo('hflts:karma:s0') .", "
	. elgg_echo('hflts:karma:s1') .", ". elgg_echo('hflts:karma:s2') .", ". elgg_echo('hflts:karma:s3') .", "
	. elgg_echo('hflts:karma:s4') .", ". elgg_echo('hflts:karma:s5') . ", ". elgg_echo('hflts:karma:s6') ."}</p>";

if (elgg_is_active_plugin('elggx_userpoints')) 
{
	$options_count = array('type' => 'user', 'limit' => false, 'count' => true, 'order_by_metadata' =>  array('name' => 'userpoints_points', 'direction' => DESC, 'as' => integer));
	$options_count['metadata_name_value_pairs'] = array(array('name' => 'userpoints_points', 'value' => 0,  'operand' => '>'));
	$count = elgg_get_entities_from_metadata($options_count);
	$options = array('type' => 'user', 'limit' => $limit, 'offset' => $offset);//, 
		//'order_by_metadata' =>  array('name' => 'userpoints_points', 'direction' => DESC, 'as' => integer));
	//$options['metadata_name_value_pairs'] = array(array('name' => 'userpoints_points', 'value' => 0,  'operand' => '>'));
	$entities = elgg_get_entities_from_metadata($options);
	
	$base = elgg_get_plugin_setting('base_expertise', 'hflts') ;


	$html .= "<div><br><table><tr><th width=\"30%\"><b>".elgg_echo('elggx_userpoints:user')."</b></th>";
	$html .= "<th width=\"15%\"><b>".elgg_echo('elggx_userpoints:upperplural')."</b></th>";
	$html .= "<th width=\"10%\"><b>".elgg_echo('evaluationcontent:export:expertise')." (B=".$base."%)</b></t>";
	$html .= "<th width=\"15%\"><b>".elgg_echo('elggx_userpoints:action')."</b></th>";
	$html .= "<th width=\"15%\"><b>".elgg_echo('evaluationcontent:export:karma')."</b></th>";
	$html .= "<th width=\"15%\"><b>".elgg_echo('evaluationcontent:export:valoraciones')."</b></t>";
	$html .= "<tr><td colspan=6><hr></td></tr>";

	if (is_array($entities)) 
	{
		elgg_load_library('elgg:trip_companions');

		update_allusers_expertise();

		foreach ($entities as $entity) 
		{

	    	$html .= "<tr><td><a href=\"" . elgg_get_site_url() . "admin/administer_utilities/elggx_userpoints?tab=detail&user_guid={$entity->guid}\">{$entity->username}</a></td>";
	    	$html .= "<td><a href=\"" . elgg_get_site_url() . "admin/administer_utilities/elggx_userpoints?tab=detail&user_guid={$entity->guid}\">{$entity->userpoints_points}</a></td>";

	    	$html .= "<td>".($entity->expertise*100)." %</td>";
	    	$html .= "<td>" . elgg_view("output/confirmlink", array(
	                          'href' => elgg_get_site_url() . "action/elggx_userpoints/reset?user_guid={$entity->guid}&__elgg_token=$token&__elgg_ts=$ts",
	                          'text' => elgg_echo('elggx_userpoints:reset'),
	                          'confirm' => sprintf(elgg_echo('elggx_userpoints:reset:confirm'), $entity->username)
	                      ));
	    	$html .= "</td>";

	    	$html .= "<td>".$entity->karma."</td>";
	    	$html .= "<td>".$entity->nValorations."</td>";
	    	
	    	$html .= "</tr>";
		}
	}
	$html .= "<tr><td colspan=6><hr></td></tr>";
	$html .= "</table></div>";
}

$html .= "<br><br>";


$reset_button .= elgg_view("output/confirmlink", array(
     'href' => elgg_get_site_url() . "action/evaluationcontent/reset?__elgg_token=$token&__elgg_ts=$ts",
     'text' => elgg_echo('evaluationcontent:reset_all'),
     'confirm' => elgg_echo('evaluationcontent:reset_all:confirm'),
     'class' => 'elgg-button elgg-button-action'));

	$attrs = [
			'class' => 'elgg-button elgg-button-action',
			'data-elgg-action' => json_encode([
				'name' => 'evaluationcontent/reset',
				'confirm' => elgg_echo('evaluationcontent:reset_all:confirm'),
			]),
		];
//$html .= elgg_format_element('button', $attrs, elgg_echo('evaluationcontent:reset_all'));



$export_button1 .= elgg_view("output/confirmlink", array(
     'href' => elgg_get_site_url() . "action/trip_companions/export?__elgg_token=$token&__elgg_ts=$ts",
     'text' => elgg_echo('evaluationcontent:export_all'),
     'class' => 'elgg-button elgg-button-action'));

	$attrs = [
			'class' => 'elgg-button elgg-button-action',
			'data-elgg-action' => json_encode([
				'name' => 'evaluationcontent/reset',
				'confirm' => elgg_echo('evaluationcontent:export_all'),
			]),
		];

$export_button2 .= elgg_view("output/url", array("title" => elgg_echo("evaluationcontent:actions:export:description"),
	"text" => elgg_echo("export"), "href" => "action/trip_companions/export?__elgg_token=$token&__elgg_ts=$ts", 
	"class" => "elgg-button elgg-button-action"));


$html .= $reset_button . "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . $export_button2. "<br><br>";
//$html .= elgg_view_form('evaluationcontent/import');

echo $html;