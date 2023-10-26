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
        <?php
        include 'Unit3_database.php';
        $conn = getConnection();

        $product = $_POST['product'];
        $quantity = $_POST['quantity'];

        $result = getProduct($conn, $product);
        $row2 = mysqli_fetch_row($result);
        $product_name = $row2[1];      

        $result = getProduct($conn, $product);
        $row3 = mysqli_fetch_row($result);
        $product_price = $row3[3];   

        $donation = isset($_POST['donation']) ? $_POST['donation'] : 'no';

        $subtotal = $quantity * $product_price;
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $email = $_POST['email'];
        $tax_rate = 0.06;
        $tax = number_format($subtotal * $tax_rate, 2);

        $total = $subtotal + $tax;

        if ($donation === 'yes') {
            $rounded_total = number_format(ceil($total), 2);
        } else {
            $rounded_total = number_format($total, 2);
        }

        
        ?>
        <?php 
        $customerEmail = $email;
        $atIndex = strpos($customerEmail, '@');
        $flag = False;
        $msg = "";
            if ($atIndex !== false) {
                $username = substr($customerEmail, 0, $atIndex);
                $result = findCustomerByEmail($conn, $customerEmail);
                ?>
                <br>
                <?php if ($result && ($row = mysqli_fetch_row($result))): 
                    $customer_id = $row[0];
                    $first_name = $row[1];
                    $last_name = $row[2];
                    $flag = True;
                ?>
                <?php else: 
                    $flag = False;
                    ?>
                <?php endif;
            } else {
                ?>
                <tr>
                    <td>Invalid email address</td>
                </tr>
                <?php
            }
        if ($flag == False){
            $msg = "Thank you for becoming a customer!";
            addCustomer($conn, $first_name, $last_name, $customerEmail);
            $result = findCustomerByEmail($conn, $customerEmail);
            $row = mysqli_fetch_row($result);
            $customer_id = $row[0];
        } else{
            $msg = "Welcome back!";
        }

        date_default_timezone_set("America/Denver");
        $timestamp = strtotime(date("m/d/y h:i A"));

        $result = printOrders($conn); 
        if ($result):
            foreach($result as $row):
                $db_timestamp

        addOrder($conn,$product,$customer_id,$quantity,$product_price,$tax,$donation,$timestamp);
        
        $result = getProduct($conn, $product);
        $row = mysqli_fetch_row($result);
        $phone_name = $row[1];
        $old_quantity = $row[4];

        if ($result && ($old_quantity - $quantity >= 0)): 
            sellProduct($conn, $quantity, $product);
            ?>

        <?php else:
            sellProduct($conn, $old_quantity, $product);
            ?>
        <?php endif;

        ?>

        <p><strong>Hello <?php echo $first_name; ?> <?php echo $last_name; ?> - </strong><?php echo $msg; ?></p>
        <p>We hope you enjoy your <?php echo $product_name; ?> puzzle!</p>
        <br>
        <p><u> Order details: </u></p>
        <p><?php echo $quantity; ?> @ $<?php echo $product_price; ?>: $<?php echo $subtotal; ?></p>
        <p>Tax (<?php echo $tax_rate * 100; ?>%): $<?php echo $tax; ?></p>

        <?php
            if ($donation === 'yes'):
            ?>
                <p><strong>Subtotal:</strong> $<?php echo $total; ?></p>
                <p><strong>Total with donation:</strong> $<?php echo $rounded_total; ?></p>

            <?php else: 
                $rounded_total = $total;
                ?>
                <p><strong>Total:</strong> $<?php echo $rounded_total; ?></p>
            <?php endif;
            ?>
        <br>
        <p>We'll send special offers to <?php echo $email; ?></p>

    </main>
    <?php include 'Unit3_footer.php'; ?>
</body>
</html>