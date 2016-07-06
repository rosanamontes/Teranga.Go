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
*	File: Plugin para agregar y gestionar valoraciones
* 	Se utilizará principalmente como widget del dashboard del usuario
*/


const PLUGIN_ID = 'trip_companions';

require_once __DIR__ . '/lib/functions.php';
require_once __DIR__ . '/lib/events.php';

elgg_register_event_handler('init', 'system', __NAMESPACE__ . '\\init');

/**
 * Inicializacion
 */

function init() 
{
	// Extendemos el CSS
	elgg_extend_view('css/elgg', 'evaluationcontent/css');
	elgg_extend_view('css/admin', 'evaluationcontent/admin_css');
	elgg_extend_view('css/elgg', 'css/trip_companions');
	
	// Registra las URLs de las paginas que se van a usar
	elgg_register_page_handler('trip_companions', 'trip_companions_page_handler');

	// Ahora quito trip companions del menu de usuarios
	//elgg_register_event_handler('pagesetup', 'system', 'trip_companions_pagesetup');

	elgg_register_widget_type('trip_companions', elgg_echo('trip_companions:people:you:may:know'), elgg_echo('trip_companions:widget:description'), array('dashboard', 'profile'));	
	
	elgg_load_js('lightbox');
	elgg_load_css('lightbox');
	
	elgg_register_ajax_view('trip_companions/groups');

	if (elgg_is_logged_in()) {
		elgg_require_js('elgg/evaluationcontent');
	}

	//que un usuario valore a otro, encontrando en el menu desplegable del avatar la opción correspondiente
	elgg_register_plugin_hook_handler('register', 'menu:user_hover', 'evaluationcontent_user_hover_menu');

	//Funciones para admin en Administración > zona Teranga > menuitems
	elgg_register_admin_menu_item('teranga', 'evaluationcontent', 'teranga');
	elgg_register_admin_menu_item('teranga', 'overview', 'teranga');	
	elgg_register_admin_menu_item('teranga', 'assign', 'teranga');	
	elgg_register_admin_menu_item('teranga', 'import', 'teranga');	
	

	//..y tambien como un widget
	elgg_register_widget_type(
			'evaluationcontent',
			elgg_echo('evaluationcontent'),
			elgg_echo('evaluationcontent:widget:description'),
			array('admin'));

	// Acciones sobre las valoraciones
	$action_path = elgg_get_plugins_path() . "trip_companions/actions/evaluationcontent";
	$base_path = elgg_get_plugins_path() . "trip_companions/actions";
	elgg_register_action('evaluationcontent/add', "$action_path/add.php");
	elgg_register_action('evaluationcontent/delete', "$action_path/delete.php", 'admin');
	elgg_register_action('evaluationcontent/archive', "$action_path/archive.php", 'admin');
	elgg_register_action('evaluationcontent/reset', "$action_path/reset.php", 'admin');
	elgg_register_action("evaluationcontent/assign", "$action_path/assign.php", 'admin');//asign karma directly
	elgg_register_action('trip_companions/export', "$base_path/export.php", 'admin');
	elgg_register_action('evaluationcontent/import', "$base_path/import.php", 'admin');

	//Teranga hook between trip_companions and groups
	elgg_register_library('elgg:trip_companions', elgg_get_plugins_path() . 'trip_companions/lib/trip_companions.php');
	elgg_register_plugin_hook_handler('evaluationcontent:add', 'system', 'evaluation_change_grade');
	elgg_register_plugin_hook_handler('evaluationcontent:delete', 'system', 'evaluation_change_ungrade');

	// Groups
	add_group_tool_option('trip_companions', elgg_echo('evaluationcontent:enablecomments'), true);
	elgg_extend_view('groups/tool_latest', 'trip_companions/group_module');
}

/**
 * Gestor de páginas
 *
 * @param array $page Array of page routing elements
 * @return bool
 */
