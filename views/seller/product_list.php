<?php include($_SERVER['DOCUMENT_ROOT'].'/e-commerce/php/init.php'); ?>

<?php include($_SERVER['DOCUMENT_ROOT'].'/e-commerce/partials/__header.php'); ?>

<?php $sellerDetails = userDetails(); ?>
<?php $products = viewSellerProduct($sellerDetails['fullname']); ?>

<ul>
    <?php if ($products): ?>
        <?php foreach($products as $product): ?>
            <li><a href="product_details.php?id=<?= $product['id']; ?>"><?= $product['product_name']; ?> | <?= $product['min_stock']; ?></a></li>
        <?php endforeach; ?>
    <?php else: ?>
        <li>No products.</li>
    <?php endif; ?>
</ul>

<?php include($_SERVER['DOCUMENT_ROOT'].'/e-commerce/partials/__footer.php'); ?>
