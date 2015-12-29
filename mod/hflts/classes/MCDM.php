<?php

include ("CsvImporter.php");

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
	var $alternatives;//list of canditates
	var $data;//valorations of experts for each alternative and criteria
	var $num;//number of total valoracions
	
	var $N; //number of alternatives
	var $M; //number of criteria
	var $P; //number of experts
	var $W; //weight of criteria

	var $G;
	var $collectiveValue;
	var $collectiveTerm;	

	var $debug = false;

	
	public function setData($values, $size, $granularity) 
	{
		$this->data = $values;
		if (sizeof($values) != $size)
			system_message($size . "  DMCM setData " . sizeof($values));
		$this->P = $this->num = $size;
		if ($this->debug)	print_r($this->data);
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
	* setter method for maximum granularity in evaluations
	*/
	public function setGranularity($x)
	{
		$this->G = $x;
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

	/**
	* Read data from file
	*/
    function parse_csv() 
    { 	
    	$filename = "/var/www/html/Teranga.Go/mod/hflts/classes/ejemplo_casas.csv";

		$importer = new CsvImporter($filename,true,","); 
		$this->data = $importer->get(); 
		$num = count($this->data);
			
		//numero de valoraciones es N*P
		if ($num != $this->N*$this->P)
			echo "esto pinta mal<br>" . $num;
		else
			$this->num = $num;
		
    	if ($this->debug) 
    	{
    		echo($this->num . 'data: <pre>');	print_r($this->data);	echo('</pre><br>');
    	}
    }

	/**
	* a range must satisfy the condition of being monotonically increasing
	*/
    protected function checkRange( $a, $b )
    {
	    if ($a <= $b) return;

    	$temp = $a;
		$a = $b;
		$b = $temp;

		if ($this->debug) echo '['.$a.', '.$b.']';
    }
    
}
