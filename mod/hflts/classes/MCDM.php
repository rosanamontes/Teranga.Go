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
*	File: Tipo de problema MCDM
*
* 	@package DecisionMaking
*
*/
abstract class MCDM 
{
	var $data;//valoraciones de los expertos para cada alternativa y criterio
	var $num;//numero de valoraciones
	
	var $N; //numero de alternativas
	var $M; //numero de criterios
	var $P; //numero de expertos

	var $G;
	var $collectiveValue;
	var $collectiveTerm;	

	public function run()
	{
		if (!$this->data || $this->num == 0 || $this->P == 0)
		{
			register_error(elgg_echo("hflts:mcdm:fail"));
			forward(REFERER);
		}
	} 
	
	public function setData($values, $size, $granularity) 
	{
		$this->data = $values;
		if (sizeof($values) != $size)
			system_message("DMCM class: revisar setData y mostrar error");
		$this->P = $this->num = $size;
		//print_r($this->data);
		$this->G = $granularity;
	}

	/** 
	* getter method for N
	*/
	public function getAlternatives()
	{
		return $this->N;
	}

	/** 
	* setter method for N
	*/
	public function setAlternatives($x)
	{
		$this->N = $x;
	}

	/** 
	* getter method for M
	*/
	public function getCriteria()
	{
		return $this->M ;
	}

	/** 
	* setter method for M
	*/
	public function setCriteria($x)
	{
		$this->M = $x;
	}

	/** 
	* getter method for P
	*/
	public function getExperts()
	{
		return $this->P;
	}

	/** 
	* setter method for P
	*/
	public function setExperts($x)
	{
		$this->P = $x;
	}

	/** 
	* getter method for maximum granularity in evaluations
	*/
	public function getGranularity()
	{
		return $this->G;
	}

	/** 
	* getter method for result value
	*/
	public function getValue()
	{
		if (!$this->collectiveValue)
			$this->collectiveValue=-1;
		return $this->collectiveValue;
	}

	/** 
	* getter method for result term
	*/
	public function getTerm()
	{
		return $this->collectiveTerm;
	}

}
