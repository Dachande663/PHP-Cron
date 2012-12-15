<?php

namespace HybridLogic\Cron;

/**
 * Format: Month
 *
 * @package cron
 * @author Luke Lanchester
 **/
class Field_Month extends Field {


	/**
	 * @var string Getdate field key
	 **/
	protected $field = 'mon';


	/**
	 * @var string Minimum range value
	 **/
	protected $min = 1;


	/**
	 * @var string Maximum range value
	 **/
	protected $max = 12;


	/**
	 * @var array Month indexes
	 **/
	protected static $months = array(
		'JAN' => 1,
		'FEB' => 2,
		'MAR' => 3,
		'APR' => 4,
		'MAY' => 5,
		'JUN' => 6,
		'JUL' => 7,
		'AUG' => 8,
		'SEP' => 9,
		'OCT' => 10,
		'NOV' => 11,
		'DEC' => 12,
	);


	/**
	 * Perform pre-parse formatting
	 *
	 * @param string Format
	 * @return string Format
	 * @author Luke Lanchester
	 **/
	protected function parse_format($format) {
		$format = parent::parse_format($format);
		return str_replace(array_keys(static::$months), static::$months, $format);
	} // end func: parse_format



} // end class: Field_Month