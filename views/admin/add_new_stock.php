<?php include($_SERVER['DOCUMENT_ROOT'].'/e-commerce/php/init.php'); ?>

<?php include($_SERVER['DOCUMENT_ROOT'].'/e-commerce/partials/__header.php'); ?>

<?php
addStock();
$product = productDetails();
$sellerDetails =  userDetails();
?>

<form action="" method="post" enctype="multipart/form-data">
    <label for="product_image">Product Image</label>
    <input type="file" name="product_image">

    <label for="brand_name">Brand Name</label>
    <input type="text" name="brand_name" placeholder="Enter brand name" required />

    <label for="quantity">Quantity</label>
    <input type="number" name="quantity" min="1" value="1">

    <label for="quantity">Price</label>
    <input type="number" name="price" min="1" value="1">

    <label for="batch_number">Batch Number</label>
    <input type="text" id="batch_number" name="batch_number" readonly required />

    <!-- Button to generate a new batch number -->
    <button type="button" id="generateButton">Generate Batch Number</button>

    <input type="hidden" name="product_id" value="<?= $product['productDetails']['id']; ?>">
    <input type="hidden" name="added_by" value="<?= $sellerDetails['fullname'];?>">

    <input type="submit" name="submit" value="Add Stock">
</form>

<a href="product_list.php">Product List</a>


<script>
    function generateBatchNumber(length) {
        const characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        let batchNumber = '';

        for (let i = 0; i < length; i++) {
            batchNumber += characters.charAt(Math.floor(Math.random() * characters.length));
        }

        return batchNumber;
    }

    document.addEventListener('DOMContentLoaded', function () {
        // Generate and set the initial batch number on page load
        updateBatchNumber();

        // Attach event listener to the button to generate a new batch number
        const generateButton = document.getElementById('generateButton');
        generateButton.addEventListener('click', function () {
            updateBatchNumber();
        });
    });

    function updateBatchNumber() {
        const batchNumberInput = document.getElementById('batch_number');
        batchNumberInput.value = generateBatchNumber(6);
    }
</script>

<?php include($_SERVER['DOCUMENT_ROOT'].'/e-commerce/partials/__footer.php'); ?>