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

const PLUGIN_ID = 'teranga_idss';
require_once __DIR__ . '/lib/mcdm.php';
require_once __DIR__ . '/lib/hesitantOp.php';
require_once __DIR__ . '/lib/latex.php';
require_once __DIR__ . '/classes/MCDM.php';
require_once __DIR__ . '/classes/AggregationHFLTS.php';


// register for the init, system event when our plugin start.php is loaded
elgg_register_event_handler('init', 'system', 'teranga_idss_init');

function teranga_idss_init() 
{
	elgg_register_page_handler('teranga_idss', 'teranga_idss_page_handler');
	
	// add to site links only in case of make the model result public
	/*if (elgg_is_logged_in()) {
		$item = new \ElggMenuItem('teranga_idss', elgg_echo('teranga_idss'), 'teranga_idss');
		elgg_register_menu_item('site', $item);
	}*/

	//Puedo informar del karma en el dashboard o justo debajo del icono del usuario
	elgg_extend_view('icon/user/default','teranga_idss/icon');

	//guardar la configuración seleccionada en el formulario de settings
	$action_base = elgg_get_plugins_path() . 'teranga_idss/actions/teranga_idss';
	//If you want to make an action available to only admins or open it up to unauthenticated users, you can pass ‘admin’ or ‘public’ 
	elgg_register_action('teranga_idss/settings', "$action_base/settings.php", 'admin');

	if (elgg_in_context('admin')) 
	{
		elgg_register_menu_item('page', array(
			'name' => 'teranga_idss_settings',
			'href' => 'admin/teranga_idss/settings',
			'text' => elgg_echo('teranga_idss:settings'),
			'context' => 'admin',
			'priority' => 10,
			'section' => 'teranga'
		));	
	}

	//register CSS file
	elgg_extend_view('css/elgg', 'teranga_idss/css');

	//teranga add user_hover_menu entry
	elgg_register_plugin_hook_handler('register', 'menu:user_hover', 'teranga_idss_user_hover_menu');
	elgg_register_plugin_hook_handler('admin:teranga:import', 'system', 'teranga_idss_import_external_data');

	/* to handle mcdm objects
    elgg_register_event_handler('create','object', 'teranga_idss_mcdm_object');
    elgg_register_event_handler('delete','object', 'teranga_idss_mcdm_object');
    elgg_register_event_handler('delete','entity', 'teranga_idss_mcdm_object');
    */
}

function teranga_idss_page_handler($page)
{
	if (elgg_extract(0, $page) === 'collective') 
	{
		$content = elgg_view('teranga_idss/collective', array(
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

		echo elgg_view_page('teranga_idss', $body);

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

	$content = elgg_view('teranga_idss/driver', array('valorations' => $valorations));
	$params = array(
		'title' => 'Valoraciones de '.$user->name,
		'content' => $content,
		'filter' => '',
	);
	$body = elgg_view_layout('content', $params);

	echo elgg_view_page('teranga_idss', $body);
}

function teranga_idss_user_hover_menu($hook, $type, $return, $params)
{
	$user = $params['entity'];

	//if (elgg_is_admin_logged_in() != $user->guid) supuestamente esto es para que no vea mi propia valoracion
	if (elgg_is_admin_logged_in())//un expedienteX menos
	{
		$url = "teranga_idss/{$user->username}";
		$item = new \ElggMenuItem('teranga_idss:user', elgg_echo('teranga_idss:menuhover'), $url);
		$item->setSection('admin');//default + elgg_get_logged_in_user_guid() | admin + elgg_is_admin_logged_in
		//$item->setConfirmText(elgg_echo('confirm'));//saca un are you sure
		$return[] = $item;
	}
	return $return;	
}


function teranga_idss_mcdm_object($event, $object_type, $object) 
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
function teranga_idss_import_external_data($hook, $type, $return, $params) 
{
	$nAlternativas = $params['nAlternativas'];
	$nCriterios = $params['nCriterios'];
	$nExpertos = $params['nExpertos'];
	$G = $params['G'];
	$import_file = $params['import_file'];
	$weight_file = $params['weight_file'];
	
	forward('teranga_idss/collective/'.$nAlternativas."/".$nCriterios."/".$nExpertos."/".$G."/".$import_file."/".$weight_file);
}

?>
