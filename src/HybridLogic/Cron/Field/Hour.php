<?php

namespace HybridLogic\Cron;

/**
 * Format: Hour
 *
 * @package cron
 * @author Luke Lanchester
 **/
class Field_Hour extends Field {


	/**
	 * @var string Getdate field key
	 **/
	protected $field = 'hours';


	/**
	 * @var string Minimum range value
	 **/
	protected $min = 0;


	/**
	 * @var string Maximum range value
	 **/
	protected $max = 59;


} // end class: Field_Hour