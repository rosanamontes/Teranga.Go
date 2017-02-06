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
*	File: info at profile 
*/


if ($vars['size'] == 'large') {
    if (elgg_get_plugin_setting('profile_display', 'teranga_idss')) 
    {
		$vars['entity']->karma = userKarma($vars['entity']->guid);
		if (!$vars['entity']->nValorations) 
			$vars['entity']->nValorations = 0;
?>

        <div class="teranga_idss_profile">
            <div><?php echo elgg_echo('teranga_idss:profile') . ': <span style="color:#F05A23">' . $vars['entity']->karma;?></span></div>
            <div><?php echo elgg_echo('teranga_idss:number') . ' <span style="color:#F05A23">'   . $vars['entity']->nValorations . '</span> ' . elgg_echo('teranga_idss:users');?></div>
        </div>

    <?php } ?>
<?php } ?>
