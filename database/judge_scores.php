<?php
	header('Content-type: application/json');
	require_once('connection.php');

	if ($_SERVER['REQUEST_METHOD'] === 'GET') {

		$event_id = $_GET['event_id'];

    	$judges = array();

    	//Query all judges
		$sql = "CALL view_judges(".$event_id.")";
		$result = $conn->query($sql);
		if($result){
		    // Cycle through results
		    while ($row = $result->fetch_object()){

		    	//convert judge_id to int
		    	$row->judge_id = intval($row->judge_id);

		        array_push($judges,$row);
		    }
		    
		    // Free result set
		    $result->close();
		    $conn->next_result();
		}

		$teams = array();

		//Query all judges
		$sql = "CALL view_teams(".$event_id.")";
		$result = $conn->query($sql);
		if($result){
		    // Cycle through results
		    while ($row = $result->fetch_object()){

		    	//convert judge_id to int
		    	$row->team_id = intval($row->team_id);
		    	$row->project_id = intval($row->project_id);

		        array_push($teams,$row);
		    }
		    
		    // Free result set
		    $result->close();
		    $conn->next_result();
		}

		$criterias = array();

		$sql = "CALL view_criteria(".$event_id.")";
		$result = $conn->query($sql);
		if($result){
		    // Cycle through results
		    while ($row = $result->fetch_object()){

		    	//convert judge_id to int
		    	$row->criteria_id = intval($row->criteria_id);

		        array_push($criterias,$row);
		    }
		    
		    // Free result set
		    $result->close();
		    $conn->next_result();
		}

		$temp_judges = array();

		foreach($judges as $judge){

			$temp_teams = array();
			foreach($teams as $team){

				$temp_criterias = array();
				$total = 0;
				foreach($criterias as $criteria){
					$sql = "CALL view_score(".$team->project_id.",".$judge->judge_id.",".$criteria->criteria_id.")";
					$result = $conn->query($sql);
					if($result){
					    $row = $result->fetch_object();

					    $row->score_id = intval($row->score_id);
					    $row->score = floatval($row->score);

					    $total += $row->score;

					    $criteria->score = $row;

					    array_push($temp_criterias,$criteria);
					    
					    $result->close();
					    $conn->next_result();
					}
					else{
						$row->score_id = null;
						$row->score = 0;

						$criteria->score = $row;

						array_push($temp_criterias,$criteria);
					}
				}
				$team->criteria = $temp_criterias;
				$team->total = $total;
				array_push($temp_teams, $team);
			}
			$judge->teams = $temp_teams;
			array_push($temp_judges, $judge);
		}

		echo json_encode($temp_judges);
	}
	else{
		echo "Invalid Request!";
	}
?>