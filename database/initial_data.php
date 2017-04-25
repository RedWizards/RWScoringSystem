<?php
	header('Content-type: application/json');
	require_once('connection.php');

	if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    	$event_id = $_GET['event_id'];
    	$judge_id = $_GET['judge_id'];

    	//array variables
    	$teams = array();
    	$criterias = array();

    	//Query all teams
		$sql = "CALL view_teams(".$event_id.")";
		$result = $conn->query($sql);
		if($result){
		    // Cycle through results
		    while ($row = $result->fetch_object()){
		        array_push($teams,$row);
		    }
		    // Free result set
		    $result->close();
		    $conn->next_result();
		}

		$sql = "CALL view_criteria(".$event_id.")";
		$result = $conn->query($sql);
		if($result){
		    // Cycle through results
		    while ($row = $result->fetch_object()){
		        array_push($criterias,$row);
		    }
		    // Free result set
		    $result->close();
		    $conn->next_result();
		}


		$temp_teams = $teams;	//transfer data to a temporary variable
		$teams = [];			//reset $teams
		foreach($temp_teams as $team){

			//Query all members
			$sql = "CALL view_members(".$team->team_id.")";
			$result = $conn->query($sql);
			if($result){
    			$members = array();

			    // Cycle through results
			    while ($row = $result->fetch_object()){
			        array_push($members, $row);
			    }

			    $team->members = $members;

			    // Free result set
			    $result->close();
			    $conn->next_result();
			}

			//Query scores
			$temp_criterias = $criterias;
			$criterias = [];
			$total = 0;

			//loop all through criterias
			foreach($temp_criterias as $criteria){
				$sql = "CALL view_score(".$team->project_id.",".$judge_id.",".$criteria->criteria_id.")";
				$result = $conn->query($sql);
				if($result){
				    $row = $result->fetch_object();

				    $criteria->score = floatval($row->score);
				    $total += floatval($row->score);

				    // Free result set
				    $result->close();
				    $conn->next_result();
				}
				else{
					$criteria->score = 0;
				}

				array_push($criterias, $criteria);
			}

			$team->criteria = $criterias;
			$team->total = $total;
			array_push($teams, $team);
		}

		echo json_encode($teams);
	}
	else{
		echo "Invalid Request!";
	}
?>