<?php 
	$json = json_decode(file_get_contents("/var/www/html/twilio/scheduled_tasks/task_queue.json"),true);
	$msg = $argv[1];
	$time = $argv[2];

	$task_queue_task = array (
		'type'=> 'text',
		'to'=> '4388314268',
		'message'=> $msg,
		'time'=> $time
			
	);
	
	array_unshift($json['tasks'], $task_queue_task);
	$json_write_out = json_encode($json);
	file_put_contents("/var/www/html/twilio/scheduled_tasks/task_queue.json", $json_write_out);

 ?>