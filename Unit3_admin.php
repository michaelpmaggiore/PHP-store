<?php
include 'Unit3_header.php';
date_default_timezone_set("America/Denver");
?>

<main>
    <h2>Product Purchase Form</h2>

    <form action="Unit3_process_order.php" method="POST">
        <fieldset>
            <?php
            include 'Unit3_database.php';
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
                        <th>Last Name</th>
                        <th>First Name</th>
                        <th>Email</th>
                    </tr>
                    <?php 
                    $result = getMyCustomers($conn); 
                    if ($result): ?>
                        <?php foreach($result as $row): ?>
                        <tr>
                            <td><?= $row['last_name'] ?></td>
                            <td><?= $row['first_name'] ?></td>
                            <td><?= $row['email'] ?></td>            
                        </tr>
                        <?php endforeach ?>
                    <?php endif ?>
                </table>
            </body>

        </fieldset>

        <fieldset>
            <legend>Orders</legend>
            <body>
                <?php 
                    $result = getNumberOrders($conn);
                    $count = 0;

                    $row = mysqli_fetch_row($result);
                    if ($result && ($row[0] != 0)): ?>
                        
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
                        <th>Product Name</th>
                        <th>Quantity</th>
                        <th>Price</th>
                    </tr>
                    <?php 
                    $result = getAllProducts($conn); 
                    if ($result): ?>
                        <?php foreach($result as $row): ?>
                        <tr>
                            <td><?= $row['product_name'] ?></td>
                            <td><?= $row['in_stock'] ?></td>
                            <td><?= $row['price'] ?></td>            
                        </tr>
                        <?php endforeach ?>
                    <?php endif ?>
                    </table>
            </body>
        </fieldset>

    </form>
</main>


<?php
include 'Unit3_footer.php';
?>