<?php

//include ("CsvImporter.php");

/**
* 	Plugin: Valoraciones linguisticas con HFLTS
*	Author: Rosana Montes Soldado
*			Universidad de Granada
*	Licence: 	CC-ByNCSA
*	Reference:	CEI BioTIC Micro.proyect Ref. 11-2015
* 	Project coordinator: @rosanamontes
*	Website: http://lsi.ugr.es/rosana
*	
*	File: General MultiCriteria-DecisionMaking problem
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

	var $W; //weight of criteria (array 1xM and same for all experts? MxP?)
	var $E; //weight of experts (array 1xP)
	var $superE;//weight of experts for each criteria(PxM)
	var $Wfile;	//name of the file that holds weight data (in case of)

	var $G = 6; //max scale by default
	var $collectiveValue;
	var $collectiveTerm;	

	var $debug = false;
	var $information = false;

	var $case = 'platform'; //by default data comes from the platform

	var $benefitCriteria;	//solo a usar en Topsis. Representa criterios a maximizar
	var $costCriteria;	//solo a usar en Topsis. Representa criterios a minimizar
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
	* get from the system the values needed in the model. Called from driver, from icon,... but not from collective
	* input: array of $size assessments 
	* input: array of 1 x M criteria weights
	* input: array of 1 x P expert weights
	*/	
	public function setData($values, $C_weight, $E_weight, $size, $granularity) 
	{
		if ($size == 0)
			return; 

		$this->data = $values;
		//if ($this->information) 
		{
			echo("#". $size . ' Dt: <pre>');	print_r($this->data);	echo('</pre><br>');
		}

		if (sizeof($values) != $size)
			//return; 
			system_message($size . "  DMCM setData " . sizeof($values));//


		$this->P = $this->num = $size;//no necesariamente dos valoraciones vienen de 2 expertos
		$this->G = $granularity;

		//compute the averaged expert preference over criteria. Not normalized 
		$this->superE = $C_weight;
		if ($C_weight != null)
			$this->W = averagedUserPreference($C_weight, $this->M);

		if ($E_weight != null)
			$this->E = relativeUserExpertise($E_weight);//Idea: no normalizar aqui sino fuera en driver + mcdm lib

		if ($this->information) 
		{
			echo(' W: <pre>');	print_r($this->W);	echo('</pre><br>');
			echo(' E: <pre>');	print_r($this->E);	echo('</pre><br>');
			echo(' superE: <pre>');	print_r($this->superE);	echo('</pre><br>');
		}		
	}

	/**
	* Check premises before to run
	* Choose experiment to run
	*/
	public function run()
	{
		if (elgg_get_plugin_setting('debug', 'hflts') == 1)
			$this->information = true;
		else
			$this->information = false;
		
		if ($this->debug) system_message("run case " . $this->case);
		switch ($this->case)
		{
		 	case 'platform':
				if (!$this->data || $this->num == 0 || $this->P == 0)
				{
					//return ;
					register_error(elgg_echo("hflts:mcdm:fail"));
					//forward(REFERER);
				}
				$this->num = $this->N*$this->P;
		 		break;

		 	case 'classic':
		 		self::realEstateCase();
		 		break;

		 	case 'todim':
		 		self::todimCase();
		 		break;

		 	case 'vikor':
		 		self::vikorCase("-3..3");//assessments withing range {-3,-2,...2,3}
		 		break;
		 	case 'vikorS7':
		 		self::vikorCase("S7");//assessments withing range {0,1,...5,6}
		 		break;

		 	case 'electre':
		 		self::electreCase();
		 		break;

		 	case 'topsis':
		 		self::topsisCase("original");//with benefit and cost criteria
		 		break;

		 	case 'topsisB':
		 		self::topsisCase("benefit");//cost criteria negated so everything is benefit criteria
		 		break;

		 	case 'promethee':
		 		self::prometheeCase();
		 		break;

		 	case 'imported':
		 		//system_message("choose csv file " . $this->Wfile);
		 		self::parse_csv($this->alternatives[0]);
		 		for ($i=0; $i<$this->N;$i++)
		 			$this->alternatives[$i] = $this->data[$i*$this->P]["ref"];

		 		for ($i=0; $i<$this->M;$i++)
			 			$this->benefitCriteria[$i] = $i;

		 		if ($this->Wfile != "")
		 			self::parse_csv_weights($this->Wfile);
		 		else
		 		{
			 		for ($i=0; $i<$this->M;$i++)
			 			$this->W[$i] = 1.0/$this->M;

			 		for ($i=0; $i<$this->P;$i++)
			 			$this->E[$i] = 1.0/$this->P;
			 	}
		 		break;
	 	
		 	default://promeetee not impleented
		 		register_error("MCDM_not_be_here");
		 		break;
		} 
		$this->normalizeWeights();
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
	* setter method for the auxiliary file used to store criteria & expert weights (to run experiments out from the platform data)
	*/
	public function setWfile($string)
	{
		$this->Wfile = $string;
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
	function parse_csv($filename) 
	{ 	
		$importer = new CsvImporter($filename,true,","); 
		$this->data = $importer->get(); 
		$num = count($this->data);
		
		//..-..-..-..-..-..-..-..-..-..-..-..-..-..-..-..-..-..-..-..-..-..-..-..-..-..- 
		if (elgg_get_plugin_setting('exportTex', 'hflts') == 1)
			set2latex($this->data, $this->label, $this->M);//export to .tex just in case needed
		//..-..-..-..-..-..-..-..-..-..-..-..-..-..-..-..-..-..-..-..-..-..-..-..-..-..- 

		//numero de valoraciones es N*P
		if ($num != $this->N*$this->P)
			echo $num . "... esto pinta mal<br>" ;
		
		$this->num = $num;
		
		/*if ($this->debug) 
		{
			echo($this->num . ' assessments in file: <pre>');	print_r($this->data);	echo('</pre><br>');
		}*/
	}


	/**
	* Read weights MxP from csv file. Only for Teranga, only for classic method
	*/
	function parse_csv_weights($filename) 
	{ 	
		$importer = new CsvImporter($filename,true,","); 
		$readed= $importer->get(); 
		
		//..-..-..-..-..-..-..-..-..-..-..-..-..-..-..-..-..-..-..-..-..-..-..-..-..-..-  
		if (elgg_get_plugin_setting('exportTex', 'hflts') == 1)
			weight2latex($readed, $this->label, $this->M);//export to .tex just in case needed
		//..-..-..-..-..-..-..-..-..-..-..-..-..-..-..-..-..-..-..-..-..-..-..-..-..-..- 

		$mxp = count($readed);
					
		//numero de valoraciones es N*P
		if ($mxp != $this->P)
		{
			echo $mxp . "... esto pinta mal... actualizar P<br>" ;
			$this->P = $mxp;
		}
		
		//no valido el valor del campo expert, que debe estar en el mismo orden que los datos
		//otra opcion es que el índice sea $readed[$i]['expert'] en ambos casos
		for ($i=0;$i<$mxp;$i++)
		{
			$this->E[$i] = $readed[$i]['we'];
			for ($j=0;$j<$this->M;$j++)	
			{
				$l = 'C'.($j+1);
				$this->superE[$i][$j] = $readed[$i][$l];
			}
		}

		//if ($this->debug) 
		{
			echo('expert weights (E): <pre>');	print_r($this->E);	echo('</pre><br>');
			echo('individual weights (superE): <pre>');	print_r($this->superE);	echo('</pre><br>');
		}
	}

	public function realEstateCase()
	{
		$this->N=5; //num of alternatives
		$this->M=9; //num of criteria
		$this->P=5; //num of experts
		
		$this->alternatives = array('C-1','C-2','C-3','C-4','C-5');
		$this->W = array(1.0, 1.0, 0.5, 0.8, 0.7, 0.7, 1.0, 0.8, 0.4); //9 pesos del usuario 1

		//expert weights
		$this->E = array(1.0, 1.0, 1.0, 1,0, 1.0);//same importance of each assessment in case of parsing fail

		if ($this->Wfile == "")
			system_message("housing no external file to parse");	
		else
		{
			$this->parse_csv_weights($this->Wfile);
			system_message("housing with " . $this->Wfile . " to parse weights ");
		}

		//additionally set
		for ($i=0;$i<$this->M;$i++)
			$this->benefitCriteria[$i] = $i;
		
		$name = elgg_get_plugins_path() . "hflts/samples/set_classic.csv";
		$this->parse_csv($name);		
		if ($this->information) system_message("realEstateCase");
	}

	public function todimCase()
	{
		$this->N=4; //num of alternatives
		$this->M=4; //num of criteria
		$this->P=1; //num of experts
		$this->alternatives = array('p1','p2','p3','p4');
		$this->W = array(0.2, 0.15, 0.15,0.5);
		$this->E = array(1.0);
		//additionally set
		for ($i=0;$i<$this->M;$i++)
			$this->benefitCriteria[$i] = $i;

		$name = elgg_get_plugins_path() . "hflts/samples/set_todim.csv";
		$this->parse_csv($name);		

		$this->num = $this->N*$this->P;
		if ($this->information) system_message("todimCase");
	}	

	public function vikorCase($rangeTerms)
	{
		$this->N=3; //num of alternatives
		$this->M=3; //num of criteria
		$this->P=1; //num of experts
		$this->alternatives = array('p1','p2','p3');
		$this->W = array(0.3, 0.5, 0.2);
		$this->E = array(1.0);
		//additionally set
		for ($i=0;$i<$this->M;$i++)
			$this->benefitCriteria[$i] = $i;

		if ($rangeTerms == "S7")
			$name = elgg_get_plugins_path() . "hflts/samples/set_vikorS7.csv";
		else
			$name = elgg_get_plugins_path() . "hflts/samples/set_vikor.csv";
		$this->parse_csv($name);		

		if ($this->information) system_message("vikorCase");
	}
	
	public function electreCase()
	{
		$this->N=3; //num of alternatives
		$this->M=4; //num of criteria
		$this->P=1; //num of experts
		$this->alternatives = array('p1','p2','p3');
		$this->W = array(0.3, 0.2, 0.4, 0.1);
		$this->E = array(1.0);
		//additionally set
		for ($i=0;$i<$this->M;$i++)
			$this->benefitCriteria[$i] = $i;

		$name = elgg_get_plugins_path() . "hflts/samples/set_electre.csv";
		$this->parse_csv($name);		

		if ($this->information) system_message("electreCase");
	}    

	public function topsisCase($case)
	{
		$this->N=5; //num of alternatives
		$this->M=4; //num of criteria
		
		$this->alternatives = array('p1','p2','p3','p4','p5');
		$this->W = array(0.2, 0.2, 0.2, 0.2, 0.2);
		
		if ($case == "original")
		{
			$this->P=7; //num of experts
			$this->E = array(1.0, 1.0, 1.0, 1.0, 1.0, 1.0, 1.0);

			$this->benefitCriteria = array(1,2);
			$this->costCriteria = array(0,3);			
			$name = elgg_get_plugins_path() . "hflts/samples/set_topsis.csv";
		}
		else
		{
			$this->P=1; //num of experts
			$this->E = array(1.0);

			$this->benefitCriteria = array(0,1,2,3);
			$this->costCriteria = array();			
			$name = elgg_get_plugins_path() . "hflts/samples/set_topsis_benefit.csv";
		}

		$this->parse_csv($name);		

		if ($this->information) system_message("topsisCase");
	}    

	public function prometheeCase()
	{
		$this->N=4; //num of alternatives
		$this->M=9; //num of criteria
		$this->P=1; //num of experts
		$this->alternatives = array('a1','a2','a3','a4');
		$this->W = array();
		$this->E = array(1.0);
		$this->benefitCriteria = array(0,1,2,3,4,5,6,7,8);
		$this->costCriteria = array();

		$name = elgg_get_plugins_path() . "hflts/samples/set_promethee.csv";
		$this->parse_csv($name);		

		if ($this->information) system_message("prometheeCase");		
	}

	/**
	* Read expert weights from parent class | from CSV file | set as here at the same
	* Check normalization
	*/
	public function normalizeWeights()
	{
		/*$sum = 0;
		for ($j=0;$j<$this->M;$j++)
			$sum += $this->W[$j];
		
		for ($j=0;$j<$this->M;$j++)
			$this->W[$j] = $this->W[$j] / $sum;
		
		if ($this->debug) 
		{
			echo($sum .'<br>criteriaWeights: <pre>');	print_r($this->W);	echo('</pre>');
		}*/

		$sum = 0;
		for ($e=0;$e<$this->P;$e++)
			$sum += $this->E[$e];
		
		for ($e=0;$e<$this->P;$e++)
			$this->E[$e] = $this->E[$e] / $sum;
		
		if ($this->debug) 
		{
			echo($this->P .'# expertWeights: <pre>');	print_r($this->E);	echo('</pre>');
		}
	}

	/**
	* Method of the classs MCDM that decides which operator should be used 
	* Input: data array of envelopes
	* Output: check boolean to decide if output is an hesitant resulting of aggregation or its envelope
		//To Do: aggregationHLWA with array of hesitants as input
		//To Do: aggregationMinMax with input hesitants and weights
	*/
	public function aggregate($assessments, $toHesitant)
	{
		//if pesos expertos solo aggregationHLWA??

		//chequear cual es el array de pesos a usar. 
		$aggOperator = elgg_get_plugin_setting('aggOperator', 'hflts');
		
		if ($aggOperator == 0)
		{
			//system_message(elgg_echo('hflts:aggOperator:minmax'));//does not consider weights
			if ($toHesitant)
				$result = aggregationMinMaxToHesitant($assessments);
			else
				$result = aggregationMinMaxToEnvelope($assessments);
		}
		else
		{
			//system_message(elgg_echo('hflts:aggOperator:HLWA'));//admits weights 
			$result = aggregationHLWA($assessments, $this->E, $this->G);
			if (!$toHesitant)
				$result = toEnvelope($result);
		}

		return $result;
	}

}
