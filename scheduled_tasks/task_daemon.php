

<?php
	define(CURRENT_TASK, 0);

	while(true){
		
		$json = json_decode(file_get_contents("task_queue.json"),true);

		if ($json["tasks"][CURRENT_TASK]['time'] <= time()) {
			$command = "php ../src/execute_task.php " 
				. $json["tasks"][CURRENT_TASK]['type'] . " " 
				. $json["tasks"][CURRENT_TASK]['to'] . " " 
				. "\"" . $json["tasks"][CURRENT_TASK]['message'] . "\""  
				. " &";
			exec($command); 
			array_shift($json["tasks"]);
			$json_write_out = json_encode($json);
			file_put_contents("task_queue.json", $json_write_out);
		} else {
			//echo ("JSON Task Time: " . $json["tasks"][0]['time'] . " TIME: " . time()); 
			sleep(20);

			// sleep($json["tasks"][CURRENT_TASK]['time'] - time()); //Sleeps until next task, adding_task.php will wake up the script. 
		}
	}
?>
