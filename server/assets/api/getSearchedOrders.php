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
        public $status;
        public $items = array();
    }
    require_once("connection.php");

    $to_search = strtoupper($_GET['query']);
    $tokens = str_replace(" ", "|", $to_search);

    $query = "SELECT * FROM orders
        WHERE upper(firstname) REGEXP '$tokens'  
        OR upper(lastname) REGEXP '$tokens'
        OR upper(email) REGEXP '$tokens'
        OR upper(address) REGEXP '$tokens'
        OR upper(shipaddress) REGEXP '$tokens'
        OR upper(zip) REGEXP '$tokens'
        OR upper(zipship) REGEXP '$tokens'
        OR upper(phone) REGEXP '$tokens'
        OR upper(type) REGEXP '$tokens'";
    $result = mysqli_query($link, $query);

    $arrOrders = array();

    while ($row = mysqli_fetch_array($result)) {
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
        $temp->status = $row['type'];
            
        //Queries all the items for the order
        $queryItems = "SELECT productOrders.quantity, products.name, products.price, products.image FROM productorders, products WHERE productorders.orderID='" .$row['id'] ."'";
        $resultItems = mysqli_query($link, $queryItems);

        while ($rowItems = mysqli_fetch_array($resultItems)) {
            //echo "<br />";
            //WWprint_r($rowItems);
            $temp->items[] = $rowItems;
        }
        $arrOrders[] = $temp;
    }

    $json = json_encode($arrOrders);

    echo $json;

?>