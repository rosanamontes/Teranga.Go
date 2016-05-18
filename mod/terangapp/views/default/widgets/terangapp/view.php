<?php
    
/**
* 	Plugin: TerangApp Popup Plugin
*	Author: Rosana Montes Soldado from previous version of Marek Lompart
*			Universidad de Granada
*	Licence: 	CC-ByNCSA
*	Reference:	Microproyecto CEI BioTIC Ref. 11-2015
* 	Project coordinator: @rosanamontes
*	Website: http://lsi.ugr.es/rosana
* 	Resources: <A HREF="javascript:void(window.close('http://funradio.sk/play?select=1'))">close radio</A><BR>
*	
*	File: view widget 
*/    


if (elgg_get_plugin_setting('beta_version', 'terangapp') == 'yes')
{
	$icono = elgg_get_site_url() . "mod/terangapp/image/icono_version_beta.png";
	echo "<img src='".$icono."' title='Terangapp beta'>";
}
else
{
	$link = elgg_get_plugin_setting('opinaugr_link', 'terangapp');
	echo "<center><form>" . 
		"<input class='terangapp' type='image' src='" . $vars['url'] . 
		"mod/terangapp/image/button.png' width='128' alt='Teranga Go! App' border='0' onClick='gopopup(". $link .")'>
		</form></center>";
}	 

?>

<SCRIPT LANGUAGE="JavaScript">

function gopopup(x) 
{
	alert(x);
	dialog =window.open("http://apps.ugr.es/app_opinaugr.html",'App para Teranga Go!','toolbar=0,location=0,directories=0,status=0,menubar=0,scrollbars=0,resizable=0,width=800, height=600' ); 

	dialog.blur();
}
</SCRIPT> 





		

