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
*	File: Agregación clasica con HFLTS - Rosa'12
*
* 	@package DecisionMaking
*
*/


class AggregationHFLTS extends MCDM
{
	var $label;//shortname

	public function	AggregationHFLTS()
	{
		$this->N=1;
		$this->M=3;
		$this->P=$this->num=0;
		$this->label="classic";
		$this->collectiveTerm = "excelent";
	}
	
	/**
	 * Returns the title of the method
	 *
	 * @return string
	 */
	public function getTitle() 
	{
		// make title for Teranga
		$header = $this->label;
		system_message($this->label . " title " . $header);
		$header = elgg_echo("hflts:label:{$this->label}");
		return $header;
	}
		
	/**
	 * Returns the method full name
	 *
	 * @return string
	 */
	public function getDescription() 
	{
		// Make name for Teranga
		$result = $this->label;
		system_message("description " . $result);
		$result = elgg_echo("hflts:help:{$this->label}");
		return $result;
	}

	public function run()
	{
		parent::run();
		return 5;
	}

}
