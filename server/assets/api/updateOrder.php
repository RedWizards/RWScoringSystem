<?php

    header('Content-type: application/json');
    require_once("connection.php");

    // Queries all the orders
    $type = $_POST['type'];
    $id = $_POST['id'];
    $query = "UPDATE `orders` SET `type`='$type' WHERE `id`='$id'";
    $result = mysqli_query($link, $query);

    /* 
    $query = "SELECT FROM orders WHERE id='$id' LIMIT 1";
    $result = mysqli_query($link, $query);

    $row = mysqli_fetch_array($result);

    $orderID = $row['orderID'];
    $itemsquery = "SELECT * FROM productorders WHERE orderID='$orderID'";
    $itemsresult = mysqli_query($link, $itemsquery);

    $items_msg = "";

    foreach ($cart as $key => $order) {
			$query = "INSERT INTO `productorders`(`orderID`, `productID`, `quantity`) VALUES ('" .$id
				."', '" .$order->id
				."', '" .$order->qty ."')";
			mysqli_query($link, $query);
			$items_msg = $items_msg .$order->name .", " .$order->price .", " .$order->qty ."qty= " .$order->qty*$order->price ."\n";
		}

	$to = $row['email'];
	$subject = "Thank for shopping with us";
	$txt = "Thank you for shopping with us. Your order is currently" .$_GET['type'] .\n\n" .$items_msg;
	$message = wordwrap($txt, 70);
	$headers = "From: shopislife@example.com";
	mail($to,$subject,$txt,$headers);
    */


?>