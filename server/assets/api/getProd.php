<?php

	require('connection.php');

	$id=$_GET['id'];
	$query = "SELECT * FROM products WHERE id='$id'";

	$result = mysqli_query($link, $query);

	$row = mysqli_fetch_row($result);

	print_r($row);
	

?>