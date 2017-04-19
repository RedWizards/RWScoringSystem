<?php
	header('Content-type: application/json');
	require_once('connection.php');

	$query = "SELECT EXTRACT(DAY FROM timestamp) as DAY, COUNT(*) as DAY_TOTAL FROM orders WHERE EXTRACT(MONTH FROM timestamp)=EXTRACT(MONTH FROM CURRENT_TIMESTAMP) GROUP BY EXTRACT(DAY FROM timestamp)";

	$result = mysqli_query($link, $query);

	$json = array();

	while($row = mysqli_fetch_array($result)) {
		$temp = array();
		$temp['DAY'] = $row['DAY'];
		$temp['DAY_TOTAL'] = intval($row['DAY_TOTAL']);
		$json[] = $temp;
	}

	echo json_encode($json);
?>