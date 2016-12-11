<?php
/**
 * ProfileManagerCustomTripField
 *
* 	Plugin: profiles_go from previous version of @package profile_manager of Coldtrick IT Solutions 2009
*	Author: Rosana Montes Soldado 
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
* 
*/

class ProfileManagerCustomTripField extends ProfileManagerCustomField 
{

	const SUBTYPE = "custom_trip_field";
	
	/**
	 * initializes the default class attributes
	 *
	 * @return void
	 */
	protected function initializeAttributes() {
		parent::initializeAttributes();
	}

	/**
	 * Returns the title of the field
	 *
	 * @return string
	 */
	public function getTitle() {
		/* make title for Teranga
		$title = $this->metadata_label;
		
		if (empty($title)) {
			if (elgg_language_key_exists("trips:{$this->metadata_name}")) {
				$title = elgg_echo("trips:{$this->metadata_name}");
			} else {
				$title = $this->metadata_name;
			}
		}*/
		$title = elgg_echo("trips:{$this->metadata_name}");
		return $title;
	}
}
