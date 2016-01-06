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
*	File: Huchang Liao IEEE-TFS'14
*
* 	@package DecisionMaking
*
*/


class VikorHFL extends MCDM
{

	var $label;//shortname


	var $ranking; //alternatives ranked array

	public function	VikorHFL($username)
	{
		$this->N=1;
		$this->M=3;
		$this->P=$this->num=0;
		$this->label="vikor";

		$this->alternatives = array($username);
		$this->W = array(1.0, 1.0, 1.0); //same important

		//inicializar variables y arrays
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


	public function vikorCase()
	{
		$this->N=4; //numero de alternatives
		$this->M=4; //numero de criterios
		$this->P=1; //numero de expertos
		$this->alternatives = array('p1','p2','p3','p4');
		$this->W = array(0.2, 0.15, 0.15,0.5);

		$this->parse_csv("ejemplo_vikor.csv");	
		//$this->testing();
	}

	public function todimCase()
	{
		$this->N=4; //numero de alternatives
		$this->M=4; //numero de criterios
		$this->P=1; //numero de expertos
		$this->alternatives = array('p1','p2','p3','p4');
		$this->W = array(0.2, 0.15, 0.15,0.5);

		$this->parse_csv("ejemplo_todim.csv");	
		//$this->testing();
	}

	public function realEstateCase()
	{
		$this->N=5; //numero de alternatives
		$this->M=9; //numero de criterios
		$this->P=5; //numero de expertos
		
	    $this->alternatives = array('C-1','C-2','C-3','C-4','C-5');
		$this->W = array(1.0, 1.0, 0.5,0.8, 0.7, 0.7, 1.0, 0.8, 0.4); //9 pesos del usuario 1
		
		$this->parse_csv("ejemplo_casas.csv");	
	}
	
	public function run()
	{
		//self::realEstateCase();

		parent::run();

		$this->ranking();	

		return $this->ranking[0]['vikor']['label'];
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