function trip_companions_page_handler($page) 
{	
	//system_message("page handler " . elgg_extract(0, $page));
	// only logged in users can do things
	elgg_gatekeeper();

	if (elgg_extract(0, $page) === 'add' && elgg_is_xhr()) {
		echo elgg_view('resources/evaluationcontent/add_form');
		return true;
	}

	if (elgg_extract(0, $page) === 'import') {
		echo elgg_view('resources/trip_companions/add_form');
		return true;
	}

	$friends = $groups = 0;
	switch ($page[0]) 
	{
		case 'groups':
			$groups = 10;
			break;
		default:
			$friends = $groups = 10;
			break;
	}
	
	$page_owner = elgg_get_logged_in_user_entity();
	elgg_set_page_owner_guid($page_owner->guid);
	elgg_set_context("trip_companions");

	$content = elgg_view('resources/trip_companions/list', array(
		'owner' => $page_owner,
		'friends' => $friends,
		'groups' => $groups
	));

	if ($content) {
		echo $content;
		return true;
	}

	return false;
}
 

/**
 * entrada de menu para el usuario solo cuando esta en el viaje
 */
function evaluationcontent_user_hover_menu($hook, $type, $return, $params) 
{
	$user = $params['entity'];

	$trip = elgg_get_page_owner_entity();
	// Check for valid trip
	if (!elgg_instanceof($trip, 'group')) 
	{
		return $return;
	}	

	$profile_url = urlencode($user->getURL());
	$name = urlencode($user->name);
	$trip = elgg_get_page_owner_entity();
	$tripinfo = urlencode($trip->getGUID());
	$uid = urlencode($user->guid);

	//desconozco por qué motivo despues de este texto se añade ?url=<group_profile> que dificulta leer los valores 
	$url = "trip_companions/add?profile={$profile_url}&name={$name}&trip={$tripinfo}&uid={$uid}&null";

	if (elgg_is_logged_in() && elgg_get_logged_in_user_guid() != $user->guid)
	{
		elgg_load_library('elgg:trip_companions');
		if ( check_valid_asessment(elgg_get_logged_in_user_guid(),$user->guid, $tripinfo) )
		{
			//all menu items have a class based on their name -- elgg-menu-item-$name
			$item = new ElggMenuItem(
					'evaluation-content',
					elgg_echo('evaluationcontent:user'),
					$url);
			$item->setSection('action');
			$item->addLinkClass('elgg-lightbox');
			$return[] = $item;
		}
	}

	return $return;
}


/**
 * This method is called when a teranga evaluation is added (before moderation)
 * We change the user status in the trip
  */
function evaluation_change_grade($hook, $type, $return, $params) 
{
	$valoration = $params['evaluation'];	
	//$owner 	= get_user($valoration->owner_guid);//system_message($type . " + grade hook " . $trip);
	//$user 	= get_user($valoration->user_guid);
	$name 	= $valoration->name;
	$trip 	= $valoration->trip;
	
	//we take note that owner has assessed user in trip	
	elgg_load_library('elgg:trip_companions');
	trip_companions_add_grade($valoration->owner_guid, $valoration->user_guid, $valoration->trip);
	return $return;
}

/**
 * This method is called when a teranga evaluation is deleted 
 * We change the user status in the trip
 */
function evaluation_change_ungrade($hook, $type, $return, $params) 
{
	$valoration = $params['evaluation'];
	//system_message("evaluation_change_ungrade " . $params['evaluation']->subtype . " - " . $params['evaluation']->description . " - " . $params['evaluation']->name);

	//we take note that the asessment made by owner does not longer exist
	elgg_load_library('elgg:trip_companions');
	trip_companions_remove_grade($valoration->owner_guid, $valoration->user_guid, $valoration->trip);

	return $return;
}



/**
 * Function to add menu items to the pages
 *
 * @return void
 */
function trip_companions_pagesetup() 
{
	if (!elgg_in_context('admin') || !elgg_is_admin_logged_in()) 
	{
		return;
	}
		
	elgg_load_js('lightbox');
	elgg_load_css('lightbox');
		
	elgg_register_admin_menu_item('administer', 'export', 'users');
}
