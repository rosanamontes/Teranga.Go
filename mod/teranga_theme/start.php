<?php
elgg_register_event_handler('init', 'system', 'teranga_theme_init');

function teranga_theme_init() 
{
	// theme specific CSS
	elgg_extend_view('css/elgg', 'teranga_theme/css');
	elgg_extend_view('css/walled_garden', 'teranga_theme/walled_garden');

	elgg_register_plugin_hook_handler('head', 'page', 'teranga_theme_head');
	//elgg_register_plugin_hook_handler('head', 'page', 'teranga_theme_setup_head'); 

	elgg_unregister_menu_item('topbar', 'elgg_logo');
        elgg_extend_view('css/admin', 'teranga_theme/admin'); 
        elgg_extend_view ('page/elements/head','teranga_theme/meta');

	$base = elgg_get_plugins_path() . 'teranga_theme/actions/teranga_theme';
	elgg_register_action('teranga_theme/settings/save', "$base/save.php", 'admin');

	// non-members do not get visible links to RSS feeds
	if (!elgg_is_logged_in()) {
		elgg_unregister_plugin_hook_handler('output:before', 'layout', 'elgg_views_add_rss_link');
		elgg_register_plugin_hook_handler('index','system','teranga_theme_index');
	}

   
}


function teranga_theme_head($hook, $type, $data) {
	$data['metas']['viewport'] = array(
		'name' => 'viewport',
		'content' => 'width=device-width, initial-scale=1.0',
	);

	return $data;
}


function teranga_theme_index() {
    if (!include_once(dirname(dirname(__FILE__)) . "/teranga_theme/index.php"))
        return false;
 
    return true;
}




