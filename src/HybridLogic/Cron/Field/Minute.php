<?php

namespace HybridLogic\Cron;

/**
 * Format: Minute
 *
 * @package cron
 * @author Luke Lanchester
 **/
class Field_Minute extends Field {


	/**
	 * @var string Getdate field key
	 **/
	protected $field = 'minutes';


	/**
	 * @var string Minimum range value
	 **/
	protected $min = 0;


	/**
	 * @var string Maximum range value
	 **/
	protected $max = 59;


} // end class: Field_Minute