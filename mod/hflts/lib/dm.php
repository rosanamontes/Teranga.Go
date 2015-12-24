<?php
include ("CsvImporter.php");
//nclude ("mcdm.php");


class DM
{
	var $data;//valoraciones de los expertos para cada piso y criterio
	var $num;
	
	var $N; //numero de inmuebles
	var $M; //numero de criterios
	var $P; //numero de expertos
	
	var $inmuebles;//listado de referencias a valorar
	var $W; //pesos del usuario
	//var $W2 = array(0.8, 0.5, 1.0, 0.6, 1.0, 0.0, 0.3, 0.4);//, 0.5); //pesos de usuario 2

	var $CSi; //array de intervalo inferior para todos los criterios
	var $CSj; //array de intervalo superior para todos los criterios
	
	var $beta; //tuplas
	var $avg; //agregacion promedio
	var $ranking; //orden en el que se prefieren los inmuebles
	
	var $debug = true;

	public function _DM()
	{
		echo "Decision Making<br>";
		system_message("Decision Making");
		$this->N=5; //numero de inmuebles
		$this->M=8; //numero de criterios
		$this->P=5; //numero de expertos
		
		//$this->inmuebles = array('P-1','P-2','P-3');
	    $this->inmuebles = array('C-1','C-2','C-3','C-4','C-5');
		$this->W = array(1.0, 1.0, 0.5,0.8, 0.7, 0.7, 1.0, 0.8);//, 0.4); //pesos de usuario 1

		$this->parse_csv();		
		$this->num = $this->N*$this->P;
		
		//$this->translation();
		//$this->envelope();
		//$this->possibility();
		//$this->choice();//con el ejemplo de casas
		//ejemplo pisos con promedio();//optimista();//pesimista();
		//$this->ranking();
	}
	
	public function DM($n, $m, $p, $v, $inm, $dt, $w)
	{
		if ($this->debug) echo "Decision Making Sample<br>";
		$this->N = $n;
		$this->M = $m;
		$this->P = $p;
		$this->inmuebles = $inm;
		
		$this->data =$dt;
		$this->W = $w;

		//echo('pesos<pre>');	print_r($this->W);	echo('</pre>');
		$this->num = $v;

		//$this->N*$this->P; //presupongo un numero constante de evaluaciones
		if ($this->debug) { echo($this->num . '<pre>');	print_r($this->data);	echo('</pre>'); }
		
		$this->translation();
		$this->envelope();
		
		$this->pesimista();
		$this->optimista();
		$this->promedio();
		$this->choice();
		$this->possibility();
		
		$this->ranking();		
	}

    function parse_csv() 
    { 	
		$importer = new CsvImporter("ejemplo_casas.csv",true,","); //hay que cambiar las cabeceras a numeros
		$this->data = $importer->get(); 
		$num = count($this->data);
			
		//numero de valoraciones es N*P
		if ($num != $this->N*$this->P)
			echo "esto pinta mal<br>" . $num;
		else
			$this->num = $num;

    	if ($this->debug) 
    	{
    		echo($this->num . '<pre>');	print_r($this->data);	echo('</pre>');
    	}
    }
    
