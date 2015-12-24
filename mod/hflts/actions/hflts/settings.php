<?php
/**
 * Save the plugin settings
 */

$simple_settings = [
	'profile_display',
	'termset',
	'classic',
	'vilkor',
	'topsis',
	'electre',
	'promethee',
];
foreach ($simple_settings as $setting) {
	elgg_set_plugin_setting($setting, get_input($setting), 'hflts');
}

elgg_flush_caches();

system_message(elgg_echo('hflts:settings:success'));

forward(REFERER);
