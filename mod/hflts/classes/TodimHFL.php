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
*	File: Couping Wei, Rosa. IJCIS'15
*
* 	@package DecisionMaking
*
*/


class TodimHFL extends MCDM
{

	var $label;//shortname
	var $CSi; //array with lower interval values (for all criteria)
	var $CSj; //array with upper interval values (for all criteria)
	
	var $beta; //2-tuples
	var $avg; //average aggregation array
	var $ranking; //alternatives ranked array

	public function	TodimHFL($username)
	{
		$this->N=1;
		$this->M=3;
		$this->P=$this->num=0;
		$this->label="todim";

		$this->alternatives = array($username);
		$this->W = array(1.0, 1.0, 1.0); //same important
	}

	public function realEstateCase()
	{
		$this->N=5; //numero de alternatives
		$this->M=9; //numero de criterios
		$this->P=5; //numero de expertos
		
	    $this->alternatives = array('C-1','C-2','C-3','C-4','C-5');
		$this->W = array(1.0, 1.0, 0.5,0.8, 0.7, 0.7, 1.0, 0.8, 0.4); //9 pesos del usuario 1
		
		$this->parse_csv();		
		$this->num = $this->N*$this->P;
		
		$this->translation();
		$this->envelope();

		$this->average();
		$this->ranking();
	}
	
	public function run()
	{
		//self::realEstateCase();

		parent::run();

		$this->ranking();	

		return $this->ranking[0]['todim']['label'];
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


    private function ranking()
    {
    	if ($this->debug)
    	{
    		echo('<br>Ranking <pre>');	print_r($this->ranking);	echo('</pre>');
    	}
    	return $this->ranking;
    }

}
