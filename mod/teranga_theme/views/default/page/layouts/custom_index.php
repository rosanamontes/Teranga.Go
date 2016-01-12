<?php
/**
 * Elgg custom index layout
 * 
 * You can edit the layout of this page with your own layout and style. 
 * Whatever you put in this view will appear on the front page of your site.
 * 
 */

$mod_params = array('class' => 'elgg-module-highlight');
$et2forms = elgg_get_plugin_setting('et2forms','teranga_theme');
?>

<div class="custom-index elgg-main elgg-grid clearfix" style="max-width: 100%; ">
<div class="et-latest" style="">	
	<?php



// members
echo elgg_view_module('featured',  elgg_echo("custom:members"), $vars['members'], $mod_params);

// blogs
if (elgg_is_active_plugin('blog')) {
	echo elgg_view_module('featured',  elgg_echo("custom:blogs"), $vars['blogs'], $mod_params);
}
// groups
if (elgg_is_active_plugin('groups')) {
	echo elgg_view_module('featured',  elgg_echo("custom:groups"), $vars['groups'], $mod_params);
}

// bookmarks
//if (elgg_is_active_plugin('bookmarks')) {
//	echo elgg_view_module('featured',  elgg_echo("custom:bookmarks"), $vars['bookmarks'], $mod_params);
//}

// files
//if (elgg_is_active_plugin('file')) {
//	echo elgg_view_module('featured',  elgg_echo("custom:files"), $vars['files'], $mod_params);
//}

?>
</div>

<div class="et-module-intro" >
<?php include elgg_get_data_path() . "teranga_theme/intro.php"; ?> 
</div>

	<div class="elgg-col elgg-col-1of2">
		<div class="elgg-inner pvm">




<?php

// a view for plugins to extend
echo elgg_view("index/righthandside");
if (!elgg_is_logged_in() && $et2forms == 'yes') {
echo "<div class='et-register'>";
echo "<h3>Register</h3>";
echo elgg_view_form('register');
echo"</div>";
}
?>

<div class="et-module-text-right">
<?php //include elgg_get_data_path() . "teranga_theme/textright.php"; ?> 
</div>

		</div>
	</div>
</div>