    function translation()
    {
    	//min de las up para cada valoracion, max de las low para el mismo piso
    	for($p=0;$p<$this->N;$p++)
    	{
    		for($i=0;$i<$this->num;$i++)
    		{
    			if ($this->data[$i]['ref'] == $this->inmuebles[$p])//index 0 equivale a ref
 		  	  	$_c1up[$p][$i] = $this->data[$i]['U1'];
    			if ($this->data[$i]['ref'] == $this->inmuebles[$p])
    		 		$_c2up[$p][$i] = $this->data[$i]['U2'];   		
    			if ($this->data[$i]['ref'] == $this->inmuebles[$p])
    				$_c3up[$p][$i] = $this->data[$i]['U3'];
    			if ($this->data[$i]['ref'] == $this->inmuebles[$p])
    				$_c4up[$p][$i] = $this->data[$i]['U4'];    		
    			if ($this->data[$i]['ref'] == $this->inmuebles[$p])
 		   		$_c5up[$p][$i] = $this->data[$i]['U5'];    		
    			if ($this->data[$i]['ref'] == $this->inmuebles[$p])
    				$_c6up[$p][$i] = $this->data[$i]['U6'];    
    			if ($this->data[$i]['ref'] == $this->inmuebles[$p])
    				$_c7up[$p][$i] = $this->data[$i]['U7'];
    			if ($this->data[$i]['ref'] == $this->inmuebles[$p])
    				$_c8up[$p][$i] = $this->data[$i]['U8'];
    		
    			if ($this->data[$i]['ref'] == $this->inmuebles[$p])
 	 	  		$_c1low[$p][$i] = $this->data[$i]['L1'];		    		
     			if ($this->data[$i]['ref'] == $this->inmuebles[$p])
 		  		$_c2low[$p][$i] = $this->data[$i]['L2'];		    		
    			if ($this->data[$i]['ref'] == $this->inmuebles[$p])
    				$_c3low[$p][$i] = $this->data[$i]['L3'];		    		
    			if ($this->data[$i]['ref'] == $this->inmuebles[$p])
   	 			$_c4low[$p][$i] = $this->data[$i]['L4'];		    		
    			if ($this->data[$i]['ref'] == $this->inmuebles[$p])
    				$_c5low[$p][$i] = $this->data[$i]['L5'];		    		
    			if ($this->data[$i]['ref'] == $this->inmuebles[$p])
	    			$_c6low[$p][$i] = $this->data[$i]['L6'];		    		
    			if ($this->data[$i]['ref'] == $this->inmuebles[$p])
    				$_c7low[$p][$i] = $this->data[$i]['L7'];		    		
    			if ($this->data[$i]['ref'] == $this->inmuebles[$p])
	    			$_c8low[$p][$i] = $this->data[$i]['L8'];		    		
    		}
	
	    	$this->cSi[$p][0] = min($_c1up[$p]);
    		$this->cSj[$p][0] = max($_c1low[$p]);
			$this->checkRange($this->cSi[$p][0], $this->cSj[$p][0]);	///se eliminan las referencias &$this
			if ($this->debug) echo $this->inmuebles[$p]. " C1 [".$this->cSi[$p][0].",".$this->cSj[$p][0]."] ";
	
    		$this->cSi[$p][1] = min($_c2up[$p]);
    		$this->cSj[$p][1] = max($_c2low[$p]);
			$this->checkRange($this->cSi[$p][1], $this->cSj[$p][1]);	
			if ($this->debug) echo $this->inmuebles[$p]. " C2 [".$this->cSi[$p][1].",".$this->cSj[$p][1]."] ";
			
    		$this->cSi[$p][2] = min($_c3up[$p]);
    		$this->cSj[$p][2] = max($_c3low[$p]);
			$this->checkRange($this->cSi[$p][2], $this->cSj[$p][2]);	
			if ($this->debug) echo $this->inmuebles[$p]. " C3 [".$this->cSi[$p][2].",".$this->cSj[$p][2]."] ";
			
    		$this->cSi[$p][3] = min($_c4up[$p]);
    		$this->cSj[$p][3] = max($_c4low[$p]);
			$this->checkRange($this->cSi[$p][3], $this->cSj[$p][3]);	
			if ($this->debug) echo $this->inmuebles[$p]. " C4 [".$this->cSi[$p][3].",".$this->cSj[$p][3]."] ";
				
    		$this->cSi[$p][4] = min($_c5up[$p]);
    		$this->cSj[$p][4] = max($_c5low[$p]);
			$this->checkRange($this->cSi[$p][4], $this->cSj[$p][4]);	
			if ($this->debug) echo $this->inmuebles[$p]. " C5 [".$this->cSi[$p][4].",".$this->cSj[$p][4]."] ";
			
    		$this->cSi[$p][5] = min($_c6up[$p]);
    		$this->cSj[$p][5] = max($_c6low[$p]);
			$this->checkRange($this->cSi[$p][5], $this->cSj[$p][5]);	
			if ($this->debug) echo $this->inmuebles[$p]. " C6 [".$this->cSi[$p][5].",".$this->cSj[$p][5]."] ";

    		$this->cSi[$p][6] = min($_c7up[$p]);
    		$this->cSj[$p][6] = max($_c7low[$p]);
			$this->checkRange($this->cSi[$p][6], $this->cSj[$p][6]);	
			if ($this->debug) echo $this->inmuebles[$p]. " C7 [".$this->cSi[$p][6].",".$this->cSj[$p][6]."] ";

    		$this->cSi[$p][7] = min($_c8up[$p]);
    		$this->cSj[$p][7] = max($_c8low[$p]);
			$this->checkRange($this->cSi[$p][7], $this->cSj[$p][7]);	
			if ($this->debug) echo $this->inmuebles[$p]. " C8 [".$this->cSi[$p][7].",".$this->cSj[$p][7]."] ";

			if ($this->debug) echo "<br>";
		}
    }
    
