<?php

//include ("CsvImporter.php");

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
	var $num;//number of the total assessments
	
	var $N; //number of alternatives
	var $M; //number of criteria
	var $P; //number of experts
	var $W; //weight of criteria

	var $G;
	var $collectiveValue;
	var $collectiveTerm;	

	var $debug = false;

	/**
	 * Returns the title of the method
	 *
	 * @return string
	 */
	public function getTitle() 
	{
		// make title for Teranga
		$header = $this->label;
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
		$result = elgg_echo("hflts:help:{$this->label}");
		return $result;
	}


	/**
	* get from the system the values needed in the model
	*/	
	public function setData($values, $weight, $size, $granularity) 
	{
		$this->data = $values;
		if (sizeof($values) != $size || sizeof($weight) != $size )
			return; //system_message($size . "  DMCM setData " . sizeof($values));

		if ($size == 0)
			return; 

		$this->P = $this->num = $size;
		$this->G = $granularity;

		//compute the averaged expert preference over criteria 
		$x=$y=$z=0;
		$temp = array();
		$delta = 1.0/$size;

		for ($i=0;$i<$size;$i++)
		{
			for ($m=0;$m<$this->M;$m++)
			{
				$temp[$m] += $weight[$i][$m];
			}
		}

		for ($m=0;$m<$this->M;$m++)
		{
			$this->W[$m] = $temp[$m] * $delta;
		}

    	if ($this->debug) 
    	{
    		echo($this->num . 'data: <pre>');	print_r($this->W);	echo('</pre><br>');
    	}		
	}

	/**
	* Check premises before to run
	*/
	public function run()
	{
		if (elgg_get_plugin_setting('debug', 'hflts') == 1)
			$this->debug = true;
		else
			$this->debug = false;
		
		if (!$this->data || $this->num == 0 || $this->P == 0)
		{
			register_error(elgg_echo("hflts:mcdm:fail"));
			forward(REFERER);
		}
		$this->num = $this->N*$this->P;
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
	* Read data from csv file
	*/
    function parse_csv($name) 
    { 	
    	$filename = elgg_get_plugins_path() . "hflts/classes/" . $name;

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

	public function realEstateCase()
	{
		$this->N=5; //num of alternatives
		$this->M=9; //num of criteria
		$this->P=5; //num of experts
		
	    $this->alternatives = array('C-1','C-2','C-3','C-4','C-5');
		$this->W = array(1.0, 1.0, 0.5,0.8, 0.7, 0.7, 1.0, 0.8, 0.4); //9 pesos del usuario 1
		
		$this->parse_csv("ejemplo_casas.csv");		
		if ($this->debug) system_message("realEstateCase");
	}

	public function todimCase()
	{
		$this->N=4; //num of alternatives
		$this->M=4; //num of criteria
		$this->P=1; //num of experts
		$this->alternatives = array('p1','p2','p3','p4');
		$this->W = array(0.2, 0.15, 0.15,0.5);

		$this->parse_csv("ejemplo_todim.csv");	
		$this->num = $this->N*$this->P;
		if ($this->debug) system_message("todimCase");
	}	

    public function vikorCase()
    {
        $this->N=3; //num of alternatives
        $this->M=3; //num of criteria
        $this->P=1; //num of experts
        $this->alternatives = array('p1','p2','p3');
        $this->W = array(0.3, 0.5, 0.2);

        $this->parse_csv("ejemplo_vikor.csv");  
        if ($this->debug) system_message("vikorCase");
    }
    
    public function electreCase()
    {
        $this->N=3; //num of alternatives
        $this->M=4; //num of criteria
        $this->P=1; //num of experts
        $this->alternatives = array('p1','p2','p3');
        $this->W = array(0.3, 0.2, 0.4, 0.1);

        $this->parse_csv("ejemplo_electre.csv");  
        if ($this->debug) system_message("electreCase");
    }    
}
