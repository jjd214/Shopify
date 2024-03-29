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

function deleteItems($item_id) {
    $delete = new Add_cart();
    $delete->deleteCartItem($item_id);
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

function customerSettings() {
    $settings = new Account_settings();
    $settings->customerSettings();
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

function viewCheckOutItems($item_id) {
    $view = new View();
    $items = $view->viewCheckOutItems($item_id);

    return $items;
}

function viewRandomStores() {
    $view = new View();
    $stores = $view->viewRandomStores();

    return $stores;
}

function viewTotalOrders($sellerName){
    $view = new View();
    $total = $view->viewTotalOrders($sellerName);

    return $total;
}

function viewTotalItem($sellerName){
    $view = new View();
    $total = $view->viewTotalItem($sellerName);

    return $total;
}

function setBillingAddress() {
    $address = new Account_settings();
    $address->setBillingAddress();
}

function viewBillingAddress($user_id) {
    $view = new View();
    $details = $view->viewBillingAddress($user_id);

    return $details;
}

function checkUserIDExist($user_id) {
    $validate = new View();
    $validate->checkUserIDExist($user_id);
}

function getRandomItems(){
    $view = new View();
    $items = $view->getRandomItems();

    return $items;
}

function viewSellerAccounts() {
    $view = new View();
    $accounts = $view->viewSellerAccounts();

    return $accounts;
}

function viewCustomerAccounts() {
    $view = new View();
    $accounts = $view->viewCustomerAccounts();

    return $accounts;
}

function viewOnSaleProducts() {
    $view = new View();
    $products = $view->viewOnSaleProducts();

    return $products;
}

function viewSellerDetails($seller_id) {
    $view = new View();
    $details = $view->viewSellerDetails($seller_id);

    return $details;
}

function sellerChangePassword() {
    $update = new Account_settings();
    $update->sellerChangePassword();
}

function viewOrders($seller_id) {
    $view = new View();
    $orders = $view->viewOrders($seller_id);

    return $orders;
}

function shipOrder() {
    $view = new View();
    $view->shipOrder();
}

function viewSellerOrder($cart_id) {
    $view = new View();
    $orders = $view->viewSellerOrder($cart_id);

    return $orders;
}

function viewShippingAddress($customer_id) {
    $view = new View();
    $address = $view->viewShippingAddress($customer_id);

    return $address;
}

function viewOrderHistory($seller_id) {
    $view = new View();
    $history = $view->viewOrderHistory($seller_id);

    return $history;
}

function deleteStockItem() {
    $delete = new Add_new_stock();
    $delete->delete_stock();
}

function banSellerAccount() {
    $banned = new Ban_accounts();
    $banned->ban_seller_accounts();
}

function deleteSellerAccount() {
    $delete = new Ban_accounts();
    $delete->delete_seller_account();
}

function viewCustomerDetails($customer_id) {
    $view = new View();
    $customer = $view->viewCustomerDetails($customer_id);

    return $customer;
}

function banCustomerAccount() {
    $banned = new Ban_accounts();
    $banned->ban_customer_accounts();
}

function viewStoresDetails() {
    $view = new View();
    $stores = $view->viewStores();

    return $stores;
}

function createNewAdmin() {
    $admin = new Admin();
    $admin->create_new_admin();
}

function searchStore() {
    $view = new View();
    $store = $view->searchStores();

    return $store;
}

function searchItem() {
    $view = new View();
    $item = $view->searchItem();

    return $item;
}

function bestSellers($seller) {
    $view = new View();
    $best = $view->viewBestSellerDetails($seller);

    return $best;
}

function viewPriceInCart($customer_id) {
    $view = new View();
    $price = $view->viewPriceInCart($customer_id);

    return $price;
}

function onlinePaymentSettings() {
    $settings = new Account_settings();
    $settings->onlinePaymentSettings();
}

function viewOnlinePaymentDetails($seller_id) {
    $view = new View();
    $details = $view->viewOnlinePaymentDetails($seller_id);

    return $details;
}
?>