<?php
/**
 * ProfileManagerCustomProfileType
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

class ProfileManagerCustomProfileType extends ElggObject {

	const SUBTYPE = "custom_profile_type";
	
	/**
	 * initializes the default class attributes
	 *
	 * @return void
	 */
	protected function initializeAttributes() {
		parent::initializeAttributes();
		
		$this->attributes['subtype'] = self::SUBTYPE;
		$this->attributes['access_id'] = ACCESS_PUBLIC;
		$this->attributes['owner_guid'] = elgg_get_site_entity()->getGUID();
		$this->attributes['container_guid'] = elgg_get_site_entity()->getGUID();
	}

	/**
	 * Returns the title of the type
	 *
	 * @return string
	 */
	public function getTitle() {
		/* make title para Teranga
		$title = $this->metadata_label;
		//system_message("profile:types:{$this->metadata_name}");//parece que esto lo traduce bien
		if (empty($title)) {
			if (elgg_language_key_exists("profile:types:{$this->metadata_name}")) {
				$title = elgg_echo("profile:types:{$this->metadata_name}");
			} else {
				$title = $this->metadata_name;
			}
		}*/
		$title = elgg_echo("profile:types:{$this->metadata_name}");
		return $title;
	}

	/**
	 * Returns the description (potentially translated) of the type
	 *
	 * @return string
	 */
	public function getDescription() {
		/* make title para Teranga
		$description = $this->metadata_description;
		if (empty($description)) {
			if (elgg_language_key_exists("profile:types:{$this->metadata_name}:description")) {
				$description = elgg_echo("profile:types:{$this->metadata_name}:description");
			}
		}*/
		$description = elgg_echo("profile:types:{$this->metadata_name}:description");
		return $description;
	}
}
