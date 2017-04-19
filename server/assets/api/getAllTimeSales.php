<?php
	header('Content-type: application/json');
	require_once('connection.php');

	$query = "SELECT EXTRACT(MONTH FROM timestamp) as MONTH, COUNT(*) as MONTH_TOTAL FROM orders GROUP BY EXTRACT(MONTH FROM timestamp)";

	$result = mysqli_query($link, $query);

	$json = array();

	while($row = mysqli_fetch_array($result)) {
		$temp = array();
		$temp['MONTH'] = date("F", mktime(0, 0, 0, intVal($row['MONTH']), 10));
		$temp['MONTH_TOTAL'] = intval($row['MONTH_TOTAL']);
		$json[] = $temp;
	}

	echo json_encode($json);



?>