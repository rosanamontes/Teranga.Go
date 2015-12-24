<?php
/**
 * Multi-Criteria Decision Making function library
 * @rosanamontes
 * University of Granada
 */



/**
* Euclidean Distance 
* 2014-INS-Distance and similarity measures for hesitant fuzzy linguistic term sets and their application in multi-criteria decision making.pdf
* In: 	Array of hesitants as in this example
*		H1={2,3}
*		H2={1,2,3}
* Params: granularity, for instance G=6
* Out: d_(H1,H2) = number with decimals
* Requirements: it has to work with hesitant of the same length L 
*/

function euclideanDistance($hesitant, $granularity)
{
	system_message("granularity = " . $granularity);
	return 3.14;
}