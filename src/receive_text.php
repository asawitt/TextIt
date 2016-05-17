<?php
    header("content-type: text/xml");
    echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
    //Gets the body from the text message
    $body = (isset($_POST['Body'])) ? $_POST['Body'] : "Remind me to water the plants at 6:30";
    //Gets the source phone-number for user-specific queries
    $from = (isset($_POST['From'])) ? $_POST['From'] : "";	

    //Checks for multi-part texts i.e. "From where?" 
    //Splits the body up into arguments
    $args = explode(" ", $body);

 
    //Searches for the first command present in the $args
    $script = "../commands/" . search_commands($args);
    //Executes script
    // $msg = $script;
    $msg = include $script; 


    $xml_msg = "<Response><Message>" . $msg . "</Message></Response>";

    echo $xml_msg;
    
    function search_commands(&$arguments){
	 	$json = json_decode(file_get_contents("../config/commands.json"));

	    for ($i = 0;$i<count($arguments);$i++){
		 	foreach($json->commands as $command){
		 		 if (strtolower($arguments[$i]) === $command->name){
		 			shift_array_left($arguments, $i+1); // Shifts array left to get rid of command and all previous statements for $script
		 			return $command->script;
		 		}
		 	}
	 	}
	 	return "no_command_found.php";
 	}
 	function shift_array_left(&$array, $num){
		for ($i = 0;$i<$num;$i++) array_shift($array);
	}


	

?>
