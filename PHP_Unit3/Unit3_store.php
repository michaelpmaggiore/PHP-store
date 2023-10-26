<?php
include 'Unit3_header.php';
?>

<main>
    <h2>Product Purchase Form</h2>

    <form action="Unit3_process_order.php" method="POST">

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
                <option value="iPhone XR">iPhone XR - $1000.99</option>
                <option value="Samsung Galaxy S68">Samsung Galaxy S68 - $600.04</option>
                <option value="Flip Phone">Flip Phone - $55.34</option>
            </select>

            <label for="quantity">Quantity</label>
            <input type="number" id="quantity" name="quantity" min="1" max="100" value="1">

            <label>Round up for donation</label>
            <input type="radio" id="donation_yes" name="donation" value="yes" checked>
            <label for="donation_yes">Yes</label>
            <input type="radio" id="donation_no" name="donation" value="no">
            <label for="donation_no">No</label>
        </fieldset>

        <input type="submit" name="purchase" value="Purchase">
    </form>
    <br>
    <p>Select a puzzle to see the image!</p>
    <img id="product_image" src="" alt="Product Image" width="500" height="500" style="visibility:hidden"/>
</main>


<?php
include 'Unit3_footer.php';
?>

<script>
    function updateProductImage() {
        var selectedProduct = document.getElementById("product").value;
        document.getElementById("product_image").style.visibility = 'visible';
        var productImages = {
            "Samsung Galaxy S68": "Galaxy-A03s-blue-1.jpg",
            "Flip Phone": "istockphoto-92377019-612x612.jpg",
            "iPhone XR": "MT4J3.jpg"
        };
        var productImage = document.getElementById("product_image");
        if (productImages.hasOwnProperty(selectedProduct)) {
            productImage.src = "images/" + productImages[selectedProduct];
        } else {
            productImage.src = "images/Galaxy-A03s-blue-1.jpg";
        }
    }
    document.getElementById("product").onchange = updateProductImage;
</script>