<?php 
	require "../lib/twilio-php-master/Services/Twilio.php";

	$type = $argv[1];
	$to = $argv[2];
	$msg = $argv[3];
	
	$json = json_decode(file_get_contents("../config/authdetails.json"));


	$AccountSid = $json->accounts->TwilioAccountSID; // Your Account SID from www.twilio.com/console
	$AuthToken = $json->accounts->TwilioAuthToken;   // Your Auth Token from www.twilio.com/console

	$client = new Services_Twilio($AccountSid, $AuthToken);


	echo "MESSAGE 2: $msg";
	// $message = $client->account->messages->create(array(
	//     "From" => "+14318004272 ", // From a valid Twilio number
	//     "To" => "+14388314268",   // Text this number
	//     "Body" => $msg 
	// ));

	// Display a confirmation message on the screen
	// echo "Sent message {$message->sid}";


?>