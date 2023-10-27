<?php
include 'Unit3_header.php';
date_default_timezone_set("America/Denver");
?>

<main>
    <h2>Product Purchase Form</h2>

    <form action="Unit3_process_order.php" method="POST">
        <?php
            include 'Unit3_database.php';
            $conn = getConnection();
        ?> 

        <fieldset>
            <legend>Personal Information</legend>
            <label for="first_name">First Name*</label>
            <input type="text" id="first_name" name="first_name" required pattern="[A-Za-z ']+" title="Names can only be include letters, spaces, and apostrophe">

            <label for="last_name">Last Name*</label>
            <input type="text" id="last_name" name="last_name" required pattern="[A-Za-z ']+">

            <label for="email">Email*</label>
            <input type="email" id="email" name="email" required>
        </fieldset>

        <fieldset>
            <legend>Product Information</legend>
            <label for="product">Product*</label>
            <select id="product" name="product" required>
                <option value="" disabled selected>Select a phone</option>
                <?php 
                    $result = getAllProducts($conn); 
                    if ($result): ?>
                        <?php foreach($result as $row): 
                            $phone_id = $row['id'];
                            $phone_name = $row['product_name'];
                            $phone_price = $row['price'];
                            $image_name = $row['image_name'];
                            $quantity = $row['in_stock'];
                        ?>
                        <option value=<?=$phone_id?> image-id=<?=$image_name?> quantity_id=<?=$quantity?>><?=$phone_name?> - $<?=$phone_price?></option>
                        <?php endforeach ?>
                    <?php endif ?>
            </select>

            <label for="quantity">Quantity</label>
            <input type="number" id="quantity" name="quantity" min="1" max="100" value="1">

            <input type="hidden" name="timestamp" value="<?php echo time(); ?>">

            <label>Round up for donation?</label>
            <input for="donation_yes" type="radio" id="donation_yes" name="donation" value="yes" checked>Yes</input>
            <br>
            <input for="donation_no" type="radio" id="donation_no" name="donation" value="no">No</input>

        </fieldset>

        <input type="submit" name="purchase" value="Purchase">
    </form>
    <br>
    <p>Select a puzzle to see the image!</p>

    <p id="quantity_text"></p>

    <img id="product_image" src="" alt="Product Image" width="500" height="500" style="visibility:hidden"/>
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</main>


<?php
include 'Unit3_footer.php';
?>

<script>
    
    $('#product').on("change",function(){
        var image_id = $("#product option:selected").attr('image-id');
        document.getElementById("product_image").style.visibility = 'visible';

        var productImage = document.getElementById("product_image");
        
        productImage.src = "images/" + image_id;
        
        var quantity_id = $("#product option:selected").attr('quantity_id');

        if (quantity_id <= 0){
            document.getElementById("quantity_text").innerHTML = "SOLD OUT!!";
            document.getElementById("quantity_text").style.color="red";
            document.getElementById("quantity_text").style.fontSize="x-large";

        } else if (quantity_id < 5){
            document.getElementById("quantity_text").innerHTML = "Only " + quantity_id + " left";
            document.getElementById("quantity_text").style.color="green";
            document.getElementById("quantity_text").style.fontSize ="x-large";

        } else{
            document.getElementById("quantity_text").innerHTML = "";
        }
    });
</script>