<?php

include './autoload.php';

use \HybridLogic\Cron\Crontab;
use \HybridLogic\Cron\Job;

$crontab = new Crontab;

$crontab->add_job(
	Job::factory('test')
		->on('* * * * *')
		->trigger(function(){
			echo "test run\n";
		})
	);

$count = $crontab->run();
echo "Executed $count job(s)";
