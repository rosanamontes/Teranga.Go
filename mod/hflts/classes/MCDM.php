<?php
/**
 * Tipo de problema MCDM
 *
 * @package DecisionMaking
 *
 */
abstract class MCDM //extends ElggObject 
{
	var $data;//valoraciones de los expertos para cada alternativa y criterio
	var $num;//numero de valoraciones
	
	var $N; //numero de alternativas
	var $M; //numero de criterios
	var $P; //numero de expertos

	
	/**
	 * initializes the default class attributes
	 *
	 * @return void
	 */
	protected function initializeAttributes() 
	{
		parent::initializeAttributes();
		
		$this->attributes['access_id'] = ACCESS_PRIVATE; //ACCESS_PUBLIC || DEFAULT || _LOGGED_IN
		$this->attributes['owner_guid'] = elgg_get_site_entity()->getGUID();
		$this->attributes['container_guid'] = elgg_get_site_entity()->getGUID();

		$N=1;
		$M=3;
		$P=$num=0;
		system_message("inicializado");
	}
	
	
	/**
	 * Returns the title of the method
	 *
	 * @return string
	 */
	public function getTitle() 
	{
		// make title for Teranga
		$title = $this->metadata_label;

		if (empty($title)) 
		{
			system_message("empty mcdm " . $result);
			if (elgg_language_key_exists("hflts:label:{$this->metadata_name}")) {
				$title = elgg_echo("hflts:label:{$this->metadata_name}");
			} else {
				$title = $this->metadata_name;
			}
		}
		$title = elgg_echo("hflts:label:{$this->metadata_name}");
		return $title;
	}
		
	/**
	 * Returns the method name
	 *
	 * @return string
	 */
	public function getDescription() 
	{
		// Make name for Teranga
		$result = $this->metadata_description;
		
		if (empty($result)) 
		{
			system_message("empty mcdm " . $result);
			if (elgg_language_key_exists("hflts:help:{$this->metadata_name}")) {
				$result = elgg_echo("hflts:help:{$this->metadata_name}");
			}
		}
		$result = elgg_echo("hflts:help:{$this->metadata_name}");
		return $result;
	}

}
