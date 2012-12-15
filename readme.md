PHP Crontab
====================

PHP Crontab is a crontab written in pure PHP. This is
useful for when dealing with many content managed jobs and
a regular crontab would be inefficient.


0.0 Table of Contents
---------------------

1.0 Introduction
2.0 Examples
3.0 Running Tests
4.0 Troubleshooting
5.0 Changelog


1.0 Introduction
----------------

PHP Crontab provides a simple way to register multiple PHP
jobs to execute at certain times. Simply set up a regular
crontab to hit the script and add as many jobs as you need
to.

PHP Crontab supports (almost) the entire crontab expression
format syntax. Each Job can have multiple expressions and
trigger multiple callbacks.

Cron expression format:

  * * * * * *
  minute | hour | day of month | month | day of week | year (optional)

Field formats:

  * = All values
  / = Range increment
  , = List values
  - = Range

Currently only the L keyword is supported for Day of month,
to identify the last day of the month. W, # and L (for day
of week) are currently *NOT* supported.


2.0 Examples
------------

    $crontab = new \HybridLogic\Cron\Crontab;

    $crontab->add_job(
    	\HybridLogic\Cron\Job::factory('test')
    		->on('* * * * *')
    		->trigger(function(){
    			echo "test run\n";
    		})
    	);

    $count = $crontab->run();
    echo "Executed $count job(s)";


3.0 Running Tests
-----------------

phpunit tests


4.0 Troubleshooting
-------------------

Nothing here yet.


5.0 Changelog
-------------

[2012-12-14] Initial Version
