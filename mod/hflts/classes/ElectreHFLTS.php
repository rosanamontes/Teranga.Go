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
*	File: Jian-quang Wang IS'14
*
* 	@package DecisionMaking
*
*/


class ElectreHFLTS extends MCDM
{

	var $label;//shortname

	var $ranking; //alternatives ranked array

	public function	ElectreHFLTS($username)
	{
		$this->N=1;
		$this->M=3;
		$this->P=$this->num=0;
		$this->label="electre";

		$this->alternatives = array($username);
		$this->W = array(1.0, 1.0, 1.0); //same important
	}

	
	public function run()
	{
		//parent::realEstateCase();

		parent::run();

		$this->ranking();	

		return $this->ranking[0]['electre']['label'];
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
