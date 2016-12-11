<?php
/**
 * ProfileManagerCustomFieldCategory
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

class ProfileManagerCustomFieldCategory extends ElggObject {

	const SUBTYPE = "custom_profile_field_category";
	
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
	 * Returns the title of the category
	 *
	 * @return string
	 */
	public function getTitle() {
		/* make title for Teranga
		$title = $this->metadata_label;

		if (empty($title)) {
			if (elgg_language_key_exists("profile:categories:{$this->metadata_name}")) {
				$title = elgg_echo("profile:categories:{$this->metadata_name}");
			} else {
				$title = $this->metadata_name;
			}
		}*/
		$title = elgg_echo("profile:categories:{$this->metadata_name}");
		return $title;
	}

	/**
	 * Returns an array of linked profile type guids
	 *
	 * @return void
	 */
	public function getLinkedProfileTypes() {
		$types = $this->getEntitiesFromRelationship(array(
			'relationship' => CUSTOM_PROFILE_FIELDS_PROFILE_TYPE_CATEGORY_RELATIONSHIP,
			'inverse_relationship' => true,
			'limit' => false
		));
		
		if ($types) {
			$result = array();
			
			foreach ($types as $type) {
				$result[] = $type->getGUID();
			}
		} else {
			// return 0 as the default
			$result = array(0);
		}
		
		return $result;
	}
}
