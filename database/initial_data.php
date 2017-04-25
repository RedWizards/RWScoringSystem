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

		    	//convert team_id and project_id to int
		    	$row->team_id = intval($row->team_id);
		    	$row->project_id = intval($row->project_id);

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

		    	//convert criteria_id to int
		    	$row->criteria_id = intval($row->criteria_id);

		    	//convert criteria_weight to float
				$row->criteria_weight = floatval($row->criteria_weight);

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

			    	//convert member_id to int
			   		$row->participant_id = intval($row->participant_id);

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

				    //convert score_id to int and score to float
				    $row->score_id = intval($row->score_id);
				    $row->score = floatval($row->score);

				    //add to json the score data
				    $criteria->score_details = $row;

				    $total += $row->score;

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