    function toBeta( $term, $alpha ) 
    {
    	$b = $term + $alpha;
    	return $b;
    }
    
    function toTuple( $value )
    {
    	$i = round($value);
    	return array ( $i, $value - $i );
    }
    
    function toLabel( $term )
    {
   	   switch ($term) 
	   {
    	   case 0:
        	return "Nada";
    	   case 1:
        	return "Muy Bajo";
    	   case 2:
        	return "Bajo";
    	   case 3:
        	return "Medio";
    	   case 4:
        	return "Alto";
    	   case 5:
        	return "Muy Alto";
    	   case 6:
        	return "Perfecto";
    	   default:
        	return "No valorado";
	   } 
    }

    function checkRange( $a, $b )
    {
	    if ($a <= $b) return;

    	$temp = $a;
		$a = $b;
		$b = $temp;

		if ($this->debug) echo '['.$a.', '.$b.']';
    }
    
    function envelope()
    {
    	//$size = 1.0 / $this->M ; //caso de pesos constantes
    	//echo "diferential " . $size . "<br>";
    	
    	for($p=0;$p<$this->N;$p++)
    	{
    		$this->avg['inf'][$p] = 0.0;
    		$this->avg['sup'][$p] = 0.0;
    		$sum = 0.0;
    	
    		for($c=0;$c<$this->M;$c++)
    		{
    			$this->beta[$p][$c]['inf'] = $this->toBeta( $this->cSi[$p][$c], 0.0 );
    			$this->beta[$p][$c]['sup'] = $this->toBeta( $this->cSj[$p][$c], 0.0 );
    			if ($this->debug) echo " [". $this->beta[$p][$c]['inf'] .", " . $this->beta[$p][$c]['sup'] . "] ";
    			
    			$sum += $this->W[$c];
    			$this->avg['inf'][$p] += $this->W[$c] * $this->beta[$p][$c]['inf'];
    			$this->avg['sup'][$p] += $this->W[$c] * $this->beta[$p][$c]['sup'];
    		}
    		//echo "Acumulado: " . $sum . "<br>";
    		$this->avg['inf'][$p] = $this->avg['inf'][$p] / $sum;
    		$this->avg['sup'][$p] = $this->avg['sup'][$p] / $sum;
    		if ($this->debug) 
    			echo " => [". $this->avg['inf'][$p] .", " . $this->avg['sup'][$p] . "] <br>";
    	}
    }
    
    function pesimista()
    {
    	//solo los intervalos inferiores
		arsort($this->avg['inf']);
    	if ($this->debug)
    	{
    		echo('<br><pre>');	print_r($this->avg['inf']);	echo('</pre>');
    	}
    	
    	$p=0;    
  		while ($candidato = current($this->avg['inf']))   	
    	{
      		$index = key($this->avg['inf']);
      		$this->ranking[$p]['pesimista']['ref'] = $this->inmuebles[$index] ;
      		$this->ranking[$p]['pesimista']['tupla'] = $this->toTuple( $candidato );
      		$this->ranking[$p]['pesimista']['label'] = $this->toLabel( $this->ranking[$p]['pesimista']['tupla'][0] );
      		//echo "<p>El vector ".$candidato." con indice ".$p." tiene el valor ".$index." </p>";
      		$p++;
      		next($this->avg['inf']);
		}  
    }
    
    
    function optimista()
    {
    	//solo los intervalos superiores
		arsort($this->avg['sup']);
    	if ($this->debug)
    	{
    		echo('<br><pre>');	print_r($this->avg['sup']);	echo('</pre>');
    	}

    	$p=0;    	    
  		while ($candidato = current($this->avg['sup']))   	
    	{
      		$index = key($this->avg['sup']);
      		$this->ranking[$p]['optimista']['ref'] = $this->inmuebles[$index] ;
      		$this->ranking[$p]['optimista']['tupla'] = $this->toTuple( $candidato );
      		$this->ranking[$p]['optimista']['label'] = $this->toLabel( $this->ranking[$p]['optimista']['tupla'][0] );
      		//echo "<p>El vector ".$candidato." con indice ".$p." tiene el valor ".$index." </p>";
      		$p++;
      		next($this->avg['sup']);
		}  
    }    
    
