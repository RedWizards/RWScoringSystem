<?php
	require_once('connection.php');

	if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    	$event_id = $_GET['event_id'];
		$team_name = $_GET['team_name'];
		$leader_name = $_GET['leader_name'];
		$leader_email = $_GET['leader_email'];
		$member1_name = $_GET['member1_name'];
		$member1_email = $_GET['member1_email'];
		$member2_name = $_GET['member2_name'];
		$member2_email = $_GET['member2_email'];
		$member3_name = $_GET['member3_name'];
		$member3_email = $_GET['member3_email'];
		$member4_name = $_GET['member4_name'];
		$member4_email = $_GET['member4_email'];
		$project_name = $_GET['project_name'];
		$project_type = $_GET['project_type'];
		$short_description =$_GET['short_description'];
		$long_description =$_GET['short_description'];

		$sql = "CALL register_team('".
			$event_id."','".
			$team_name."','".
			$leader_name."','".
			$leader_email."','".
			$member1_name."','".
			$member1_email."','".
			$member2_name."','".
			$member2_email."','".
			$member3_name."','".
			$member3_email."','".
			$member4_name."','".
			$member4_email."','".
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