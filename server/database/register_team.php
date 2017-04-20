<?php
	require_once('connection.php');

	if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    	$event_id = $_GET['event_id'];
		$team_name = $_GET['team_name'];
		$project_name = $_GET['project_name'];
		$project_type = $_GET['project_type'];
		$short_description =$_GET['short_description'];
		$long_description =$_GET['long_description'];

		$sql = "CALL register_team('".
			$event_id."','".
			$team_name."','".
			$project_name."','".
			$project_type."','".
			$short_description."','".
			$long_description."')";

		if(!$conn->query($sql)){
			echo "CALL failed: ( ".$conn->errno." ) " . $conn->error;
		}
		else{
			echo("Success!");
		}
	}
	else{
		echo "Invalid Request!";
	}
?>