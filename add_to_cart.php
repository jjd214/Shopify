<?php 
session_start();

if (isset($_SESSION['store_id'])) {
    echo '<script>alert("set")</script>';
} else {
    echo '<script>alert("not set")</script>';
}

?>

<?php include($_SERVER['DOCUMENT_ROOT'].'/e-commerce/php/init.php'); ?>

<?php
$access = userDetails();

if (!$access) {
    header("Location: signin.php");
    exit(); 
}

$user = $access;
?>

<?php $itemDetails = viewItemDetails(); ?>
<?php $seller = viewSellerName($_SESSION['store_id']); 

$customer_id = $user['id'];
$item_id = $_GET['id'];
$product_id = $itemDetails['product_id'];
$item_name = $itemDetails['vendor_name'];
// $qty = $itemDetails['qty'];
$price = $itemDetails['price'];

addToCart($customer_id,$item_id,$product_id,$item_name,$price);

header("Location: ".$_SERVER['HTTP_REFERER']);
?>