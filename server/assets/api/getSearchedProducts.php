<?php
    header('Content-type: application/json');
    class Product {
        public $id;
        public $name;
        public $price;
        public $description;
        public $image;
    }

    require_once("connection.php");

    $to_search = strtoupper($_GET['query']);
    $tokens = str_replace(" ", "|", $to_search);

    $query = "SELECT * FROM products
        WHERE upper(name) REGEXP '$tokens'  
        OR upper(description) REGEXP '$tokens'
        OR upper(price) REGEXP '$tokens'";
    $result = mysqli_query($link, $query);

    $arr = array();

    while ($row = mysqli_fetch_array($result)) {
        $temp = new Product();
        $temp->id = $row['id'];
        $temp->name = $row['name'];
        $temp->price = $row['price'];
        $temp->description = $row['description'];
        $temp->image = $row['image'];
        $arr[] = $temp;
    }

    $json = json_encode($arr);

    echo $json;

?>