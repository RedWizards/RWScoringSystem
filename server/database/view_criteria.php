<?php
	header('Content-type: application/json');
	require_once('connection.php');

	if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    	$event_id = $_GET['event_id'];

		$sql = "CALL view_criteria('".$event_id."')";

		if(!($res = $conn->query($sql))){
			echo "SELECT failed: (" . $conn->errno . ") " . $conn->error;
		}
		else{
			echo json_encode($res);
		}
	}
	else{
		echo "Invalid Request!";
	}
?>