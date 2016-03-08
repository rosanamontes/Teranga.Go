<?php
/**
 * Elgg header logo
 */

$site = elgg_get_site_entity();
$site_name = $site->name;
$site_url = elgg_get_site_url();
?>

<a class="" rel="popup" href="#menu-toggle"><h2 class="et-nav">&#9776;</h2>  
<a class="" rel="toggle" href="#topbar-toggle"><p class="et-tb-menu">Account &#x2699;</p> 
<div id="topbar-toggle" class="et-tb-ddown hidden">
    <div class="elgg-inner">
	<ul class="elgg-menu ">
        <li class="elgg-menu-item-administration"><a href="<?php echo $site_url; ?>admin" class="elgg-menu-content" style="margin-left: 20px;">Administration</a></li>
        <li class="elgg-menu-item-usersettings"><a href="<?php echo $site_url; ?>settings" class="elgg-menu-content" style="margin-left: 20px;">Settings</a></li>
        <li class="elgg-menu-item-logout"><a href="<?php echo $site_url; ?>action/logout" class="elgg-menu-content" style="margin-left: 20px;">Log out</a></li>
        </ul>
    </div>
</div>

<div id="menu-toggle" class="et-site-menu hidden">
    <?php echo elgg_view_menu('site', array('sort_by' => 'priority', array('et-site-ddown'))); ?>
</div>


<!-- LOGO HERE? <?php echo $site_name; ?>   <a href="<?php echo elgg_get_site_url(); ?>"></a>     -->


<h1>
    <a class="elgg-heading-site" href="<?php echo $site_url; ?>">
    <img border="0" src="<?php echo elgg_get_site_url(); ?>mod/teranga_theme/graphics/logo.png" />	
    </a>
</h1>
<img class="et2headerimg" style="width: 100%; height: auto;" src="<?php echo elgg_get_site_url(); ?>mod/teranga_theme/graphics/headimg.jpg" />







