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
*	File: main entry 
*/

const PLUGIN_ID = 'hflts';
require_once __DIR__ . '/lib/mcdm.php';
require_once __DIR__ . '/lib/hesitantOp.php';
require_once __DIR__ . '/classes/MCDM.php';
require_once __DIR__ . '/classes/AggregationHFLTS.php';


// register for the init, system event when our plugin start.php is loaded
elgg_register_event_handler('init', 'system', 'hflts_init');

function hflts_init() 
{
	elgg_register_page_handler('hflts', 'hflts_page_handler');
	
	// add to site links only in case of make the model result public
	/*if (elgg_is_logged_in()) {
		$item = new \ElggMenuItem('hflts', elgg_echo('hflts'), 'hflts');
		elgg_register_menu_item('site', $item);
	}*/

	//Puedo informar del karma en el dashboard o justo debajo del icono del usuario
	elgg_extend_view('icon/user/default','hflts/icon');

	//guardar la configuración seleccionada en el formulario de settings
	$action_base = elgg_get_plugins_path() . 'hflts/actions/hflts';
	//If you want to make an action available to only admins or open it up to unauthenticated users, you can pass ‘admin’ or ‘public’ 
	elgg_register_action('hflts/settings', "$action_base/settings.php", 'admin');

	if (elgg_in_context('admin')) 
	{
		elgg_register_menu_item('page', array(
			'name' => 'hflts_settings',
			'href' => 'admin/hflts/settings',
			'text' => elgg_echo('hflts:settings'),
			'context' => 'admin',
			'priority' => 10,
			'section' => 'teranga'
		));	
	}

	//register CSS file
	elgg_extend_view('css/elgg', 'hflts/css');

	//teranga add user_hover_menu entry
	elgg_register_plugin_hook_handler('register', 'menu:user_hover', 'hflts_user_hover_menu');
	elgg_register_plugin_hook_handler('admin:teranga:import', 'system', 'hflts_import_external_data');

	/* to handle mcdm objects
    elgg_register_event_handler('create','object', 'hflts_mcdm_object');
    elgg_register_event_handler('delete','object', 'hflts_mcdm_object');
    elgg_register_event_handler('delete','entity', 'hflts_mcdm_object');
    */
}

function hflts_page_handler($page)
{
	if (elgg_extract(0, $page) === 'collective') 
	{
		$content = elgg_view('hflts/collective', array(
			'nAlternativas' => $page[1],
			'nCriterios' => $page[2],
			'nExpertos' => $page[3],
			'G' => $page[4],
			'import_file' => $page[5],
			'weight_file' => $page[6],
		));
		$params = array(
			'title' => 'DM con datos de samples/set_'.$page[5].'.csv ('.$page[6].')',
			'content' => $content,
			'filter' => '',
		);
		$body = elgg_view_layout('content', $params);

		echo elgg_view_page('hflts', $body);

		return true;
	}


	set_input('username', $page[0]);//necesario
	$user = elgg_get_page_owner_entity();// ej strem
	$guid = elgg_get_page_owner_guid();// id de strem

	//aqui es donde tengo que filtrar por guid como en https://elgg.org/discussion/view/2268999/doubt-in-elgg-get-entities-from-metadata
	$valorations = elgg_get_entities_from_metadata([
		'type' => 'object',
		'subtype' => 'evaluation_content',
    	'metadata_name_value_pairs' => array(
        	'name' => 'user_guid',
        	'value' => $guid),
		'limit' => $vars['entity']->num_display,
		'pagination' => false,
		'order_by_metadata' => [
			'name' => 'state',
			'direction' => 'ASC',
			'as' => 'text',
		],
	]);

	if (!$valorations) {
		$valorations = '<p class="mtm">' . elgg_echo('evaluationcontent:none') . '</p>';
	}	

	$content = elgg_view('hflts/driver', array('valorations' => $valorations));
	$params = array(
		'title' => 'Valoraciones de '.$user->name,
		'content' => $content,
		'filter' => '',
	);
	$body = elgg_view_layout('content', $params);

	echo elgg_view_page('hflts', $body);
}

function hflts_user_hover_menu($hook, $type, $return, $params)
{
	$user = $params['entity'];

	//if (elgg_is_admin_logged_in() != $user->guid) supuestamente esto es para que no vea mi propia valoracion
	if (elgg_is_admin_logged_in())//un expedienteX menos
	{
		$url = "hflts/{$user->username}";
		$item = new \ElggMenuItem('hflts:user', elgg_echo('hflts:menuhover'), $url);
		$item->setSection('admin');//default + elgg_get_logged_in_user_guid() | admin + elgg_is_admin_logged_in
		//$item->setConfirmText(elgg_echo('confirm'));//saca un are you sure
		$return[] = $item;
	}
	return $return;	
}


function hflts_mcdm_object($event, $object_type, $object) 
{
	if ($event == 'create') 
	{
		system_message("evento create MCMD " . $object_type . " y " . $object->description);
	}
	if ($event == 'delete') 
	{
		system_message("evento delete MCMD " . $object_type . " y " . $object->description);
	}
    return(true);
}

/**
 * This method is called when the import form is filled ...
*/
function hflts_import_external_data($hook, $type, $return, $params) 
{
	$nAlternativas = $params['nAlternativas'];
	$nCriterios = $params['nCriterios'];
	$nExpertos = $params['nExpertos'];
	$G = $params['G'];
	$import_file = $params['import_file'];
	$weight_file = $params['weight_file'];
	
	forward('hflts/collective/'.$nAlternativas."/".$nCriterios."/".$nExpertos."/".$G."/".$import_file."/".$weight_file);
}

?>
