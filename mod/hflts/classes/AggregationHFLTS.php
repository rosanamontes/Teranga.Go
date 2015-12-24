<?php
/**
 * Agregación clasica con HFLTS - Rosa'12
 *
 * @package DecisionMaking
 *
 */
class AggregationHFLTS extends MCDM 
{

	const SUBTYPE = "classic";

	/**
	 * initializes the default class attributes
	 *
	 * @return void
	 */
	protected function initializeAttributes() 
	{
		parent::initializeAttributes();
		
		$this->attributes['subtype'] = self::SUBTYPE;
	}
	

}
