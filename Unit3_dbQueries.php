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