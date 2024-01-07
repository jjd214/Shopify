<?php include($_SERVER['DOCUMENT_ROOT'].'/e-commerce/php/init.php'); ?>
<?php include($_SERVER['DOCUMENT_ROOT'].'/e-commerce/partials/__header.php'); ?>

<style>
    tr.disabled-row {
    opacity: 0.5;
    pointer-events: none; 
}

</style>
<?php $customerID = userDetails(); ?>
<?php $carts = viewCartItems($customerID['id']); ?>
<?php deleteItems(); ?>

<div class="container mt-5">
    <h2>Your Cart</h2>

    <?php if ($carts !== null && !empty($carts)): ?>
        <form action="checkout.php" method="post">
            <table class="table table-bordered" id="cartTable">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Item Name</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Price</th>
                        <th scope="col">Total</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($carts as $index => $cartItem): ?>
                        <?php $itemQty = viewStockItems($cartItem['item_id']); ?>
                        <tr>
                            <th scope="row"><?= $index + 1 ?></th>
                            <td><?= $cartItem['item_name'] ?></td>
                            <td>
                                <input type="number" name="qty[<?= $index ?>]" min="1" max="<?= $itemQty ?>" value="<?= $cartItem['qty'] ?>" class="qty-input">
                                <input type="hidden" name="cart_id[<?= $index ?>]" value="<?= $cartItem['id'] ?>">
                                <input type="hidden" name="stock_id[<?= $index ?>]" value="<?= $cartItem['item_id'] ?>">
                                <input type="hidden" name="price[<?= $index ?>]" value="<?= $cartItem['price'] ?>">
                                <input type="hidden" name="item_id[<?= $index ?>]" value="<?= $cartItem['item_id'] ?>">
                            </td>
                            <td>₱ <?= $cartItem['price'] ?></td>
                            <td class="total">₱ <?= $cartItem['qty'] * $cartItem['price'] ?></td>
                            <td>
                                <form action="" method="post">
                                    <input type="hidden" name="stock_id[<?= $index ?>]" value="<?= $cartItem['item_id'] ?>">
                                    <button type="submit" name="delete_item" class="delete-button" value="<?= $cartItem['item_id'] ?>">
                                        <i class="fas fa-trash-alt"></i> Delete
                                    </button>
                                </form>     
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <input type="hidden" name="product_id" value="<?= $cartItem['product_id'] ?>">
            <input type="hidden" name="customer_name" value="<?= $customerID['fullname'] ?>">
            <button type="submit" name="checkout" class="checkout-button">
                Checkout All Items
            </button>
        </form>
    <?php else: ?>
        <p>Your cart is empty.</p>
    <?php endif; ?>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const qtyInputs = document.querySelectorAll('.qty-input');

        qtyInputs.forEach(function (qtyInput) {
            qtyInput.addEventListener('input', function () {
                updateTotal(qtyInput);
            });
        });

        function updateTotal(qtyInput) {
            const row = qtyInput.closest('tr');
            const price = parseFloat(row.querySelector('td:nth-child(4)').innerText.replace('₱', '').trim());
            const qty = parseInt(qtyInput.value);
            const totalCell = row.querySelector('.total');
            const total = price * qty;
            totalCell.innerText = '₱ ' + total.toFixed(2);

            if (qty === 0) {
                row.classList.add('disabled-row');
            } else {
                row.classList.remove('disabled-row');
            }
        }
    });
</script>



<?php include($_SERVER['DOCUMENT_ROOT'].'/e-commerce/partials/__footer.php'); ?>
