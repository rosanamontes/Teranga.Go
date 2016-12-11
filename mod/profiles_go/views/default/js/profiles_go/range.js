/**
* 	Plugin: Valoraciones linguisticas con HFLTS
*	Author: Rosana Montes Soldado
*			Universidad de Granada
*	Licence: 	CC-ByNCSA
*	Reference:	Microproyecto CEI BioTIC Ref. 11-2015
* 	Project coordinator: @rosanamontes
*	Website: http://lsi.ugr.es/rosana
*	
*	File: input/range
*		Javascript para un input/range asociado a un criterio de valoracion en el perfil de usuario. 
*/

elgg.provide("elgg.profiles_go");


elgg.profiles_go.ready = function()
{	
	$(".profile-manager-input-pm-range").on('change', function(event)
	{	
		var slider = event.target.id;
		var value = event.target.value;
		var id = slider.substring(7, slider.lenght);
 		
        $("label[for='"+id+"']").text(value+" %");

		document.getElementById(id).value = value;//hidden
		//alert(id + " - " + document.getElementById(id).value);        
	});
}

//register init hook
elgg.register_hook_handler("init", "system", elgg.profiles_go.ready);