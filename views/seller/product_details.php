<?php include($_SERVER['DOCUMENT_ROOT'].'/e-commerce/php/init.php'); ?>

<?php include($_SERVER['DOCUMENT_ROOT'].'/e-commerce/partials/__header.php'); ?>


<style>
    body {
        font-family: Arial, Helvetica, sans-serif;
    }
    #checkoutbtn {
        margin-top: 1rem;
    }
    .disabledbtn {
        pointer-events: none;
        opacity: 0.4;
    }
</style>

<?php $product = productDetails(); ?>
<?php $stocks = viewAllStocks(); ?>
<?php $customerName = userDetails(); ?>
<?php $inventoryArr = array(); ?>

<h1><?= $product['productDetails']['product_name']; ?></h1>
<h3>Category : <?= $product['productDetails']['product_type']; ?></h3>
<h3>Minimum stock : <?= $product['productDetails']['min_stock']; ?></h3>

<br>

<hr>
<h2>Available Product Items</h2>

<table>
    <thead>
        <tr>
            <th>Item name</th>
            <th>Base Stock Qty</th>
            <th>SRP</th>
            <th>Sales Qty</th>
            <th>Total Sales</th>
            <th>Qty Remaining</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($stocks as $stock) { ?>
        <?php $sum = $stock['qty'] - $stock['sale_qty']; ?>
        <?php $inventoryArr[] = $sum; ?>
            <tr class="<?= ($sum == 0) ? 'disabledbtn' : 'Available'; ?>">
                <td>
                    <div id="parent_<?= $stock['id']; ?>">
                    <label><?= $stock['vendor_name']; ?></label>
                    </div>
                </td>
                <td><?= $stock['qty']; ?></td>
                <td><?= sprintf('%01.2f', $stock['price']); ?></td>
                <td><?= $stock['sale_qty']; ?></td>
                <td><?= sprintf('%01.2f', $stock['TotalSales']); ?></td>
                <td><?= $stock['qty']; ?></td>
                <td><?= ($stock['qty'] == 0) ? 'Out of Stock' : 'Available'; ?></td>
            </tr>
        <?php } ?>
    </tbody>
</table>

<h5>Total : <?= $product['totalQuantity']['total']; ?></h5>
<h5>Actual Inventory : <?= array_sum($inventoryArr); ?></h5>
<h5>Status : 
    <?php

    if(array_sum($inventoryArr) <= $product['productDetails']['min_stock'] && array_sum($inventoryArr) != 0) {
        echo "Low Inventory";
    } else if (array_sum($inventoryArr) == 0) {
        echo "Out of stocks";
    } else {
        echo "On sale";
    }

?>
</h5>


<a href="product_list.php">Product</a>
<a href="add_new_stock.php?id=<?= $product['productDetails']['id']; ?>">Add new stocks</a>

<hr>

<script>
    const add_cart = document.querySelectorAll('.add_cart');
    const form_cart = document.querySelector('#check_out_form');
    

    if (add_cart) {
        add_cart.forEach(element => {
            element.addEventListener('click', () => {
                let added_item = element.parentNode.cloneNode(true);
                element.parentNode.classList.add('disabledbtn');
                form_cart.prepend(added_item);
                added_item.children[4].removeAttribute('disabled');
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
