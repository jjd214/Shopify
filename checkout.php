<?php
include($_SERVER['DOCUMENT_ROOT'].'/e-commerce/php/init.php');

// print_r($_POST);

if(isset($_POST['delete_item'])) {
    deleteItems($_POST['item_id']);
} else {

    $deduct = new Add_cart();
    $sales = new Sales(new View());
    
    $total = count($_POST['stock_id']);
    
    for ($i = 0; $i < $total; $i++) {
        $deduct->deductQtyItem($_POST['qty'][$i], $_POST['stock_id'][$i]);
        $sales->insertSales(
            $_POST['stock_id'][$i],
            $_POST['qty'][$i],
            $_POST['price'][$i],
            $_POST['product_id'],
            $_POST['customer_name']
        );
        // Delete each item from the cart
        $deduct->deleteItem($_POST['stock_id'][$i]);
    }
    
    header("Location: ".$_SERVER['HTTP_REFERER']);
}

?>
