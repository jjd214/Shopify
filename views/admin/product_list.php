<?php include($_SERVER['DOCUMENT_ROOT'].'/e-commerce/php/init.php'); ?>

<?php include($_SERVER['DOCUMENT_ROOT'].'/e-commerce/partials/__header.php'); ?>

<style>
    /* Add space style */
    .space {
        margin-right: 10px; /* You can adjust the margin as needed */
    }
</style>

<?php
// Fetch products and sort them alphabetically by product_name
$products = viewProducts();
usort($products, function($a, $b) {
    return strcmp($a['product_name'], $b['product_name']);
});
?>

<ul>
    <?php foreach($products as $product) { ?>
        <li>
            <label><?= $product['added_by']. " "?></label>
            <span class="space"></span>
            <a href="product_details.php?id=<?= $product['id']; ?>"><?= $product['product_name']; ?> | <?= $product['min_stock']; ?></a>
        </li>
    <?php } ?>
</ul>


<?php include($_SERVER['DOCUMENT_ROOT'].'/e-commerce/partials/__footer.php'); ?>

