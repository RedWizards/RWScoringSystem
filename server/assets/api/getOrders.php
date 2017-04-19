<?php

	header('Content-type: application/json');

	class Order {
		public $id;
		public $firstname;
		public $lastname;
		public $email;
		public $phone;
		public $address;
		public $shipaddress;
		public $zip;
		public $zipship;
		public $timestamp;
		public $date;
		public $total = 0;
		public $items = array();
	}

	class Item {
		public $price;
		public $name;
		public $description;
		public $id;
		public $image;
	}

	require_once("connection.php");

	// Queries all the orders
	$type = $_GET['type'];
	// $queryOrders = "SELECT * FROM orders WHERE type='$type' ORDER BY timestamp DESC";
	$queryOrders = "SELECT * FROM orders WHERE type='$type' ORDER BY timestamp";
	$resultOrders = mysqli_query($link, $queryOrders);

	$arrOrders = array();

	while ($row = mysqli_fetch_array($resultOrders)) {
		$temp = new Order();
		$temp->id = $row['id'];
		$temp->firstname = $row['firstname'];
		$temp->lastname = $row['lastname'];
		$temp->email = $row['email'];
		$temp->phone = $row['phone'];
		$temp->address = $row['address'];
		$temp->shipaddress = $row['shipaddress'];
		$temp->zip = $row['zip'];
		$temp->zipship = $row['zipship'];
		$temp->timestamp = $row['timestamp'];
		$temp->total = 0;

		//Queries all the items for the order
		$orderID = $row['id'];
		$queryItems = "SELECT * FROM productorders WHERE orderID='" .$row['id'] ."'";
		$resultprodorders = mysqli_query($link, $queryItems);

		// $queryprodorders = "SELECT * FROM productorders WHERE orderID='$orderID'";
		// $resultprodorders = mysqli_query($link, $queryprodorders);

		while ($item = mysqli_fetch_array($resultprodorders)) {

			$prodID = $item['productID'];

			$queryproduct = "SELECT * FROM products WHERE id='$prodID' LIMIT 1";
			$resultProduct = mysqli_query($link, $queryproduct);
			$proditem = mysqli_fetch_array($resultProduct);

			// echo "Price";
			// print_r($proditem);
			// $temp->total = $temp->total + ($product[1] * $product['quantity']);

			$temprod = new Item();
			$temprod->price = $proditem['price'];
			$temprod->id = $proditem['id'];
			$temprod->name = $proditem['name'];
			$temprod->description = $proditem['description'];
			$temprod->image = $proditem['image'];
			$temprod->quantity = $item['quantity'];

			$temp->total += ($proditem['price'] * $item['quantity']);

			$temp->items[] = $temprod;
		}

		$arrOrders[] = $temp;

	}

	$json = json_encode($arrOrders);

	echo $json;

?>