    function promedio()
    {
    	//media de ambos intervalos
   		for($p=0;$p<$this->N;$p++)
    		$values[$p] = ($this->avg['inf'][$p] + $this->avg['sup'][$p]) * 0.5;

		arsort($values);
    	if ($this->debug) 
		{
			echo('<br><pre>');	print_r($values);	echo('</pre>');
		}

    	$p=0;    	    
  		while ($candidato = current($values))   	
    	{
      		$index = key($values);
      		$this->ranking[$p]['promedio']['ref'] = $this->inmuebles[$index] ;
      		$this->ranking[$p]['promedio']['tupla'] = $this->toTuple( $candidato );
      		$this->ranking[$p]['promedio']['label'] = $this->toLabel( $this->ranking[$p]['promedio']['tupla'][0] );
      		//echo "<p>El vector ".$candidato." con indice ".$p." tiene el valor ".$index." </p>";
      		$p++;
      		next($values);
		}  
    }
    
    //..-..-..-..-..-..-..-..-..-..-..-..-..-..- CHOICE DEGREE ..-..-..-..-..-..-..-..-..-..-..-..-..-..-..-..-..-..-..-..-..-

	//formula comparativa P(A>B) = (  (a2-b1)-(a1-b2) ) / ( (a2-a1)+(b2-b1) )
	function dominancia( $a1, $a2, $b1, $b2 )
	{
		return (  max(0.0,($a2-$b1))-max(0.0,($a1-$b2)) ) / ( ($a2-$a1)+($b2-$b1) );
	}
	
	//pasar del rango [0,1] a [0,6]
	function toRange( $value )
	{
		return (  $value * 6.0 );
	}
	

    function choice()
    {    	    
    	$predominance = array();
    	for($i=0;$i<$this->N;$i++)
    	for($j=0;$j<$this->N;$j++)
    	{
    		if ($i != $j)
    		{ 
    		   $predominance[$i][$j] = $this->dominancia($this->avg['inf'][$i],$this->avg['sup'][$i],$this->avg['inf'][$j],$this->avg['sup'][$j]);
    		   //echo $predominance[$i][$j] . "<br>";
    		}
    	}
    	if ($this->debug) echo "<br>";
    	$dominance = array();
    	for($i=0;$i<$this->N;$i++)
    	for($j=0;$j<$this->N;$j++)
    	{
    		if ($i != $j)
    		{ 
    		   $dominance[$i][$j] = max($predominance[$i][$j] - $predominance[$j][$i], 0.0);
    		   //echo $i . '  ' . $j . ' - ' . $dominance[$j][$i] . "<br>";
    		}
    		else
    			$dominance[$i][$j] = -1; 
    	}
    	
    	if ($this->debug)
    	{
    	     echo('<br>Dominance <pre>');	print_r($dominance);	echo('</pre><hr>');
    	}
    	
    	$lista = array();
    	for($j=0;$j<$this->N;$j++)
    	{
    		$column = array();
    		for($i=0;$i<$this->N;$i++)
    		{
    			//echo '['.$i.','. $j.'] ' . $dominance[$i][$j] . '<br>';
    			if ($i != $j) $column[$i] = max(1.0-$dominance[$i][$j],0.0);
    		}
    		//echo('Column: <pre>');	print_r($column);	echo('</pre><br>');
    		$lista[$j] = min($column);
			//echo('<br>Lista: <pre>');	print_r($lista);	echo('</pre>');
    	}

		arsort($lista);
    	if ($this->debug) 
		{
			echo('<hr>Lista ordenada: <pre>');	print_r($lista);	echo('</pre>');
		}


  		for($p=0;$p<$this->N;$p++) 	
    	{
    		$orden = current($lista);
    		$beta = $this->toRange($orden);
    		//echo "---" . $beta ;
      		$index = key($lista);
      		$this->ranking[$p]['choice']['ref'] = $this->inmuebles[$index] ;
      		//$this->ranking[$p]['choice']['tupla'] = $this->toTuple( $beta );
      		//$this->ranking[$p]['choice']['label'] = $this->toLabel( $this->ranking[$p]['choice']['tupla'][0] );
      		$this->ranking[$p]['choice']['label'] = $orden;
      		//echo "<p>El inmueble ".$index." o indice ".$p." tiene el intervalo ".$interval[$index]." </p>";

      		next($lista);
		}  
      	//echo('<hr><pre>');	print_r($this->ranking);	echo('</pre>');
    }


    //..-..-..-..-..-..-..-..-..-..-..-..-..-..- POSSIBILITY DEGREE ..-..-..-..-..-..-..-..-..-..-..-..-..-..-..-..-..-..-..-..-..-

