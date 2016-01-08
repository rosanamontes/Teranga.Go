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
*	File: onia Hajlaoui IEEE'13
*
* 	@package DecisionMaking
*
*/


class PrometheeHF extends MCDM
{
	var $label;//shortname

	var $ranking; //alternatives ranked array

	public function	PrometheeHF($username)
	{
		$this->N=1;
		$this->M=3;
		$this->P=$this->num=0;
		$this->label="promethee";

		$this->alternatives = array($username);
		$this->W = array(1.0, 1.0, 1.0); //same important
	}

	public function run()
	{
		parent::prometheeCase();//realEstateCase();
		parent::run();


		return $this->ranking[0]['promethee']['label'];
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
