<?php

$recipientList = array();

$inp = file_get_contents('results.json');
$tempArray = json_decode($inp, TRUE);

foreach($tempArray as $item) {
	array_push($recipientList, $item['mail']);
}

# SUBJECT
$subject = "Pray The Rosary Newsletter";

# RESULT PAGE
$location = "http://praytherosary.nyc/newsletter.html";

## FORM VALUES ##

# SENDER - WE ALSO USE THE RECIPIENT AS SENDER IN THIS SAMPLE
# DON'T INCLUDE UNFILTERED USER INPUT IN THE MAIL HEADER!
$sender = "praytherosarynyc@gmail.com";

# MAIL BODY
$body .= $_REQUEST['title']." \n";
$body .= $_REQUEST['body']." \n";
$body .= "- praytherosarynyc team";
# add more fields here if required

## HEADERS ##

$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

$headers .= 'From: <praytherosarynyc@gmail.com>' . "\r\n";

## SEND MESSGAE ##
foreach($recipientList as $member){
	mail( $member, $subject, $body, $headers) or die ("Mail could not be sent.");
}
## SHOW RESULT PAGE ##

header( "Location: $location" );
?>
