<?php
/**
 * Message on members only, closed membership group profile pages when user
 * cannot access group content.
 *
* 	Plugin: mytripsTeranga
*	Author: Rosana Montes Soldado from previous version of @package ElggGroups
*			Universidad de Granada
*	Licence: 	CC-ByNCSA
*	Reference:	Microproyecto CEI BioTIC Ref. 11-2015
* 	Project coordinator: @rosanamontes
*	Website: http://lsi.ugr.es/rosana
* 	Project colaborator: Antonio Moles 
*	
*   Project Derivative:
*	TFG: Desarrollo de un sistema de gestión de paquetería para Teranga Go
*   Advisor: Rosana Montes
*   Student: Ricardo Luzón Fernández
*/

?>
<p class="mtm">
<?php
echo elgg_echo('mytrips:closedgroup:membersonly');
if (elgg_is_logged_in()) {
	echo ' ' . elgg_echo('mytrips:closedgroup:request');
}
?>
</p>