<?php

namespace HybridLogic\Cron;

/**
 * Crontab Job manager
 *
 * @package cron
 * @author Luke Lanchester
 **/
class Crontab {


	/**
	 * @var array Jobs
	 **/
	private $jobs = array();


	/**
	 * Add a Job to this Crontab
	 *
	 * @param Job Job
	 * @return self
	 * @author Luke Lanchester
	 **/
	public function add_job(Job $job) {
		$this->jobs[$job->key()] = $job;
		return $this;
	} // end func: add_job


	/**
	 * Find any execute any jobs set to run
	 *
	 * @param array/int Getdate data or timestamp
	 * @return int Jobs ran
	 * @author Luke Lanchester
	 **/
	public function run($time = null) {

		if(empty($this->jobs)) return;

		if($time === null) $time = time();
		$date = getdate($time);

		$count = 0;

		foreach($this->jobs as $job) {
			$result = $job->run($date);
			if($result) $count++;
		}

		return $count;

	} // end func: run



} // end class: Crontab