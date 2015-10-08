<?php

action_gatekeeper();

/**
 * Saves global plugin settings.
 *
 * This action can be overriden for a specific plugin by creating the
 * settings/<plugin_id>/save action in that plugin.
 *
 * @uses array $_REQUEST['params']    A set of key/value pairs to save to the ElggPlugin entity
 * @uses int   $_REQUEST['plugin_id'] The ID of the plugin
 *
 * @package Elgg.Core
 * @subpackage Plugins.Settings
 */


$params = get_input('params');
$plugin_id = get_input('plugin_id');
$plugin = elgg_get_plugin_from_id($plugin_id);

if (!($plugin instanceof ElggPlugin)) {
	register_error(elgg_echo('plugins:settings:save:fail', array($plugin_id)));
	forward(REFERER);
}
$plugin_name = $plugin->getManifest()->getName();
$result = false;

//this bit sets the settings...

	foreach ($params as $k => $v) {
   	$result = $plugin->setSetting($k, $v);
		if (!$result) {
			register_error(elgg_echo('plugins:settings:save:fail', array($plugin_name)));
			forward(REFERER);
			exit;
		}
	}
	
	
// does directory exist

    $dirname = "teranga_theme"; 
    $filename = elgg_get_data_path() . "{$dirname}/";     
    if (!file_exists($filename)) { 
         mkdir(elgg_get_data_path() . "{$dirname}", 0777);         
    }  	
	

$et2color1 = elgg_get_plugin_setting('et2color1','teranga_theme');
$et2color2 =  elgg_get_plugin_setting('et2color2','teranga_theme');
$et2_bkimg = 'url(\'<?php echo elgg_get_site_url(); ?>mod/teranga_theme/graphics/bkgr.jpg\')';
$et2_headimg = 'url(\'<?php echo elgg_get_site_url(); ?>mod/teranga_theme/graphics/headimg.jpg\')';
$et2footh =  elgg_get_plugin_setting('et2footh','teranga_theme');
$et2footbk =  elgg_get_plugin_setting('et2footbk','teranga_theme');
$et2footlink = elgg_get_plugin_setting('et2footlink','teranga_theme');
$et2foothov = elgg_get_plugin_setting('et2foothov','teranga_theme');
$et2foottext = elgg_get_plugin_setting('et2foottext','teranga_theme');
$et2search = elgg_get_plugin_setting('et2search','teranga_theme');
$et2intro = elgg_get_plugin_setting('et2intro','teranga_theme');
$et2menu = elgg_get_plugin_setting('et2menu','teranga_theme');
$et2menua = elgg_get_plugin_setting('et2menua','teranga_theme');
$et2menu1 = elgg_get_plugin_setting('et2menu1','teranga_theme');
$et2menu2 = elgg_get_plugin_setting('et2menu2','teranga_theme');
$et2textleft = elgg_get_plugin_setting('et2textleft','teranga_theme');
$et2textright = elgg_get_plugin_setting('et2textright','teranga_theme');
$et2forms = elgg_get_plugin_setting('et2forms','teranga_theme');
//this bit writes the file...
$file = elgg_get_data_path() . "teranga_theme/cssinc.php";
$fileHandle = fopen($file, 'w') or die("Error opening file");
 
$data = "html {
    -ms-text-size-adjust: 100%;
    -webkit-text-size-adjust: 100%;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
}
body {
    background: $et2_bkimg;
}
img {
    max-width: 100%;
    height: auto;
    border: 0;
} 
.elgg-page-topbar {
    background: $et2menu1;
    border-bottom: 2px solid $et2menu2;
    padding: 6px 10px;
    height: 22px;    
}
.elgg-breadcrumbs > li > a:hover {
    color: $et2color1;
    text-decoration: underline;
}
/* ***************************************
	SITE MENU 
*************************************** */
.elgg-menu-site-default {	
    display: none;
}
.et-site-menu li.elgg-more > a{
    color: #333;
    margin-left: 0px;
    margin-top: 8px;
    font-size: 2em;
    border-bottom: 0px;
    pointer-events: none;
    cursor: default;
}
.et-site-menu li.elgg-more:hover {
    margin-top: 8px;
}
.et-site-menu .elgg-menu-site-more {
    width: 250px;
    margin-left: -20px;
    margin-top: -15px;
    border-radius: 0 0 0 0;
    box-shadow: 0 0 0 0;
}
.et-site-menu .elgg-menu-site > li > ul {
    border: 0px;
    border-top: 0;    
    min-width: 200px;
}
.et-site-menu .elgg-menu-site-more > li > a{
    background: #ccc;
    padding-left: 10px;
    padding-right: 10px;
}
.elgg-menu-site-more > li > a:hover, .elgg-menu-site-more > li > a:focus {
    background: $et2menu2 !important;
    color: #fff;
}
.elgg-menu-site-default > .elgg-state-selected > a, .elgg-menu-site-default > li:hover > a {
    border: 2px solid $et2menu2; 
    color: $et2menu2;
    box-shadow: 0px 0px 0px rgba(0, 0, 0, 0);
    border-radius: 0;
    margin: -2px -2px 0 -2px;  
}
.elgg-menu-site-more > li:last-child > a, .elgg-menu-site-more > li:last-child > a:hover {
    box-shadow: 0px 0px 0px rgba(0, 0, 0, 0);    
    border-radius: 0;
    }
