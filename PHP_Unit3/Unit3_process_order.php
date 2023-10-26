<!DOCTYPE html>
<html>
<head>

    <title>Order Confirmation</title>
    <link rel="stylesheet" type="text/css" href="Unit3_common.css">
    <link rel="stylesheet" type="text/css" href="Unit3_store.css">
</head>
<body>

    <?php include 'Unit3_header.php'; ?>
    <main>

        <h2>Order Confirmation</h2>
        <?php


        $product = $_POST['product'];
        $quantity = $_POST['quantity'];

        if ($product == "iPhone XR"){
            $product_price = 1000.99;
        } else if ($product == "Samsung Galaxy S68"){
            $product_price = 600.04;
        } else if ($product == "Flip Phone"){
            $product_price = 55.34;
        }
        $donation = isset($_POST['donation']) ? $_POST['donation'] : 'no';

        $subtotal = $quantity * $product_price;
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $email = $_POST['email'];
        $tax_rate = 0.06;
        $tax = number_format($subtotal * $tax_rate, 2);

        $total = $subtotal + $tax;

        if ($donation === 'yes') {
            $rounded_total = ceil($total);
        } else {
            $rounded_total = $total;
        }
        ?>

        <p><strong>Order Details:</strong></p>

        <p>First Name: <?php echo $first_name; ?></p>

        <p>Last Name: <?php echo $last_name; ?></p>

        <p>Email: <?php echo $email; ?></p>

        <p>Product: <?php echo $product; ?></p>

        <p>Quantity: <?php echo $quantity; ?></p>


        <p><strong>Product Price: </strong> $<?php echo $product_price; ?></p>

        <p><strong>Calculations:</strong></p>

        <p>Subtotal: $<?php echo $subtotal; ?></p>

        <p>Tax (<?php echo $tax_rate * 100; ?>%): $<?php echo $tax; ?></p>

        <p><strong>Total:</strong> $<?php echo $rounded_total; ?></p>

    </main>
    <?php include 'Unit3_footer.php'; ?>
</body>
</html>