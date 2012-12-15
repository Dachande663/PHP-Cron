<?php

namespace HybridLogic\Cron;

/**
 * A Cron Expression format
 *
 * @package cron
 * @author Luke Lanchester
 **/
class Format {


	/**
	 * @var array Order to perform tests
	 **/
	private static $order = array('year', 'month', 'hour', 'minute', 'dom', 'dow');


	/**
	 * Factory
	 *
	 * @param string Input format
	 * @return Format New Format
	 * @author Luke Lanchester
	 **/
	public static function factory($format) {
		return new Format($format);
	} // end func: factory



	/**
	 * @var string Original input format
	 **/
	private $string;


	/**
	 * @var array Fields
	 **/
	private $fields = array();


	/**
	 * Constructor
	 *
	 * @param string Input format
	 * @return void
	 * @author Luke Lanchester
	 **/
	public function __construct($format) {
		$this->string = $format;
		$this->fields = $this->parse_format($format);
	} // end func: __construct



	/**
	 * Test if this Expression is satisifed by given time
	 *
	 * @param array/int Getdate array or timestamp
	 * @return bool True if satisfied
	 * @author Luke Lanchester
	 **/
	public function test($time = null) {
		if(!is_array($time)) $time = getdate($time);
		foreach(static::$order as $field) {
			if(!$this->fields[$field]->test($time)) return false;
		}
		return true;
	} // end func: test



	/**
	 * Given an input format, break it down into Fields
	 *
	 * @param string Input format
	 * @return array Field elements
	 * @author Luke Lanchester
	 **/
	private function parse_format($format) {

		$format = strtoupper($format);
		$format = str_replace('?', '*', $format);
		$parts  = explode(' ', $format);
		$count  = count($parts);

		if($count < 5 or $count > 6) throw new \InvalidArgumentException('Invalid Cron Format expression provided');

		return array(
			'minute' => new Field_Minute($parts[0]),
			'hour'   => new Field_Hour($parts[1]),
			'dom'    => new Field_DayOfMonth($parts[2]),
			'month'  => new Field_Month($parts[3]),
			'dow'    => new Field_DayOfWeek($parts[4]),
			'year'   => new Field_Year($count === 6 ? $parts[5] : '*'),
		);

	} // end func: parse_format



	/**
	 * Return original cron expression
	 *
	 * @return string Format
	 * @author Luke Lanchester
	 **/
	public function __toString() {
		return $this->string;
	} // end func: __toString



} // end class: Format