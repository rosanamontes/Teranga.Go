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


class TopsisHFLTS extends MCDM
{

	var $label;//shortname


	var $ranking; //alternatives ranked array

	public function	TopsisHFLTS($username)
	{
		$this->N=1;
		$this->M=4;
		$this->P=$this->num=0;
		$this->label="topsis";

		$this->alternatives = array($username);
		$this->W = array(1.0, 1.0, 1.0,1.0); //same importance by default
	}
	
	public function run()
	{
		//self::realEstateCase();

		parent::run();

		$this->ranking();	

		return $this->ranking[0]['topsis']['label'];
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
