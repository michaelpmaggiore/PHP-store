<?php

function getConnection(){
    include 'Unit3_database_credentials.php';

    // Create connection
    $conn = new mysqli($servername, $username, $password, $database);
    
    // Check connection
    if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    }
    $sql = "DELETE FROM `customer` WHERE `id` = 3;";
    $result = $conn->query($sql);

    $sql = "DELETE FROM `orders` WHERE `id` = 3;";
    $result = $conn->query($sql);
    return $conn;
}

// Obtain all customers
function getMyCustomers($conn) {
    $sql = "select * from customer";
    $result = $conn->query($sql);
    return $result;
}

// Finds specific customer by ID
function findCustomerByID($conn, $id) {
    $sql = "select * from customer WHERE `id` = $id";
    $result = $conn->query($sql);
    return $result;
}

// Finds number of customers
function getNumberCustomers($conn) {
    $sql = "select CONVERT(COUNT(*), CHAR(255)) from customer";
    $result = $conn->query($sql);
    return $result;
}

// Find Customer by email
function findCustomerByEmail($conn, $email) {
    $sql = "select * from customer WHERE `email` = '$email'";
    $result = $conn->query($sql);
    return $result;
}

// Add Customer
function addCustomer($conn, $id, $first_name, $last_name, $email) {
    $sql = "
    INSERT INTO customer (id, first_name, last_name, email)
    VALUES ($id, '$first_name', '$last_name', '$email');";
    $result = $conn->query($sql);
}

// Show number of orders
function getNumberOrders($conn) {
    $sql = "select CONVERT(COUNT(*), CHAR(255)) from orders";;
    $result = $conn->query($sql);
    return $result;
}

// Add an order
function addOrder($conn,$id,$product_id,$customer_id,$quantity,$price,$tax,$donation,$timestamp) {
    $sql = "
    INSERT INTO orders (id,product_id,customer_id,quantity,price,tax,donation,timestamp)
    VALUES ($id,$product_id,$customer_id,$quantity,$price,$tax,$donation,'$timestamp');";
    $result = $conn->query($sql);
}

// Prints a table with all orders
function printOrders($conn) {
    $sql = "select * from orders";
    $result = $conn->query($sql);
    return $result;
}

// Shows table with all products' info
function getAllProducts($conn) {
    $sql = "select * from product";
    $result = $conn->query($sql);
    return $result;
}

// Shows a specific product's info by id
function getProduct($conn, $id) {
    $sql = "select * from product WHERE `id` = $id";
    $result = $conn->query($sql);
    return $result;
}

// Sell small amount of stocks
function sellSmallAmount($conn) {
    $sql = "select * from customer";
    $result = $conn->query($sql);
    return $result;
}

function getNewQuantity($conn) {
    $sql = "select * from customer";
    $result = $conn->query($sql);
    return $result;
}

function sellLargeAmmount($conn) {
    $sql = "select * from customer";
    $result = $conn->query($sql);
    return $result;
}

?> 