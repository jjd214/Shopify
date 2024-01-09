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
    // Check if 'id' is set in $_GET
    $id = isset($_GET['id']) ? $_GET['id'] : null;

    // Only proceed if 'id' is set
    if ($id !== null) {
        $productDetails = new View();

        return [
            'productDetails' => $productDetails->getSingleProductDetails($id),
            'totalQuantity' => $productDetails->getTotalQuantity($id)
        ];
    }

    // Return an empty array or handle the case where 'id' is not set
    return [];
}

function addStock() {
    $addStock = new Add_new_stock();
    $addStock->addStock($_POST);
}

function viewAllStocks() {
    // Check if 'id' is set in $_GET
    $id = isset($_GET['id']) ? $_GET['id'] : $_SESSION['store_id'];

    // Only proceed if 'id' is set
    if ($id !== null) {
        $allStocks = new View();
        $stocks = $allStocks->viewAllStocks($id);

        return $stocks;
    }

    // Return an empty array or handle the case where 'id' is not set
    return [];
}

function getRandomProducts($name) {
    $view = new View();
    $products = $view->getRandomProducts($name);

    return $products;
}


function viewItemDetails() {

    $id = isset($_GET['id']) ? $_GET['id'] : $_SESSION['store_id'];

    $item = new View();
    $details = $item->getItemDetails($id);

    return $details;
}

function addToMyCart() {
    $cart = new Add_cart();
    $cart->addToMyCart();
}

function addToCart($customer_id,$item_id,$product_id,$item_name,$price) {
    $cart = new Add_cart();
    $cart->addToCart($customer_id,$item_id,$product_id,$item_name,$price);
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

function businessSettings() {
    $settings = new Account_settings();
    $settings->businessSettings();
}

function viewStores() {
    $stores = new View();
    $store = $stores->viewAllBusinessAccount();

    return $store;
}

function viewSingleStoreDetails($id) {

    $store = new View();
    $details = $store->viewSingleStoreDetails($id);

    return $details;
}

function viewLatestProducts($name) {
    $view = new View();
    $products = $view->viewLatestProducts($name);

    return $products;
}

function viewSellerName($id) {
    $view = new View();
    $name = $view->viewSellerName($id);

    return $name;
}

function getProductId($id) {
    $fetch = new View();
    $id = $fetch->getProductId($id);

    return $id;
}

function viewRelatedProducts($id) {
    $view = new View();
    $products = $view->viewRelatedProducts($id);

    return $products;
}

?>