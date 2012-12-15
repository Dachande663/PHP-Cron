<?php

namespace HybridLogic\Cron;

/**
 * Format: Year
 *
 * @package cron
 * @author Luke Lanchester
 **/
class Field_Year extends Field {


	/**
	 * @var string Getdate field key
	 **/
	protected $field = 'year';


	/**
	 * @var string Minimum range value
	 **/
	protected $min = 2000;


	/**
	 * @var string Maximum range value
	 **/
	protected $max = 2038;


} // end class: Field_Year