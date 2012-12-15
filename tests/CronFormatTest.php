<?php

include './autoload.php';

date_default_timezone_set('UTC');

class CronFormatTest extends PHPUnit_Framework_TestCase {


	/**
	 * @var array Time aliases
	 **/
	public static $times = array(
		'2012-12-01 12:30' => 1354365000,
		'2012-12-31 12:30' => 1356957000,
	);


	/**
	 * Test Format executions
	 *
	 * @return void
	 * @author Luke Lanchester
	 * @dataProvider providerFormats
	 **/
	public function testFormats($time, $format, $execute) {
		$obj = new \HybridLogic\Cron\Format($format);
		$result = $obj->test($time);
		$this->assertEquals($execute, $result);
	} // end func: testFormats



	/**
	 * Test datas
	 *
	 * @return array Datas
	 * @author Luke Lanchester
	 **/
	public function providerFormats() {

		return array(

			// Complete
			array(static::$times['2012-12-01 12:30'], '* * * * * *', true),
			array(static::$times['2012-12-01 12:30'], '30 12 1 12 6 2012', true),


			/// Minutes
			array(static::$times['2012-12-01 12:30'], '30 * * * *', true),
			array(static::$times['2012-12-01 12:30'], '31 * * * *', false),

			// List
			array(static::$times['2012-12-01 12:30'], '0,15,30,45 * * * *', true),
			array(static::$times['2012-12-01 12:30'], '0,15,45 * * * *', false),

			// Range
			array(static::$times['2012-12-01 12:30'], '20-30 * * * *', true),
			array(static::$times['2012-12-01 12:30'], '30-40 * * * *', true),
			array(static::$times['2012-12-01 12:30'], '20-40 * * * *', true),
			array(static::$times['2012-12-01 12:30'], '10-29 * * * *', false),
			array(static::$times['2012-12-01 12:30'], '31-40 * * * *', false),

			// Increment
			array(static::$times['2012-12-01 12:30'], '0/15 * * * *', true),
			array(static::$times['2012-12-01 12:30'], '*/15 * * * *', true),
			array(static::$times['2012-12-01 12:30'], '5/15 * * * *', false),
			array(static::$times['2012-12-01 12:30'], '20-40/5 * * * *', true),
			array(static::$times['2012-12-01 12:30'], '20-30/5 * * * *', true),
			array(static::$times['2012-12-01 12:30'], '30-40/5 * * * *', true),
			array(static::$times['2012-12-01 12:30'], '10-20/5 * * * *', false),
			array(static::$times['2012-12-01 12:30'], '40/5 * * * *', false),

			// Combinations
			array(static::$times['2012-12-01 12:30'], '5-10,20-25,30-35,40-45 * * * *', true),
			array(static::$times['2012-12-01 12:30'], '5-10,20-25,40-45 * * * *', false),
			array(static::$times['2012-12-01 12:30'], '10-20/2,25-35/5 * * * *', true),


			/// Hours
			array(static::$times['2012-12-01 12:30'], '* 12 * * *', true),
			array(static::$times['2012-12-01 12:30'], '* 13 * * *', false),

			// List
			array(static::$times['2012-12-01 12:30'], '* 4,8,12,16,20 * * *', true),
			array(static::$times['2012-12-01 12:30'], '* 4,8,16,20 * * *', false),

			// Range
			array(static::$times['2012-12-01 12:30'], '* 10-14 * * *', true),
			array(static::$times['2012-12-01 12:30'], '* 10-12 * * *', true),
			array(static::$times['2012-12-01 12:30'], '* 12-14 * * *', true),
			array(static::$times['2012-12-01 12:30'], '* 7-10 * * *', false),
			array(static::$times['2012-12-01 12:30'], '* 13-19 * * *', false),

			// Increment
			array(static::$times['2012-12-01 12:30'], '* 0/4 * * *', true),
			array(static::$times['2012-12-01 12:30'], '* */4 * * *', true),
			array(static::$times['2012-12-01 12:30'], '* 2/6 * * *', false),
			array(static::$times['2012-12-01 12:30'], '* 9-15/3 * * *', true),
			array(static::$times['2012-12-01 12:30'], '* 9-12/3 * * *', true),
			array(static::$times['2012-12-01 12:30'], '* 12-15/3 * * *', true),
			array(static::$times['2012-12-01 12:30'], '* 9-15/5 * * *', false),
			array(static::$times['2012-12-01 12:30'], '* 14/2 * * *', false),

			// Combinations
			array(static::$times['2012-12-01 12:30'], '* 3-6,9-12,15-18 * * *', true),
			array(static::$times['2012-12-01 12:30'], '* 3-6,15-18 * * *', false),
			array(static::$times['2012-12-01 12:30'], '* 0-9/3,10-14/2 * * *', true),


			/// Day of Month
			array(static::$times['2012-12-01 12:30'], '* * 1 * *', true),
			array(static::$times['2012-12-01 12:30'], '* * 2 * *', false),
			array(static::$times['2012-12-01 12:30'], '* * L * *', false),
			array(static::$times['2012-12-31 12:30'], '* * L * *', true),
			// @todo rest


			/// Month
			array(static::$times['2012-12-01 12:30'], '* * * 12 *', true),
			array(static::$times['2012-12-01 12:30'], '* * * 10 *', false),
			array(static::$times['2012-12-01 12:30'], '* * * 13 *', false),
			// @todo rest


			/// Day of Week
			array(static::$times['2012-12-01 12:30'], '* * * * 6', true),
			array(static::$times['2012-12-01 12:30'], '* * * * 4', false),
			// @todo rest


			/// Year
			array(static::$times['2012-12-01 12:30'], '* * * * * 2012', true),
			array(static::$times['2012-12-01 12:30'], '* * * * * 2013', false),

			// List
			array(static::$times['2012-12-01 12:30'], '* * * * * 2008,2012,2016', true),
			array(static::$times['2012-12-01 12:30'], '* * * * * 2008,2016', false),

			// Range
			array(static::$times['2012-12-01 12:30'], '* * * * * 2008-2016', true),
			array(static::$times['2012-12-01 12:30'], '* * * * * 2008-2012', true),
			array(static::$times['2012-12-01 12:30'], '* * * * * 2012-2016', true),
			array(static::$times['2012-12-01 12:30'], '* * * * * 2008-2011', false),
			array(static::$times['2012-12-01 12:30'], '* * * * * 2013-2016', false),

			// Increment
			array(static::$times['2012-12-01 12:30'], '* * * * * 0/4', true),
			array(static::$times['2012-12-01 12:30'], '* * * * * */4', true),
			array(static::$times['2012-12-01 12:30'], '* * * * * 2008/4', true),
			array(static::$times['2012-12-01 12:30'], '* * * * * 2008/6', false),
			array(static::$times['2012-12-01 12:30'], '* * * * * 2008-2016/4', true),
			array(static::$times['2012-12-01 12:30'], '* * * * * 2012-2016/4', true),
			array(static::$times['2012-12-01 12:30'], '* * * * * 2008-2012/4', true),
			array(static::$times['2012-12-01 12:30'], '* * * * * 2008-2012/5', false),
			array(static::$times['2012-12-01 12:30'], '* * * * * 2011-2012/5', false),

			// Combinations
			array(static::$times['2012-12-01 12:30'], '* * * * * 1991-2007/5,2007-2017/5', true),

		);

	} // end func: providerFormats


} // end class: CronFormatTest