	function computePossibility($i_1, $i_m, $j_1, $j_n)
	{
		$value; //possibility degree value computed by this function
		
		if ($this->debug) echo 'compute with ('. $i_1 . ', ' . $i_m. ', ' . $j_1. ', ' . $j_n .') ';
		$useFormula;
		$case;
		if ($i_m<=$j_n)
			$useFormula=1;
		else
			$useFormula=2;
			
		if($useFormula==1)
		{
			if ($i_m < $j_1)
				$case = "consecutivo";
			else
				if ( ($i_1<=$j_1) && ($j_1<=$i_m) && ($i_m<=$j_n) )
					$case = "cruce";
				else
					$case = "caja";
		}
		else
		{			
			if($j_n<$i_1)
				$case = "consecutivo";
			else	
				if ( ($j_1<=$i_1) && ($i_1<=$j_n) && ($j_n<=$i_m) )
					$case = "cruce";
				else
					$case = "caja";
		}		

		if ($this->debug) echo 'with ('. $useFormula . ') & 	' . $case . ' = ';
		
		switch ($case)
		{
			case "consecutivo":
				if ($useFormula==1)
					$value = 0;
				else
					$value = 1;			
				break;

			case "cruce":
				if ($useFormula==1)
					$value = (0.5*($i_m-$j_1+1))/($j_n-$i_1+1.0);
				else
					$value = (0.5*($j_n-$i_1+1)+($i_m-$j_n)+($i_1-$j_1))/($i_m-$j_1+1.0);
				break;

			case "caja":
				if ($useFormula==1)
					$value = ($i_1-$j_1+0.5*($i_m-$i_1+1))/($j_n-$j_1+1.0);
				else
					$value = (0.5*($j_n-$j_1+1)+($i_m-$j_n))/($i_m-$i_1+1.0);
				break;

			default:
				$value = 0;
				echo "no debería estar en este case de possibility degree computation<br>";
		}
		
		if ($this->debug) echo $value . '<br>';
		return $value;
	}
	
	function checkOnes( $matrix, $N )
	{
		$V = array();
		$k=0;
		//assumed is a squared matrix
		for($i=$N-1;$i>=0;$i--) //muy importante hacerlo en orden inverso de cara a recortar la matriz
		{
			$row2_one = true;
			for($j=0;$j<$N;$j++) 
				$row2_one = ($matrix[$i][$j] && $row2_one);
					
			//echo '['.$i.'] = ' . $row2_one . '<br>';
			if ($row2_one == true)
			{
				$V[$k] = $i;
				$k++;
			}
		}
		return $V;	
	}
	
	
	function delete_row(&$array, $offset) 
	{
		return array_splice($array, $offset, 1);//, true);//preserve_keys
	}

	function delete_col(&$array, $offset) 
	{
		return array_walk($array, function (&$v) use ($offset) {
			array_splice($v, $offset, 1);
		});
	}
	
	function removeCrossAt( $lines, &$matrix )
	{
		//if ($this->debug) echo " remove index " . $index;
		$newLines = array();
		$n = count($lines);
		$m = count($matrix);
		
		for($i=0;$i<$n;$i++) 
		{
			$newLines[$i] = $matrix[$lines[$i]][$m]; //guardar indices originales
			//echo ($m) . " + old " . $lines[$i] . " new " . $newLines[$i] . "<br>";
		}

		for($i=0;$i<$n;$i++) 
			$this->delete_col($matrix, $lines[$i]);///se eliminan las referencias &$matrix
		for($i=0;$i<$n;$i++) 		
			$this->delete_row($matrix, $lines[$i]);
			
		return $newLines;
	}
	

