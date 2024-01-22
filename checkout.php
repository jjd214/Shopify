<?php
// include($_SERVER['DOCUMENT_ROOT'].'/e-commerce/php/init.php');

// // print_r($_POST);

// if(isset($_POST['delete_item'])) {
//     deleteItems($_POST['item_id']);
// } else {

//     $deduct = new Add_cart();
//     $sales = new Sales(new View());
    
//     $total = count($_POST['stock_id']);
    
//     for ($i = 0; $i < $total; $i++) {
//         $deduct->deductQtyItem($_POST['qty'][$i], $_POST['stock_id'][$i]);
//         $sales->insertSales(
//             $_POST['stock_id'][$i],
//             $_POST['qty'][$i],
//             $_POST['price'][$i],
//             $_POST['product_id'],
//             $_POST['customer_name']
//         );
//         // Delete each item from the cart
//         $deduct->deleteItem($_POST['stock_id'][$i]);
//     }
//     header("Location: place_order.php");
//     // header("Location: ".$_SERVER['HTTP_REFERER']);
// }


include($_SERVER['DOCUMENT_ROOT'].'/e-commerce/php/init.php');

// Start the session
session_start();

// print_r($_POST);

if(isset($_POST['delete_item'])) {
    deleteItems($_POST['item_id']);
} else {
    $deduct = new Add_cart();
    $sales = new Sales(new View());

    $total = count($_POST['stock_id']);

    // Create arrays to store values
    $stock_ids = [];
    $qtys = [];
    $prices = [];

    for ($i = 0; $i < $total; $i++) {
        // $deduct->deductQtyItem($_POST['qty'][$i], $_POST['stock_id'][$i]);
        // $sales->insertSales(
        //     $_POST['stock_id'][$i],
        //     $_POST['qty'][$i],
        //     $_POST['price'][$i],
        //     $_POST['product_id'],
        //     $_POST['customer_name']
        // );

        // Store values in arrays
        $stock_ids[] = $_POST['stock_id'][$i];
        $qtys[] = $_POST['qty'][$i];
        $prices[] = $_POST['price'][$i];

        // Delete each item from the cart
        // $deduct->deleteItem($_POST['stock_id'][$i]);
    }

    // Store arrays in session variables
    $_SESSION['stock_ids'] = $stock_ids;
    $_SESSION['qtys'] = $qtys;
    $_SESSION['prices'] = $prices;
    $_SESSION['product_id'] = $_POST['product_id'];
    $_SESSION['customer_name'] = $_POST['customer_name'];
    $_SESSION['customer_id'] = $_POST['user_id'];
    // $_SESSION['cart_id'] = $_POST['cart_id'];

    // Redirect to place_order.php
    header("Location: place_order.php");
    // header("Location: ".$_SERVER['HTTP_REFERER']);
}
?>
