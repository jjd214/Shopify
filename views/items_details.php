<?php include($_SERVER['DOCUMENT_ROOT'].'/e-commerce/php/init.php'); ?>
<?php include($_SERVER['DOCUMENT_ROOT'].'/e-commerce/partials/__header.php'); ?>

<?php $itemDetails = viewItemDetails(); ?>
<?php $customerID = userDetails(); ?>

<?php addToCart(); ?>

<img src="/e-commerce/uploads/<?= isset($itemDetails['product_image']) ? $itemDetails['product_image'] : 'default.png' ?>" alt="Product Image" height="150px" width="180">
<p><?= $itemDetails['vendor_name'] ?></p>
<p>Description: Lorem ipsum</p>
<p>Price : <?= $itemDetails['price'] ?></p>
<p>Available stock : <?= $itemDetails['qty'] ?></p>

<form action="" method="post">
    <input type="hidden" name="customer_id" value="<?= $customerID['id'] ?>">
    <input type="hidden" name="item_id" value="<?= $itemDetails['id'] ?>">
    <input type="hidden" name="product_id" value="<?= $itemDetails['product_id'] ?>">
    <input type="hidden" name="item_name" value="<?= $itemDetails['vendor_name'] ?>">
    <input type="number" name="qty" min="1" max="<?= $itemDetails['qty'] ?>" value="1">
    <input type="hidden" name="price" value="<?= $itemDetails['price'] ?>">
    <input type="submit" name="add_cart" value="Add to Cart" <?= ($itemDetails['qty'] == 0) ? 'disabled' : '' ?>>
</form>

<a href="product_details.php?id=<?= $id ?>">Go Back</a>

<?php include($_SERVER['DOCUMENT_ROOT'].'/e-commerce/partials/__footer.php'); ?>

