<?php

// register for the init, system event when our plugin start.php is loaded
elgg_register_event_handler('init', 'system', 'hflts_init');

function hflts_init() 
{
	elgg_register_page_handler('hflts', 'hflts_page_handler');
	
	// register a library of helper functions
	//elgg_register_library('hflts:library', elgg_get_plugins_path() . 'hflts/lib/hflts.php');

	// add to site links only in case of make the model result public
	if (elgg_is_logged_in()) {
		$item = new \ElggMenuItem('hflts', elgg_echo('hflts'), 'hflts');
		elgg_register_menu_item('site', $item);
	}


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

	//teranga add user_hover_menu entry ==> PROBLEMA: no llega el valor de params
	elgg_register_plugin_hook_handler('register', 'menu:user_hover', 'hflts_user_hover_menu');

}

function hflts_page_handler($page)
{
	set_input('username', $page[0]);//necesario
	$page_owner = elgg_get_page_owner_entity();// ej strem
	$owner_guid = elgg_get_page_owner_guid();// id de strem

	//aqui es donde tengo que filtrar por
	$valorations = elgg_list_entities_from_metadata([
		'type' => 'object',
		'subtype' => 'evaluation_content',
		'limit' => $vars['entity']->num_display,
		'pagination' => false,
		'order_by_metadata' => [
			'name' => 'state',
			'direction' => 'ASC',
			'as' => 'text',
		],
	]);
	if (!$list) {
		$list = '<p class="mtm">' . elgg_echo('evaluationcontent:none') . '</p>';
	}	
	$content = elgg_view('hflts/driver', array('valorations' => $valorations));


	$params = array(
		'title' => 'Valoraciones de '.$page_owner->name,
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
		//$url = "hflts/resources/hflts/list?uid={$user->guid}";
		//$url = "groups/owner/{$user->username}";

		$item = new \ElggMenuItem('hflts:user', elgg_echo('hflts:menuhover'), $url);
		$item->setSection('admin');//default + elgg_get_logged_in_user_guid() | admin + elgg_is_admin_logged_in
		//$item->setConfirmText(elgg_echo('confirm'));//saca un are you sure
		$return[] = $item;
	}
	return $return;	
}


?>
