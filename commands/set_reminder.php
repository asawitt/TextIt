<?php
	
	if (find_in_array("me", $args)) return "Syntax: Remind \"ME\" to _____ at x:xx";
	if (find_in_array("to", $args) != 1) return "Syntax: Remind me \"TO\" _____ at x:xx";
	$end_task_index = find_in_array("at", $args);
	$task_length = $end_task_index - 2;
	$task = join(" ", array_slice($args,2,$task_length));
	echo ("TASK: $task");
	$time = $args[$end_task_index+1];
	//remind me to water the plants at 6:30;
	exec("php ../scheduled_tasks/add_task.php \"Remember to: $task\" 1463507325 &");
	return "I'll remind you to " . $task . " at " . $time;


	function find_in_array($str, &$array){
		for ($i = 0;$i<count($array);$i++){
			if ($array[$i] == $str) return $i;
		}
		return -1;
	}
?>