<?php
include 'Unit2_header.php';
?>

<main>
    <h2>Product Purchase Form</h2>

    <form action="Unit2_process_order.php" method="POST">
        <fieldset>
            <?php
            include 'Unit2_database.php';
            $conn = getConnection();
            ?> 
            <legend>Customers</legend>
            <head>
            <style>
                table {
                    border-collapse: collapse;
                    width: 100%;
                }

                th, td, table{
                    padding: 10px;
                    border: 1px solid #000;
                }
            </style>
            <title>Test it!</title>
            </head>
            <body>
                <table>
                    <tr>
                        <th>Customer #</th>
                        <th>Last Name</th>
                        <th>First Name</th>
                        <th>Email</th>
                    </tr>
                    <?php 
                    $result = getMyCustomers($conn); 
                    if ($result): ?>
                        <?php foreach($result as $row): ?>
                        <tr>
                            <td><?= $row['id'] ?></td>
                            <td><?= $row['last_name'] ?></td>
                            <td><?= $row['first_name'] ?></td>
                            <td><?= $row['email'] ?></td>            
                        </tr>
                        <?php endforeach ?>
                    <?php endif ?>
                    </table>

                    <?php 
                        $result = getNumberCustomers($conn); 
                        $count = 0;

                        if ($result) {
                            $row = mysqli_fetch_row($result);

                            if ($row) {
                                $count = $row[0];
                            }
                        }
                    ?>
                        <br>

                        <tr>
                            <td>Number of customers: <?= strval($count) ?></td>
                        </tr>
                    
                    <?php 
                        $customerID = 2;
                        $result = findCustomerByID($conn, $customerID); 

                        if ($result):
                                $row = mysqli_fetch_row($result);

                                $first_name = $row[1];
                                $last_name = $row[2];
                                ?>
                                <br>

                                <tr>
                                    <td>Customer <?=$customerID?> is: <?= strval($first_name) ?> <?= strval($last_name) ?></td>
                                </tr>
                                <br>
                        <?php endif ?>

                    <?php 
                        $customerID = 3;
                        $result = findCustomerByID($conn, $customerID); 

                        ?>

                        <?php if ($result && ($row = mysqli_fetch_row($result))): 
                            $first_name = $row[1];
                            $last_name = $row[2];
                            ?>
                            <tr>
                                <td>Customer is: <?= strval($first_name) ?> <?= strval($last_name) ?></td>
                            </tr>
                        <?php else: ?>
                            <tr>
                                <td>Customer <?=$customerID?> does not exist!!</td>
                            </tr>
                        <?php endif; ?>

                    <?php 
                        $customerEmail = "mmouse@mines.edu";
                        $atIndex = strpos($customerEmail, '@');
                        if ($atIndex !== false) {
                            $username = substr($customerEmail, 0, $atIndex);
                            $result = findCustomerByEmail($conn, $customerEmail);
                            ?>
                            <br>
                            <?php if ($result && ($row = mysqli_fetch_row($result))): 
                                $first_name = $row[1];
                                $last_name = $row[2];
                                ?>
                                <tr>
                                    <td>Finding customer by email: <?= strval($customerEmail) ?>... <?= strval($username) ?> is <?= strval($first_name) ?> <?= strval($last_name) ?></td>
                                </tr>
                            <?php else: ?>
                                <tr>
                                    <td>Customer with username "<?= strval($username) ?>" does not exist!!</td>
                                </tr>
                            <?php endif;
                        } else {
                            ?>
                            <tr>
                                <td>Invalid email address</td>
                            </tr>
                            <?php
                        }
                    ?>

                    <?php 
                        $customerEmail = "smcduck@mines.edu";
                        $atIndex = strpos($customerEmail, '@');
                        if ($atIndex !== false) {
                            $username = substr($customerEmail, 0, $atIndex);
                            $result = findCustomerByEmail($conn, $customerEmail);
                            ?>
                            <br>
                            <?php if ($result && ($row = mysqli_fetch_row($result))): 
                                $first_name = $row[1];
                                $last_name = $row[2];
                                ?>
                                <tr>
                                    <td>Finding customer by email: <?= strval($customerEmail) ?>... <?= strval($username) ?> is <?= strval($first_name) ?> <?= strval($last_name) ?></td>
                                </tr>
                            <?php else: ?>
                                <tr>
                                    <td>Finding customer by email: <?= strval($customerEmail) ?>... <?= strval($username) ?> not found!!!</td>
                                </tr>
                            <?php endif;
                        } else {
                            ?>
                            <tr>
                                <td>Invalid email address</td>
                            </tr>
                            <?php
                        }
                    ?>

                    <?php
                        $id = 3;
                        $first_name = "Scrooge";
                        $last_name = "McDuck";
                        $email = "smcduck@mines.edu";
                        addCustomer($conn, $id, $first_name, $last_name, $email);
                    ?>
                    <br>
                    <tr>
                        <td>Adding new customer <?=$first_name?> <?=$last_name?></td>
                    </tr>

                    <?php 
                        $customerEmail = "smcduck@mines.edu";
                        $atIndex = strpos($customerEmail, '@');
                        if ($atIndex !== false) {
                            $username = substr($customerEmail, 0, $atIndex);
                            $result = findCustomerByEmail($conn, $customerEmail);
                            ?>
                            <br>
                            <?php if ($result && ($row = mysqli_fetch_row($result))): 
                                $first_name = $row[1];
                                $last_name = $row[2];
                                ?>
                                <tr>
                                    <td>Finding customer by email: <?= strval($customerEmail) ?>... <?= strval($username) ?> is <?= strval($first_name) ?> <?= strval($last_name) ?></td>
                                </tr>
                            <?php else: ?>
                                <tr>
                                    <td>Finding customer by email: <?= strval($customerEmail) ?>... <?= strval($username) ?> not found!!!</td>
                                </tr>
                            <?php endif;
                        } else {
                            ?>
                            <tr>
                                <td>Invalid email address</td>
                            </tr>
                            <?php
                        }
                    ?>

            </body>

        </fieldset>

        
        <fieldset>
            <legend>Orders</legend>
            <body>
                <?php 
                    $result = getNumberOrders($conn);
                    $count = 0;

                    $row = mysqli_fetch_row($result);
                    if ($result && ($row[0] != 0)):
                        

                        if ($row) {
                            $count = $row[0];
                        }
                        ?>
                        <td>Number of orders: <?= strval($count) ?></td>

                    <?php else: ?>
                        <tr>
                            <td>No orders yet</td>
                        </tr>
                    <?php endif;

                ?>


            <?php
                date_default_timezone_set("America/Denver");
                $id = 1;
                $product_id = 1;
                $customer_id = 2;
                $quantity = 9;
                $price = 6.00;
                $tax = 5.00;
                $donation = 2.00;
                $timestamp = strtotime(date("m/d/y h:i A"));
                addOrder($conn,$id,$product_id,$customer_id,$quantity,$price,$tax,$donation,$timestamp);
                ?>
                <br>
                <tr>
                    <td>Adding an order</td>
                </tr>

                <br> 
                <table>
                    <tr>
                        <th>Customer</th>
                        <th>Phone</th>
                        <th>Date</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Tax</th>
                        <th>Donation</th>
                        <th>Total</th>

                    </tr>
                    <?php 
                    $result = printOrders($conn); 
                    if ($result): ?>
                        <?php foreach($result as $row): 
                        $product_id = $row['product_id'];
                        $customer_id = $row['customer_id'];

                        $product_name = getProduct($conn, $product_id);
                        $row2 = mysqli_fetch_row($product_name);

                        $actual_product_name = $row2[1];                        

                        $customer_name = findCustomerByID($conn, $customer_id);
                            $row3 = mysqli_fetch_row($customer_name);

                            $first_name = $row3[1];
                            $last_name = $row3[2];
                            ?>
                            
                            <br>
                        <tr>
                            <td><?= strval($first_name) ?> <?= strval($last_name) ?></td>
                            <td><?= $actual_product_name ?></td>
                            <td><?= date("m/d/y h:i A", $row['timestamp']) ?></td>
                            <td><?= $row['quantity'] ?></td>            
                            <td><?= $row['price'] ?></td>            
                            <td><?= $row['tax'] ?></td>            
                            <td><?= $row['donation'] ?></td>            
                            <td><?= number_format($row['quantity']*$row['price'] + $row['tax'] + $row['donation'], 2) ?></td>            
            
                        </tr>
                        <?php endforeach ?>
                    <?php endif ?>
                    </table>

                <?php 
                    $result = getNumberOrders($conn);
                    $count = 0;

                    $row = mysqli_fetch_row($result);
                    if ($result && ($row[0] != 0)):
                        

                        if ($row) {
                            $count = $row[0];
                        }
                        ?>
                        <br>
                        <td>Number of orders: <?= strval($count) ?></td>

                    <?php else: ?>
                        <tr>
                            <td>No orders yet</td>
                        </tr>
                    <?php endif;

                ?>

            </body>
        </fieldset>


        <fieldset>
            <legend>Phones</legend>
            <head>
            <style>
                table {
                    border-collapse: collapse;
                    width: 100%;
                }

                th, td, table{
                    padding: 10px;
                    border: 1px solid #000;
                }
            </style>
            <title>Test it!</title>
            </head>
            <body>
                <table>
                    <tr>
                        <th>Product #</th>
                        <th>Product Name</th>
                        <th>Quantity</th>
                        <th>Price</th>
                    </tr>
                    <?php 
                    $result = getAllProducts($conn); 
                    if ($result): ?>
                        <?php foreach($result as $row): ?>
                        <tr>
                            <td><?= $row['id'] ?></td>
                            <td><?= $row['product_name'] ?></td>
                            <td><?= $row['in_stock'] ?></td>
                            <td><?= $row['price'] ?></td>            
                        </tr>
                        <?php endforeach ?>
                    <?php endif ?>
                    </table>

                <?php
                    $amount = 2;
                    $phone_id = 2; 
                    sellProduct($conn, $amount, $phone_id);
                    $result = getProduct($conn, $phone_id);
                    $row = mysqli_fetch_row($result);
                    $phone_name = $row[1];
                    $new_quantity = $row[4];
                ?>
                <br>
                <tr>
                    <td>Selling <?=$amount?> <?=$phone_name?></td>
                    <br>
                    <td>The new quantity for <?=$phone_name?> is <?=$new_quantity?></td>
                </tr>

                <?php

                    $phone_id = 2; 

                    $result = getProduct($conn, $phone_id);
                    $row = mysqli_fetch_row($result);
                    $phone_name = $row[1];
                    $old_quantity = $row[4];

                    $amount = 10;
                    
                    if ($result && ($old_quantity - $amount >= 0)): 
                        sellProduct($conn, $amount, $phone_id);
                        $result = getProduct($conn, $phone_id);
                        $row = mysqli_fetch_row($result);
                        $phone_name = $row[1];
                        $new_quantity = $row[4];
                        ?>
                        <tr>
                            <br>
                            <td>Selling <?=$amount?> <?=$phone_name?></td>
                            <br>
                            <td>The new quantity for <?=$phone_name?> is <?=$new_quantity?></td>
                        </tr>

                    <?php else:
                        sellProduct($conn, $old_quantity, $phone_id);
                        $result = getProduct($conn, $phone_id);
                        $row = mysqli_fetch_row($result);
                        $phone_name = $row[1];
                        $new_quantity = $row[4];
                        ?>
                        <tr>
                            <br>
                            <td>Selling <?=$amount?> <?=$phone_name?></td>
                            <br>
                            <td>The new quantity for <?=$phone_name?> is 0</td>
                        </tr>

                    <?php endif;
                ?>
                <br>

            </body>
        </fieldset>

    </form>
</main>


<?php
include 'Unit2_footer.php';
?>