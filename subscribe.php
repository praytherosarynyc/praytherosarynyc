<?php

$recipientList = array();//Full array
$recipient = array();//Individual Name/Email

$recipient[] = array('name'=> $_REQUEST['name'], 'mail'=> $_REQUEST['mail']);

array_push($recipientList, $recipient);

$inp = file_get_contents('results.json');
$tempArray = json_decode($inp);
array_push($tempArray, $recipient);
$jsonData = json_encode($tempArray);
file_put_contents('results.json', $jsonData);

//$fp = fopen('results.json', 'w');
//fwrite($fp, json_encode($recipientList));
//fclose($fp);

# SUBJECT (Subscribe/Remove)
$subject = "Thanks for Subscribing!";

# RESULT PAGE
$location = "http://praytherosary.nyc/";

## FORM VALUES ##

# SENDER - WE ALSO USE THE RECIPIENT AS SENDER IN THIS SAMPLE
# DON'T INCLUDE UNFILTERED USER INPUT IN THE MAIL HEADER!
$sender = "praytherosarynyc@gmail.com";

# MAIL BODY
$body .= "Name: ".$_REQUEST['name']." \n";
$body .= "Email: ".$_REQUEST['mail']." \n";
# add more fields here if required

$message = "
<html>
<head>
	<title>Subscription Email</title>
</head>
<body>
	<h1>Thanks for Subscribing to Pray The Rosary NYC!<h1>
  <p>
    You are now subscribed to Pray The Rosary NYC.
		<br/>
		We will occasionally send you email updates regarding praytherosary.nyc
    <br/>
		Any feedback?
		<br/>
		Email us: praytherosarynyc@gmail.com or reply to this email.
		<br/>
		<br/>
		Thanks
		<br/>
		-praytherosarynyc team
  </p>
</body>
</html>
";

## HEADERS ##

$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

$headers .= 'From: <praytherosarynyc@gmail.com>' . "\r\n";

## SEND MESSGAE ##

mail( $_REQUEST['mail'], $subject, $message, $headers) or die ("Mail could not be sent.");

## SHOW RESULT PAGE ##

header( "Location: $location" );
?>
