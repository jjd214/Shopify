<?php

// sign up, sign in 
function signup() {
    $signup = new Signup();
    $signup->signup();
}

function signin() {
    $signup = new Signin();
    $signup->signin();
}

function forgotPassword() {
    $forgotPassword = new Forgot_password();

    if (isset($_POST['submit'])) {
        $email = $_POST['email'];

        $forgotPassword->validateEmail($email);
    }
}

function resetPassword() {

    if (!isset($_GET['token'])) {

        header("Location: signin.php");
        exit(); 
        
    } else {

        $resetPassword = new Forgot_password();
        $resetPassword->resetPassword();

    }
}

function verifyOTP() {

    $verifyOTP = new Signup();

    if(isset($_POST['submit'])) {

        $otp = $_POST['otp'];

        $verifyOTP->verifyOTP($otp);
    }
}

function resendOTP() {

    $resendOTP = new Signup();
    $resendOTP->resendOTP();
}

function access() {
    $signin = new Signin();
    $access = $signin->get_session();

    if ($access['access'] == 'admin') {
        header("Location: /e-commerce/views/admin/index.php");
    } else if ($access['access'] == 'user') {
        header("Location: /e-commerce/views/index.php");
    } else {
        header("Location: /e-commerce/views/signin.php");
    }
}

function userDetails() {
    $signin = new Signin();
    $access = $signin->get_session();

    return $access;
}

function signout() {
    $logout = new Signin();
    $logout->signout();
}


// Add New Product

function addNewProduct() {
    $Add_new_product = new Add_new_product();
    $Add_new_product->addNewProduct();
}

function viewProducts() {
    $viewProducts = new View();
    return $viewProducts->viewProducts();
}

function productDetails() {
    $id = $_GET['id'];

    $productDetails = new View();

    return [
        'productDetails' => $productDetails->getSingleProductDetails($id),
        'totalQuantity' => $productDetails->getTotalQuantity($id)
    ];
}

function addStock() {
    $addStock = new Add_new_stock();
    $addStock->addStock($_POST);
}

function viewAllStocks() {

    $id = $_GET['id'];

    $allStocks = new View();
    $stocks = $allStocks->viewAllStocks($id);

    return $stocks;
}

function viewItemDetails() {

    $id = $_GET['id'];

    $item = new View();
    $details = $item->getItemDetails($id);

    return $details;
}

function addToCart() {
    $cart = new Add_cart();
    $cart->addToCart();
}

function viewCartItems($customer_id) {
    $cart = new View();
    $items = $cart->viewCartItems($customer_id);

    return $items;
}

function deleteItems() {
    $delete = new Add_cart();
    $delete->deleteCartItem();
}

function viewStockItems($item_id) {
    $stock = new View();
    $total = $stock->viewStockItems($item_id);

    return $total;
}

function viewSellerProduct($name) {
    $seller = new View();
    $product = $seller->viewSellerProducts($name);

    return $product;
}

?>