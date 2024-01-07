
<?php include($_SERVER['DOCUMENT_ROOT'].'/e-commerce/php/init.php'); ?>
<?php include($_SERVER['DOCUMENT_ROOT'].'/e-commerce/partials/__header.php'); ?>
<style>
    body {

    }
    .disabledbtn {
        pointer-events: none;
        opacity: 0.4;
    }
</style>

<?php $product = productDetails(); ?>
<?php $stocks = viewAllStocks(); ?>
<?php $customerName = userDetails(); ?>


<h1><?= $product['productDetails']['product_name']; ?></h1>
<h3><?= $product['productDetails']['product_type']; ?></h3>
<h3><?= $product['productDetails']['min_stock']; ?></h3>

<br>
<h3>Total : <?= $product['totalQuantity']['total']; ?></h3>
<a href="product_list.php">Product</a>
<hr>
<h2>Available Product Items</h2>
<!-- <form action="" method="post" id="addToCartForm"> -->
<?php $defaultImage = 'default.png'; ?>

<?php foreach ($stocks as $stock) { ?>
    <a href="/e-commerce/views/items_details.php?id=<?= $stock['id'] ?>">
        <img src="/e-commerce/uploads/<?= isset($stock['product_image']) ? $stock['product_image'] : $defaultImage ?>" alt="Product Image" height="150px" width="180">
    </a>
    <label><?= $stock['vendor_name']; ?></label>
<?php } ?>





<hr>

<h2>Cart</h2>

<form action="checkout.php" method="post" id="check_out_form">
    <input type="hidden" name="customer_name" value="<?= $customerName['fullname']; ?>">
    <input type="hidden" name="product_id" value="<?= $product['productDetails']['id']; ?>">
    <input type="submit" name="submit" value="checkout">
</form>

<script>
    const add_cart = document.querySelectorAll('.add_cart');
    const form_cart = document.querySelector('#check_out_form');
    

    if (add_cart) {
        add_cart.forEach(element => {
            element.addEventListener('click', () => {
                let added_item = element.parentNode.cloneNode(true);
                element.parentNode.classList.add('disabledbtn');
                form_cart.prepend(added_item);
                added_item.children[5].removeAttribute('disabled');
                activeRemove();
            });
        });
    }
    
    function activeRemove() {
        const remove_cart = document.querySelectorAll('.remove_cart');
        if (remove_cart) {
            remove_cart.forEach(element => {
                element.addEventListener('click',  () => {
                    let id = element.getAttribute('id');
                    document.querySelector('#parent_' + id).classList.remove('disabledbtn');
                    element.parentNode.remove();
                });
            });
        }
    }
</script>


<?php include($_SERVER['DOCUMENT_ROOT'].'/e-commerce/partials/__footer.php'); ?>