/* ***************************************
	END SITE MENU 
*************************************** */
.elgg-menu-page a:hover {
    background-color: $et2color1; 
    color: white;
    text-decoration: none;
}
.elgg-menu-owner-block li a:hover {
    background-color: $et2color1; 
    color: white;
    text-decoration: none;
}
a {
    color: $et2color2;
}
h1, h2, h3, h4, h5, h6 {
    font-weight: bold;
    color: $et2color1; 
}
.elgg-heading-basic {
    color: $et2color1;
    font-size: 1.2em;
    font-weight: bold;
}
.elgg-loud {
    color: $et2color1; 
}
.elgg-menu-page li.elgg-state-selected > a {
    background-color: $et2color1; 
    color: white;
}
.elgg-heading-site, .elgg-heading-site:hover, .elgg-heading-site:focus{
    display: block;
    font-size: 1.5em;
    line-height: 0.6em;
    color: $et2menua;
    padding: 10px;	
}
.elgg-page-default .elgg-page-header  .elgg-inner {
    display: inline-block;
    width: 100%;
    border: 0;
    max-width: 1238px;  
    background-color: $et2menu;
    height: 125px;
}
.elgg-page-header {
    background: 0;
    padding: 0px 0px;   
}
.elgg-page-default .elgg-page-header .elgg-inner h1{
    background-color: $et2menu;
    height: 65px;
    padding-top: 15px;
    padding-left: 20px;
    
}
.elgg-page-default {
    width: 99%;
    max-width: 1238px;
    margin: 0px auto; 
    border-right: 2px solid #eee;
    background: #ffffff;
    border-left: 2px solid #eee;
    min-width: 300px;  
	-moz-box-shadow: 0 0 0 #eee;
	-webkit-box-shadow: 0 0 0 #eee;
	box-shadow: 0 0 0 #eee;
}
.elgg-page-footer {
    height: $et2footh;
    color: $et2foottext; 
    background: $et2footbk;   
}
.elgg-page-footer a:link {
    color: $et2footlink;
}      
.elgg-page-footer a:hover {
    color: $et2foothov;
}
.elgg-menu-item-report-this{
    margin-left: 10px;
    margin-top: 5px;
}
#login-dropdown {
    top: -2px;
    margin-right: 10px;          
}
.elgg-button-dropdown {
    background-color: $et2menu1;
    border: 1px solid $et2menu1;
    box-shadow: 0.1px 0.1px 1px #000;    
}
.elgg-button-dropdown:hover{
    background-color: $et2menu2;
    border: 1px solid $et2menu2;
    color: #eee;
}
.elgg-page-default .elgg-page-body > .elgg-inner {
    width: 100%;
    margin: 0 auto;        	
}
.elgg-page-default .elgg-page-footer > .elgg-inner {
    width: 100%; 
    margin: 0 auto;
    padding: 5px 0;
    border-top: 0px solid #dedede;	
}
.et2headerimg{
    display: inline-block;
    max-height: 0px;
    border-bottom: 49px solid #eee;
    margin-bottom: -24px;
}
.elgg-page-header .elgg-search {
    margin-top: $et2search;
    margin-bottom: 2px;
    margin-right: 0px;
    height: 23px;
    position: absolute;
    right: 0;
    background: #eee;
    padding: 12px;   
}
.elgg-menu-item-powered {
    visibility: hidden;
}
.elgg-menu-footer-default {
    float: right;
    padding-right: 10px;
}
.elgg-layout-one-sidebar {
    background: #fff;    
}
.elgg-button-submit {
  background: $et2menu;
  background-image: -webkit-linear-gradient(top, $et2menu, $et2menu2);
  background-image: -moz-linear-gradient(top, $et2menu, $et2menu2);
  background-image: -ms-linear-gradient(top, $et2menu, $et2menu2);
  background-image: -o-linear-gradient(top, $et2menu $et2menu2);
  background-image: linear-gradient(to bottom, $et2menu, $et2menu2);
  -webkit-border-radius: 6;
  -moz-border-radius: 6;
  border-radius: 6px;
  color: #fff;
  font-size: 12px;
  padding: 8px 12px 8px 11px;
  text-decoration: none;
  border: 0;
}
.elgg-button-submit:hover {
   background: #000;
  background-image: -webkit-linear-gradient(top, #000, $et2menu2);
  background-image: -moz-linear-gradient(top, #000, $et2menu2);
  background-image: -ms-linear-gradient(top, #000, $et2menu2);
  background-image: -o-linear-gradient(top, #000, $et2menu2);
  background-image: linear-gradient(to bottom, #000, $et2menu2);
  text-decoration: none;
  color: #fff;
  border: 0;
}
.elgg-col-1of2 {
    width: 100%;
}
.elgg-main{
    width: 100%;
    padding: 20px 0 0 0px;
}
.elgg-sidebar{
    width: 98%;
}
.et-tb-menu { 
    position: absolute;
    top: -32px;
    right: 0px;
    padding: 5px;
    z-index: 12000;
    color: $et2menua;
}     
.et-tb-ddown {
    position: absolute;
    top: 0px;
    right: 0px;
    width: 200px;
    background: #000;
    height: 80px;
    background: $et2menu2;
    z-index: 10000; 
}  
.et-tb-ddown .elgg-menu {
    background: $et2menu2;
}
 .et-tb-ddown .elgg-menu a {
    padding: 2px 0 2px 0;
    color: #fff;
} 
.et-nav {
    display: inline-block;
    position: absolute;
    padding-top: 1px;
    top: 80px;
    height: 43px;
    width: 50px;
    font-size: 42px;
    text-align: center;
    font-weight: 700;
    font-style: normal;
    background: #ccc;
    color: #fff;    
}
.elgg-menu-topbar-alt {
    display: none; 
}
#profile-owner-block {
    width: 200px;
    float: none;
    background-color: #EEE;
    padding: 15px;
}
.elgg-col-1of3, .elgg-col-2of3{
    width: 100%;
    min-height: 0px !important; 
}
#groups-tools > li {
width: 100%;
}
.groups-profile-fields {
    width: 100%;
}
.groups-stats {
    margin-bottom: 10px;
}
/* ***************************************
	& MAX-WIDTH 481
*************************************** */  
@media only screen and (max-width: 481px) { 
.et-site-menu .elgg-menu-site {  
    top: 20px;
    left: 10px;
    display: inline-block; 
}  
.et-site-menu {
    position: absolute;
    margin-top: 165px;
    margin-left: 2px;
    min-width: 250px;
    width: 250px;
    padding-top: 10px;  
    background: #ccc;
    min-height: 307px; 
    z-index: 1000; 
}    
 .et-site-menu .elgg-menu-content{
    color: #fff; 
    font-size: 2em; 
    min-width: 200px;
    padding-bottom: 5px;
    padding-top: 10px;
    border-bottom: 2px solid #fff; 
}  
.elgg-menu-site-default > .elgg-state-selected > a, .elgg-menu-site-default > li:hover > a {
    color: #fff;
    background: 0; 
    font-size: 2em; 
    min-width: 200px;
    margin: 0 0 0 0;
    border: 0;
    border-bottom: 2px solid #fff; 
}  
}
/* ***************************************
	481 & UP
*************************************** */
@media only screen and (min-width: 481px) {
.elgg-menu-site > li > ul {
    border: 2px solid $et2menu2;
    border-top: 0;    
}
.elgg-menu-site-more > li > a {
    color: $et2menu2;
}
.elgg-menu-site-more > li > a:hover, 
.elgg-menu-site-more > li > a:focus {	
    background: $et2color1; 
    color: $etmenua;	
}
.elgg-menu-site-more {
    left: 0px;
    min-width: 100px;
    border: 0;
    border-radius: 0;
    box-shadow: 0px 0px 0px rgba(0, 0, 0, 0);
    margin: -2px -2px 0 -2px;        
}
.elgg-menu-site-default {
    display: inline-block;
    top: 75px;
    height: 45px;
    margin-left: 2px;    
}
.elgg-menu-topbar > li > a{
    color: $et2menua;
}
.elgg-menu-topbar > li > a:hover{
    color: #ccc;
}
.elgg-menu-site-default > li > a {
    color: $et2menua;
}
li.elgg-more {
    width:100px;
}
.et-tb-menu {
    position: absolute;
    top: -32px;
    right: 0px;
    padding: 5px;
    z-index: 12000; 
    color: $et2menua;
} 
.et-tb-ddown {
    height: 100px;
}
.et-site-menu {
    visibility: hidden; 
}    
.et-nav {
    display: none;
}    
.elgg-page-default .elgg-page-header  .elgg-inner h1{
    background-color: $et2menu;
    height: 85px;
    padding-top: 15px;
    padding-left: 20px;
}
#profile-owner-block {
    width: 200px;
    float: left;
    background-color: #EEE;
    padding: 15px;
}
.groups-profile-fields {
    width: 48%;
}
}
/* ***************************************
	768 & UP
*************************************** */
@media only screen and (min-width: 768px) {	
.elgg-col-1of2 {
    width: 50%;	
}
.elgg-main{
    float: left;
    max-width: 65%;
}
.elgg-sidebar {
    position: relative;
    padding: 20px 10px;
    float: right;
    width: 210px;
    margin: 0px 0px 0px 10px;
}
.et2headerimg{
    display: inline-block;
    max-height: 800px;
    border-bottom: 49px solid #eee;
    margin-bottom: -24px;
}
.elgg-menu-site-default {	
    top: 37px;	
    height: 45px;	
    margin-left: 38%;	
}
.elgg-heading-site, .elgg-heading-site:hover, .elgg-heading-site:focus{
    padding: 20px;
}
.et-tb-menu { 
    display: none; 
}
.et-tb-ddown {
    visibility: hidden;
}  
.elgg-menu-topbar-alt {
    display: inline-block; 
}
.elgg-col-2of3 {
    width: 66.66%;
}
.elgg-col-1of3 {
    width: 33.33%;
    min-height: 500px !important;
}
#groups-tools > li {
width: 48%;
}
}
/* ***************************************
	1024 & UP
*************************************** */
@media only screen and (min-width: 1024px) {
.elgg-menu-site-default {	
    top: 37px;	
    height: 45px;	
    margin-left: 53%;	
}
}
/* ***************************************
	1240 & UP
*************************************** */
@media only screen and (min-width: 1240px) {
.elgg-menu-site-default {	
    top: 37px;	
    height: 45px;	
    margin-left: 61%;	
}	
}";


fwrite($fileHandle, $data); 
fclose($fileHandle); // close the file since we're done

if (empty($et2intro)) {
	}
	else{
//this bit writes the file...
$file2 = elgg_get_data_path() . "teranga_theme/intro.php";
$fileHandle = fopen($file2, 'w') or die("Error opening file"); 
$data = $et2intro;
fwrite($fileHandle, $data); 
fclose($fileHandle);
elgg_unset_plugin_setting ('et2intro','teranga_theme');
}

if (empty($et2textleft)) {
	}
	else{
//this bit writes the file...
$file3 = elgg_get_data_path() . "teranga_theme/textleft.php";
$fileHandle = fopen($file3, 'w') or die("Error opening file"); 
$data = $et2textleft;
fwrite($fileHandle, $data); 
fclose($fileHandle);
elgg_unset_plugin_setting ('et2textleft','teranga_theme');
}

if (empty($et2textright)) {
	}
	else{
//this bit writes the file...
$file4 = elgg_get_data_path() . "teranga_theme/textright.php";
$fileHandle = fopen($file4, 'w') or die("Error opening file"); 
$data = $et2textright;
fwrite($fileHandle, $data); 
fclose($fileHandle);
elgg_unset_plugin_setting ('et2textright','teranga_theme');
}



elgg_invalidate_simplecache();
elgg_reset_system_cache();
system_message(elgg_echo('plugins:settings:save:ok', array($plugin_name)));
forward(REFERER);
