<?php

namespace HybridLogic\Cron;

/**
 * Abstract Field type (minute, month etc)
 *
 * @package cron
 * @author Luke Lanchester
 **/
abstract class Field {


	/**
	 * @var string Field expression format
	 **/
	protected $format;


	/**
	 * @var string Getdate field key
	 **/
	protected $field;


	/**
	 * Constructor
	 *
	 * @param string Field format
	 * @return void
	 * @author Luke Lanchester
	 **/
	public function __construct($format) {
		$this->format = $this->parse_format($format);
	} // end func: __construct



	/**
	 * Parse format for Field
	 *
	 * Individual field types may override this to provide
	 * custom functionality.
	 *
	 * @param string Format
	 * @return string Format
	 * @author Luke Lanchester
	 **/
	protected function parse_format($format) {
		return $format;
	} // end func: parse_format



	/**
	 * Is this Field satisfied by the provided getdate data?
	 *
	 * @param array Getdate data
	 * @return bool True if date is satisfied
	 * @author Luke Lanchester
	 **/
	public function test($getdate) {
		return $this->value_in_format($getdate[$this->field], $this->format);
	} // end func: test



	/**
	 * Actually detect if value satisifes format
	 *
	 * @param string Input value
	 * @param string Field format
	 * @return bool True if satisfied
	 * @author Luke Lanchester
	 **/
	protected function value_in_format($value, $format) {

		if($format === '*') return true;

		$formats = explode(',', $format);

		foreach($formats as $format) {

			if(ctype_digit($format)) {
				if($value === (int) $format) return true;
				continue;
			}

			$values = $this->expand_format_expression($format);
			if(in_array($value, $values)) return true;

		}

		return false;

	} // end func: value_in_format



	/**
	 * Expand sub-list within a format
	 *
	 * @param string Format
	 * @return array Accepted values
	 * @author Luke Lanchester
	 **/
	protected function expand_format_expression($format) {

		$increment = 1;

		if(strpos($format, '/') !== false) {
			list($format, $increment) = explode('/', $format, 2);
			$increment = ($increment === '*') ? 1 : (int) $increment;
		}

		$parts = explode('-', $format, 2);

		$start = array_shift($parts);
		$end = array_shift($parts);

		if($start === '*') $start = $this->min;
		if($end === null) $end = $this->max;

		$start = max($this->min, $start);
		$end = min($this->max, $end);

		if( ($end - $start) < $increment) return array($start);
		return range($start, $end, $increment);

	} // end func: expand_format_expression



} // end class: Field