	function possibility()
	{
		$indexes = array();
		$lenght = array();
		$betalenght = array();
		$degree = array();
		$relation = array();
		$I = array();
		$V = array();
		$lista = array();
		$promedio = array();
		
		$l=0;
		for($p=0;$p<$this->N;$p++) 	
		{
			$inf = $this->toTuple($this->avg['inf'][$p]);
			$sup = $this->toTuple($this->avg['sup'][$p]);
			
			$indexes[$l] = $inf[0];
			$indexes[$l+1] = $sup[0];	
			
			$length[$p] = $indexes[$l+1]-$indexes[$l];
			if ($this->debug) echo '<br>'. $length[$p];
			$betalength[$p] = $this->avg['sup'][$p]-$this->avg['inf'][$p];
			$l = $l+2;
		}
		
		//possibility degree matrix P
		for($i=0;$i<$this->N;$i++)
    	for($j=$i;$j<$this->N;$j++)
    	{
    		if ($i!=$j)
    		{ 
    			$degree[$i][$j] = $this->computePossibility( $indexes[$i*2], $indexes[$i*2+1], $indexes[$j*2], $indexes[$j*2+1] );
    			//echo '<br>['. $i . ',' . $j . '] ' . $degree[$i][$j];
    			$degree[$j][$i] = 1 - $degree[$i][$j] ;
    			//echo '<br>['. $j . ',' . $i . '] ' . $degree[$j][$i];
    		}
    		else $degree[$i][$j] = 0.5;
    	}
    	
    	/*validando con ejemplo paper ... OK
    	$this->computePossibility(3, 5, 4, 6); // 1 cruce 0,25
    	$this->computePossibility(3, 5, 1, 3); //2 cruce 0,9
    	$this->computePossibility(4, 6, 1, 3); // 2 consecutivo 1
    	$this->computePossibility(4, 6, 5, 5); // 2 caja 0,5
		*/
    	
    	if ($this->debug) 
    	{
    		echo('<hr><pre>');	print_r($degree);	echo('</pre>');
    	}
    	
    	//preference relation matrix U
		for($i=0;$i<$this->N;$i++)
		{
			$avg = 0;
    		for($j=0;$j<$this->N;$j++)
    		{
    			$avg += $degree[$i][$j];
    			//echo '<br>['. $i . ',' . $j . '] ' . $degree[$i][$j];
				if($degree[$i][$j]>=0.5)
					$relation[$i][$j]=1.0;
				else
					$relation[$i][$j]=0.0;
				//echo ' -> ['. $i . ',' . $j . '] ' . $relation[$i][$j];
			}
			$promedio[$i] = $avg / $this->N ; 
			
			//almaceno los indices originales en la ultima columna
    		$relation[$i][$this->N] = $i;
    	}	
  
      	if ($this->debug) 
    	{
    		echo('<br><pre>');	print_r($relation);	echo('</pre>');
    	}  	
    	
    	$m = $this->N;//tamaño inicial de U_1
    	//echo " tam inicial " . $m . " <br>";
    	$k=0;
    	while ($m >= 1)
    	{
    		$I = $this->checkOnes($relation, $m);
    		//echo('<br>I<pre>');	print_r($I);	echo('</pre>');
    	
    		$n = count($I);
    		//echo " eliminar " . $n . " filas<br>";
    	
    		$V[$k] = $this->removeCrossAt( $I, $relation );///se eliminan las referencias &$
			//echo('<br>U<pre>');	print_r($relation);	echo('</pre>');
			//echo('<br>V<pre>');	print_r($V[$k]);	echo('</pre>');
			
			$k++;
			$m = $m-$n; //tamaño actualizado
			//echo " tam actualizado " . $m . " <br>";
		}
		
		if ($this->debug) 
		{ 
			echo('<br>Listado<pre>');	print_r($V);	echo('</pre>');
		}
	
		
		$p=0;
		for ($i=0; $i<$k; $i++)
		{
			$nI = count($V[$i]);
			if ($nI==1)
			{
				$lista[$p] = $V[$i][0];
				$p++;
			}
			else
			{
				for ($j=0; $j<$nI; $j++)
					$data[ $V[$i][$j] ] = $betalength[ $V[$i][$j] ];
				
				asort($data);
				//echo('<br>despues<pre>');	print_r($data);	echo('</pre>');
		
				foreach ($data as $key => $value)
				{
					$lista[$p] = $key;
					$p++;
				}
			}	
		}

		if ($this->debug) 
		{ 	
			echo('<br>L<pre>');	print_r($lista);	echo('</pre>');
		}
		
		for($p=0;$p<$this->N;$p++) 	
    	{
    		$orden = current($lista);

      		$this->ranking[$p]['possibility']['ref'] = $this->inmuebles[$orden] ;
			$this->ranking[$p]['possibility']['label'] = $promedio[$orden];
      		//echo  $orden .  " " . $promedio[$orden] . '<br>' ;

      		next($lista);
		} 

		
	}




    //..-..-..-..-..-..-..-..-..-..-..-..-..-..- comun a todos ..-..-..-..-..-..-..-..-..-..-..-..-..-..-..-..-..-..-..-..-..-
    
    function ranking()
    {
    	if ($this->debug)
    	{
    		echo('<br>Ranking <pre>');	print_r($this->ranking);	echo('</pre>');
    	}
    	return $this->ranking;
    }
    
}

//$test = new DM();

?>
