<?php include($_SERVER['DOCUMENT_ROOT'].'/e-commerce/php/init.php'); ?>

<?php include($_SERVER['DOCUMENT_ROOT'].'/e-commerce/partials/__header.php'); ?>

<?php $product = productDetails(); ?>

<h1><?= $product['productDetails']['product_name']; ?></h1>
<h3><?= $product['productDetails']['product_type']; ?></h3>
<h3><?= $product['productDetails']['min_stock']; ?></h3>

<br>
<h3>Total : <?= $product['totalQuantity']['total']; ?></h3>
<a href="product_list.php">Product</a>
<a href="add_new_stock.php?id=<?= $product['productDetails']['id']; ?>">Add new stocks</a>

<?php include($_SERVER['DOCUMENT_ROOT'].'/e-commerce/partials/__footer.php'); ?>

