<?php
	header('Content-type: application/json');
	require_once('connection.php');

	if ($_POST['isReturning'] == 'false') {
		// HANDLE USER
		// check first if there is already a record
		$firstname = $_POST['firstname'];
		$lastname = $_POST['lastname'];
		$phone = $_POST['phone'];
		$address = $_POST['address'];
		$shipaddress = $_POST['shipaddress'];
		$zip = $_POST['zip'];
		$zipship = $_POST['zipship'];
		$password = $_POST['password'];
		$email = $_POST['email'];
		$query = "SELECT * FROM users WHERE password='$password' AND email='$email' LIMIT 1";

		$result = mysqli_query($link, $query);

		if (mysqli_num_rows($result) > 0) {
			// already on the table, update
		} else {
			// not on the table, insert
			$query = "INSERT INTO users (firstname, lastname, phone, address, shipaddress, zip, zipship, email, password) VALUES ('$firstname', '$lastname', '$phone', '$address', '$shipaddress', '$zip', '$zipship', $email', '$password')";
			mysqli_query($link, $query);
		}

		// end of handling user

		// hand the orders
		$query = "INSERT INTO orders (firstname, lastname, email, phone, address, shipaddress, zip, zipship) VALUES ('" .$_POST['firstname']
		."', '" .$_POST['lastname']
		."', '" .$_POST['email']
		."', '" .$_POST['phone']
		."', '" .$_POST['address']
		."', '" .$_POST['shipaddress']
		."', '" .$_POST['zip']
		."', '" .$_POST['zipship'] ."')";

		mysqli_query($link, $query);
		$id = mysqli_insert_id($link);
		$cart = json_decode($_POST['cart']);
		//Iterates on the cart items
		$items_msg = "";
		foreach ($cart as $key => $order) {
			if ($order->qty == 0) {
				continue;
			}
			$query = "INSERT INTO `productorders`(`orderID`, `productID`, `quantity`) VALUES ('" .$id
				."', '" .$order->id
				."', '" .$order->qty ."')";
			mysqli_query($link, $query);
			$items_msg = $items_msg .$order->name .", " .$order->price .", " .$order->qty ."qty= " .$order->qty*$order->price ."\n";
		}

		$to = $_POST['email'];
		$subject = "Thank for shopping with us";
		$txt = "Thank you for shopping with us. Your order is received and is currently processed for shipping.\n\n" .$items_msg;
		$message = wordwrap($txt, 70);
		$headers = "From: shopislife@example.com";
		mail($to,$subject,$txt,$headers);

		echo "{'response': 'Success'}";

	} else if ($_POST['isReturning'] == 'true') {
		// search for the user here
		$password = $_POST['password'];
		$email = $_POST['email'];
		$query = "SELECT * FROM users WHERE password='$password' AND email='$email' LIMIT 1";

		// query if the user exist
		$result = mysqli_query($link, $query);

		if (mysqli_num_rows($result) > 0) {
			// get the user info
			$row = mysqli_fetch_array($result);

			// handle the orders
			$query = "INSERT INTO orders (firstname, lastname, email, phone, address, shipaddress, zip, zipship) VALUES ('".$row['firstname']
			."', '" .$_POST['lastname']
			."', '" .$_POST['email']
			."', '" .$_POST['phone']
			."', '" .$_POST['address']
			."', '" .$_POST['shipaddress']
			."', '" .$_POST['zip']
			."', '" .$_POST['zipship'] ."')";

			mysqli_query($link, $query);
			$id = mysqli_insert_id($link);
			$cart = json_decode($_POST['cart']);
			//Iterates on the cart items
			foreach ($cart as $key => $order) {
				$query = "INSERT INTO `productorders`(`orderID`, `productID`, `quantity`) VALUES ('" .$id
					."', '" .$order->id
					."', '" .$order->qty ."')";
				mysqli_query($link, $query);
			}
			echo "{'response': 'Success'}";
		} else {
			echo "{'response': 'Fail'}";
		}
		
	}

?>