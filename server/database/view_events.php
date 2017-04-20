<?php
	header('Content-type: application/json');
	require_once('connection.php');

	if ($_SERVER['REQUEST_METHOD'] === 'GET') {
		
		$sql = "SELECT * FROM event";

		if(!($res = $conn->query($sql))){
			echo "Query failed: ( ".$conn->errno." ) " . $conn->error;
		}
		else{

			$events = array();

			while($row = $res->fetch_assoc()){
				array_push($events, $row);
			}

			echo json_encode($events);
		}
	}
	else{
		echo "Invalid Request!";
	}
?>