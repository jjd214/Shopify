<?php include($_SERVER['DOCUMENT_ROOT'].'/e-commerce/php/init.php'); ?>

<?php 

// $total = count($_POST['stock_id']);

// for($i = 0; $i < $total; $i++) {
//     echo $_POST['stock_id'][$i] . " " . $_POST['qty'][$i] . " " . $_POST['price'][$i] . "<br>";
// }

$sales = new Sales(new View());

$total = count($_POST['stock_id']);

for($i = 0; $i < $total; $i++) {
    // stock id
    // echo $_POST['stock_id'][$i] . " " . $_POST['qty'][$i] . " " . $_POST['price'][$i] . '<br>';
    $sales->insertSales($_POST['stock_id'][$i], $_POST['qty'][$i], $_POST['price'][$i], $_POST['product_id'], $_POST['customer_name']);

}

header("Location: ".$_SERVER['HTTP_REFERER']);

?>