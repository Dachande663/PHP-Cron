<?php

namespace HybridLogic\Cron;

/**
 * A Cron Job
 *
 * @package cron
 * @author Luke Lanchester
 **/
class Job {


	/**
	 * Job Factory
	 *
	 * @param string Job key
	 * @return Job New Job
	 * @author Luke Lanchester
	 **/
	public static function factory($key) {
		return new Job($key);
	} // end func: factory



	/**
	 * @var string Job key
	 **/
	private $key;


	/**
	 * @var array Cron expression formats
	 **/
	private $formats = array();


	/**
	 * @var array Job callbacks
	 **/
	private $callbacks = array();


	/**
	 * Constructor
	 *
	 * @param string Job key
	 * @return void
	 * @author Luke Lanchester
	 **/
	public function __construct($key) {
		$this->key($key);
	} // end func: __construct



	/**
	 * Get or set Job key
	 *
	 * @param string Job key
	 * @return self/string
	 * @author Luke Lanchester
	 **/
	public function key($key = null) {
		if($key === null) return $this->key;
		$this->key = $key;
		return $this;
	} // end func: key



	/**
	 * Add a cron expression
	 *
	 * @param string Cron expression format
	 * @return self
	 * @author Luke Lanchester
	 **/
	public function on($format) {
		$this->formats[] = Format::factory($format);
		return $this;
	} // end func: on



	/**
	 * Add callback to fire for job
	 *
	 * @param callback Callback
	 * @return self
	 * @author Luke Lanchester
	 **/
	public function trigger($callback) {
		$this->callbacks[] = $callback; // Lazy evaluate
		return $this;
	} // end func: trigger



	/**
	 * Determine if this Job is set to be run, if so, run it
	 *
	 * @param array/int Getdate array or timestamp
	 * @return void
	 * @author Luke Lanchester
	 **/
	public function run($time) {

		if(empty($this->formats) or empty($this->callbacks)) return false;

		if(!is_array($time)) $time = getdate($time);

		$should_run = false;
		foreach($this->formats as $format) {
			if(!$format->test($time)) continue;
			$should_run = true;
			break;
		}
		if(!$should_run) return false;

		foreach($this->callbacks as $callback) {
			if(!is_callable($callback)) continue;
			call_user_func($callback);
		}

		return true;

	} // end func: run



} // end class: Job