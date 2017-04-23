<?php

	header('Content-type: application/json');

	$arrEvents = [];
	
	$event1["event_id"] = "1";
	$event1["name"] = "U:hac 3.0";
	$event1["description"] = "The most delicious hackathon";
	$event1["organizer"] = "Unionbank";
	$event1["date"] = "04-22-2017";
	
	$event2["event_id"] = "2";
	$event2["name"] = "PLDT88";
	$event2["description"] = "The most delicious hackathon";
	$event2["organizer"] = "PLDT Org";
	$event2["date"] = "04-22-2017";
	
	// append to the array event
	$arrEvents[] = $event1;
	$arrEvents[] = $event2; // so we have two records
	
	
	echo json_encode($arrEvents);



?>