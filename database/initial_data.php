<?php
	header('Content-type: application/json');
	require_once('connection.php');

	if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    	$judge_id = $_GET['judge_id'];

    	//array variables
    	$teams = array();

		$sql = "CALL judge_scoresheet('".$judge_id."')";

		if(!($res = $conn->query($sql))){
			echo "SELECT failed: (" . $conn->errno . ") " . $conn->error;
		}
		else{
			while($row = $res->fetch_assoc()){
				$team = array();
				$criteria = array();
				$total = 0;

				foreach ($row as $key => $value) {
					switch($key){
						case 'project_id':
							$team['project_id'] = intval($value);
							break;
						case 'project_name':
							$team['project_name'] = $value;
							break;
						case 'team_id':
							$team['team_id'] = intval($value);
							break;
						case 'team_name':
							$team['team_name'] = $value;
							break;
						default:
							$temp_criteria = array();
							$temp_criteria['name'] = $key;
							$temp_criteria['max'] = 25;
							$temp_criteria['score'] =  floatval($value);

							array_push($criteria, $temp_criteria);

							$total += $value;
							break;
					}
				}
				$team['criteria'] = $criteria;
				$team['total'] = $total;
				$team['isActive'] = false;
				array_push($teams, $team);
			}
		}
		echo json_encode($teams);
	}
	else{
		echo "Invalid Request!";
	}
?>