<?php

namespace HybridLogic\Cron;

/**
 * Format: Day of Month
 *
 * @package cron
 * @author Luke Lanchester
 **/
class Field_DayOfMonth extends Field {


	/**
	 * @var string Getdate field key
	 **/
	protected $field = 'mday';


	/**
	 * @var string Minimum range value
	 **/
	protected $min = 1;


	/**
	 * @var string Maximum range value
	 **/
	protected $max = null;


	/**
	 * @var array Standard days in months
	 **/
	protected static $days_in_months = array(
		1  => 31,
		2  => null,
		3  => 31,
		4  => 30,
		5  => 31,
		6  => 30,
		7  => 31,
		8  => 31,
		9  => 30,
		10 => 31,
		11 => 30,
		12 => 31,
	);


	/**
	 * Is this Field satisfied by the provided getdate data?
	 *
	 * @param array Getdate data
	 * @return bool True if date is satisfied
	 * @author Luke Lanchester
	 **/
	public function test($getdate) {

		if($getdate['mon'] === 2) {
			$year = $getdate['year'];
			$leap_year = ( ($year % 400 === 0) or ($year % 4 === 0 and $year % 100 !== 0) );
			$days_in_month = $leap_year ? 29 : 28;
		} else {
			$days_in_month = static::$days_in_months[$getdate['mon']];
		}

		// @todo W (nearest weekday)

		$this->max = $days_in_month;
		$this->format = str_replace('L', $days_in_month, $this->format);
		return parent::test($getdate);

	} // end func: test



} // end class: Field_DayOfMonth