<?php

namespace HybridLogic\Cron;

/**
 * Format: Day of Week
 *
 * @package cron
 * @author Luke Lanchester
 * @todo L (Last given dayname of month)
 * @todo # (Every nth weekday of month)
 **/
class Field_DayOfWeek extends Field {


	/**
	 * @var string Getdate field key
	 **/
	protected $field = 'wday';


	/**
	 * @var string Minimum range value
	 **/
	protected $min = 0;


	/**
	 * @var string Maximum range value
	 **/
	protected $max = 6;


	/**
	 * @var array Day name indexes
	 **/
	protected static $days = array(
		'SUN' => 0,
		'MON' => 1,
		'TUE' => 2,
		'WED' => 3,
		'THU' => 4,
		'FRI' => 5,
		'SAT' => 6,
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
		return str_replace(array_keys(static::$days), static::$days, $format);
	} // end func: parse_format



} // end class: Field_DayOfWeek