<?php
	header('Content-type: application/json');
	require_once('connection.php');

	$query = "SELECT productorders.productID as ID, SUM(productorders.quantity) as total from products, productorders GROUP BY productorders.productID";
	$result = mysqli_query($link, $query);

	$json = array();

	while ($row = mysqli_fetch_array($result)) {
		$temp = array();
		$temp['value'] = $row['total'];


		$queryName = "SELECT name FROM products WHERE id='" .$row['ID'] ."'";
		$resultName = mysqli_query($link, $queryName);
		$rowName = mysqli_fetch_array($resultName); 

		$temp['label'] = $rowName['name'];
		$temp['color'] = "#" .substr(md5(rand()), 0, 6);
		$json[] = $temp;
	}

	echo json_encode($json);

?>