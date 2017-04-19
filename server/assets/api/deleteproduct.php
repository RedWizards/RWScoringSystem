<?php
	header('Content-type: application/json');
	    require_once("connection.php");

	    // Delete product
	    $id = $_GET['id'];
	    $query = "DELETE from `products` WHERE `id`='$id'";
	    $result = mysqli_query($link, $query);
?>