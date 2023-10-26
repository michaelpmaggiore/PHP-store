<?php

function getConnection(){
    include 'Unit3_database_credentials.php';

    // Create connection
    $conn = new mysqli($servername, $username, $password, $database);
    
    // Check connection
    if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    }

    // Resets values for customer, orders, and product quantity!
    // $stmt = $conn->prepare("TRUNCATE TABLE customer");
    // $stmt->execute();

    // $stmt = $conn->prepare("TRUNCATE TABLE orders");
    // $stmt->execute();

    // $in_stock = 10;
    // $id = 2;

    // $stmt = $conn->prepare("
    // UPDATE product
    // SET in_stock = ?
    // WHERE `id` = ?
    // ");
    // $stmt->bind_param("ii", $in_stock, $id);
    // $stmt->execute();

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

    $stmt = $conn->prepare("select * from customer WHERE `id` = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();

    $result = $stmt->get_result();
    
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
    $stmt = $conn->prepare("select * from customer WHERE `email` = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();

    $result = $stmt->get_result();

    return $result;
}

// Add Customer
function addCustomer($conn, $first_name, $last_name, $email) {
    $stmt = $conn->prepare("INSERT INTO customer (first_name, last_name, email)
    VALUES (?, ?,?);");

    $stmt->bind_param("sss", $first_name, $last_name, $email);

    $stmt->execute();
}

// Show number of orders
function getNumberOrders($conn) {
    $sql = "select CONVERT(COUNT(*), CHAR(255)) from orders";;
    $result = $conn->query($sql);
    return $result;
}

// Add an order
function addOrder($conn,$product_id,$customer_id,$quantity,$price,$tax,$donation,$timestamp) {
    $sql = "
    INSERT INTO orders (id,product_id,customer_id,quantity,price,tax,donation,timestamp)
    VALUES ($product_id,$customer_id,$quantity,$price,$tax,$donation,'$timestamp');";

    $stmt = $conn->prepare("INSERT INTO orders (product_id,customer_id,quantity,price,tax,donation,timestamp)
    VALUES (?,?,?,?,?,?,?);");

    $stmt->bind_param("iiiddds", $product_id,$customer_id,$quantity,$price,$tax,$donation,$timestamp);

    $stmt->execute();}

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
    $stmt = $conn->prepare("select * from product WHERE `id` = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();

    $result = $stmt->get_result();
    
    return $result;
}

// Sell small amount of stocks
function sellProduct($conn, $amount, $phone_id) {

    $stmt = $conn->prepare("
    UPDATE product
    SET in_stock = in_stock - ?
    WHERE `id` = ?
    ");
    $stmt->bind_param("ii", $amount, $phone_id);
    $stmt->execute();
}

?> 