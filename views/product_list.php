<?php include($_SERVER['DOCUMENT_ROOT'].'/e-commerce/php/init.php'); ?>

<?php include($_SERVER['DOCUMENT_ROOT'].'/e-commerce/partials/__header.php'); ?>

<?php $products = viewProducts(); ?>

<ul>
    <?php foreach($products as $product) { ?>
        <li><a href="product_details.php?id=<?= $product['id']; ?>"><?= $product['product_name']; ?></a></li>
    <?php } ?>
</ul>



<?php include($_SERVER['DOCUMENT_ROOT'].'/e-commerce/partials/__footer.php'); ?>