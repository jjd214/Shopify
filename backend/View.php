<?php
class View extends Config {

    public function viewProducts() {

        $connection = $this->openConnection();
        $stmt = $connection->prepare("SELECT * FROM `products_tbl`");
        $stmt->execute();
        $data = $stmt->fetchAll();
        $result = $stmt->rowCount();

        return $data;
    }

    public function getSingleProductDetails($id) {

        $connection = $this->openConnection();
        $stmt = $connection->prepare("SELECT * FROM `products_tbl` WHERE `id` = ?");
        $stmt->execute([$id]);
        $data = $stmt->fetch();
        $result = $stmt->rowCount();

        if($result > 0) {
            return $data;
        } else {
            // header("Location: /e-commerce/error/page404.php");
            null;
        }
    }

    public function getTotalQuantity($id) {
        $connection = $this->openConnection();
        $stmt = $connection->prepare("SELECT *, SUM(qty) AS total FROM productItems_tbl WHERE product_id = ?");
        $stmt->execute([$id]);
        $data = $stmt->fetch();
    
        return $data; 
    }

    // public function viewAllStocks($id) {
    //     $connection = $this->openConnection();
    //     $stmt = $connection->prepare("SELECT t1.id, t1.vendor_name, t1.price, t1.qty, SUM(t2.qty) as sale_qty, SUM(t2.qty * t2.price) as TotalSales FROM productItems_tbl t1 LEFT JOIN sales_tbl t2 ON t1.id = t2.stocks_id WHERE t1.product_id = ? GROUP BY t1.id");
    //     $stmt->execute([$id]);
    //     $data = $stmt->fetchAll();
    
    //     return $data;
    // }

    public function viewAllStocks($id) {
        $connection = $this->openConnection();
        $stmt = $connection->prepare("SELECT t1.id, t1.vendor_name, t1.price, t1.qty, t1.product_image, SUM(t2.qty) as sale_qty, SUM(t2.qty * t2.price) as TotalSales FROM productItems_tbl t1 LEFT JOIN sales_tbl t2 ON t1.id = t2.stocks_id WHERE t1.product_id = ? GROUP BY t1.id");
        $stmt->execute([$id]);
        $data = $stmt->fetchAll();
    
        return $data;
    }
    
    public function getStockDetails($id) {

        $connection = $this->openConnection();
        $stmt = $connection->prepare("SELECT * FROM `productItems_tbl` WHERE `id` = ?");
        $stmt->execute([$id]);
        $data = $stmt->fetch();
        
        return $data;
    }

    public function getItemDetails($id) {
        $connection = $this->openConnection();
        $stmt = $connection->prepare("SELECT * FROM `productItems_tbl` WHERE `id` = ?");
        $stmt->execute([$id]);
        $data = $stmt->fetch();
        
        return $data;
    }

    public function viewCartItems($id) {
        $connection = $this->openConnection();
        $stmt = $connection->prepare("SELECT * FROM `cart_tbl` WHERE user_id = ?");
        $stmt->execute([$id]);
        $data = $stmt->fetchAll();

        return $data;
    }

    public function viewStockItems($id) {
        $connection = $this->openConnection();
        $stmt = $connection->prepare("SELECT (`qty`) FROM `productItems_tbl` WHERE `id` = ?");
        $stmt->execute([$id]);
        $data = $stmt->fetchColumn();

        return $data;
    }

    public function viewSellerProducts($name) {
        $connection = $this->openConnection();
        $stmt = $connection->prepare("SELECT * FROM `products_tbl` WHERE `added_by` = ?");
        $stmt->execute([$name]);
        $data = $stmt->fetchAll();
        
        return $data;
    }

    public function viewAllBusinessAccount() {
        $connection = $this->openConnection();
        $stmt = $connection->prepare("SELECT * FROM `user_tbl`  WHERE `access` = 'seller'");
        $stmt->execute();
        $data = $stmt->fetchAll();

        return $data;
    }

    public function viewSingleStoreDetails($id) {

        $connection = $this->openConnection();
        $stmt = $connection->prepare("SELECT * FROM `user_tbl` WHERE `id` = ?");
        $stmt->execute([$id]);
        $data = $stmt->fetch();

        return $data;
    }

    public function viewLatestProducts($name) {
        $connection = $this->openConnection();
        $stmt = $connection->prepare("SELECT * FROM `productItems_tbl` WHERE `added_by` = ? ORDER BY added_at DESC LIMIT 9");
        $stmt->execute([$name]);
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        return $results;
    }

    public function viewSellerName($id) {
        $connection = $this->openConnection();
        $stmt = $connection->prepare("SELECT `firstname`, `lastname` FROM `user_tbl` WHERE `id` = ?");
        $stmt->execute([$id]);
        $data = $stmt->fetch();
    
        $name = $data['firstname']." ".$data['lastname'];
    
        return $name;
    }

    public function getProductId($id) {
        $connection = $this->openConnection();
        $stmt = $connection->prepare("SELECT `product_id` FROM `productItems_tbl` WHERE `id` = ?");
        $stmt->execute([$id]);
        $data = $stmt->fetch();

        return $data;
    }

    public function viewRelatedProducts($id) {
        $connection = $this->openConnection();
        $stmt = $connection->prepare("SELECT * FROM `productItems_tbl` WHERE `product_id` = ? ORDER BY RAND() LIMIT 12");
        $stmt->execute([$id['product_id']]); 
        $data = $stmt->fetchAll();
    
        return $data;
    }   

    public function getRandomProducts($name) {
        $connection = $this->openConnection();
        $stmt = $connection->prepare("SELECT * FROM `productItems_tbl` WHERE `added_by` = ? ORDER BY RAND()");
        $stmt->execute([$name]);
        $data = $stmt->fetchAll();

        return $data;
    }

    public function viewCheckOutItems($item_ids) {
        $placeholders = str_repeat('?,', count($item_ids) - 1) . '?';
        $sql = "SELECT * FROM `cart_tbl` WHERE `item_id` IN ($placeholders)";
        
        $connection = $this->openConnection();
        $stmt = $connection->prepare($sql);
        $stmt->execute($item_ids);
        $data = $stmt->fetchAll();
    
        return $data;
    }

    public function getTotalSales($sellerName) {
        $connection = $this->openConnection();
        $stmt = $connection->prepare("SELECT SUM(sales_tbl.price * sales_tbl.qty) AS total_sales
                                      FROM products_tbl
                                      INNER JOIN sales_tbl ON products_tbl.id = sales_tbl.product_id
                                      WHERE products_tbl.added_by = :sellerName");
        $stmt->bindParam(':sellerName', $sellerName, PDO::PARAM_STR);
        $stmt->execute();
    
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
        return $result['total_sales'];
    }
    

    public function getTotalSalesForDate($sellerName, $date) {
        $connection = $this->openConnection();
        $stmt = $connection->prepare("SELECT SUM(sales_tbl.price) AS total_sales
                                      FROM products_tbl
                                      INNER JOIN sales_tbl ON products_tbl.id = sales_tbl.product_id
                                      WHERE products_tbl.added_by = :sellerName
                                      AND DATE(sales_tbl.date_purchased) = DATE(:date)");
        $stmt->bindParam(':sellerName', $sellerName, PDO::PARAM_STR);
        $stmt->bindParam(':date', $date, PDO::PARAM_STR);
        $stmt->execute();
    
        // Fetch the total sales for the specified date
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
        return $result['total_sales'];
    }
    

    public function getTotalRevenueSinceYesterday($sellerName) {
        $today = date('Y-m-d');
        $yesterday = date('Y-m-d', strtotime('-1 day'));

        // Get total sales for today and yesterday
        $totalSalesToday = $this->getTotalSalesForDate($sellerName, $today);
        $totalSalesYesterday = $this->getTotalSalesForDate($sellerName, $yesterday);

        // Calculate the percentage increase
        if ($totalSalesYesterday > 0) {
            $increasePercentage = (($totalSalesToday - $totalSalesYesterday) / $totalSalesYesterday) * 100;
        } else {
            // Handle the case where yesterday's sales are 0 to avoid division by zero
            $increasePercentage = 100; // Assuming a 100% increase when yesterday's sales are 0
        }

        return round($increasePercentage, 2);
    }

    public function viewExpectedRevenue($sellerName) {
        $connection = $this->openConnection();
        
        $stmt = $connection->prepare("SELECT SUM(qty * price) AS expected_revenue
                                      FROM productItems_tbl
                                      WHERE added_by = :sellerName");
        
        $stmt->bindParam(':sellerName', $sellerName, PDO::PARAM_STR);
        $stmt->execute();
    
        // Fetch the total expected revenue
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result['expected_revenue'];
    }
    
    public function viewRandomStores() {
        $connection = $this->openConnection();
        $stmt = $connection->prepare("SELECT * FROM user_tbl ORDER BY RAND()");
        $stmt->execute();
        $data = $stmt->fetchAll();

        return $data;
    }

    public function viewTotalOrders($sellerName) {
        $connection = $this->openConnection();
    
        // Count the total orders for the seller
        $stmtCount = $connection->prepare("SELECT COUNT(*) as totalOrders
            FROM sales_tbl
            JOIN products_tbl ON sales_tbl.product_id = products_tbl.id
            WHERE products_tbl.added_by = ?
        ");
        $stmtCount->execute([$sellerName]);
        $resultCount = $stmtCount->fetch(PDO::FETCH_ASSOC);
        $totalOrders = $resultCount['totalOrders'];
    
        // Fetch the detailed order data
        $stmtOrders = $connection->prepare("SELECT sales_tbl.*, products_tbl.added_by
            FROM sales_tbl
            JOIN products_tbl ON sales_tbl.product_id = products_tbl.id
            WHERE products_tbl.added_by = ?
        ");
        $stmtOrders->execute([$sellerName]);
        $data = $stmtOrders->fetchAll(PDO::FETCH_ASSOC);
    
        // Include the total orders count in the result
        $result = [
            'totalOrders' => $totalOrders,
            'orders' => $data,
        ];
    
        return $result;
    }
    
    public function viewTotalItem($sellerName) {
        $connection = $this->openConnection();
        $stmt = $connection->prepare("SELECT COUNT(*) as TotalItem FROM `productItems_tbl` WHERE `added_by` = ?");
        $stmt->execute([$sellerName]);
        $data = $stmt->fetch();

        return $data;
    }

    public function viewBillingAddress($user_id) {
        $connection = $this->openConnection();
        $stmt = $connection->prepare("SELECT * FROM `billing_tbl` WHERE `user_id` = ?");
        $stmt->execute([$user_id]);
        $data = $stmt->fetch();

        return $data;
    }
    
    public function checkUserIDExist($user_id) {
        $connection = $this->openConnection();
        $stmt = $connection->prepare("SELECT * FROM `billing_tbl` WHERE `user_id` = ?");
        $stmt->execute([$user_id]);
        $result = $stmt->rowCount();

        

        if($result == 0) {
            header("Location: my_address.php");
            exit();
        }
    }

    public function getRandomItems() {
        $connection = $this->openConnection();
        $stmt = $connection->prepare("SELECT * FROM `productItems_tbl` ORDER BY RAND() LIMIT 8");
        $stmt->execute();
        $data = $stmt->fetchAll();

        return $data;
    }

    public function viewSellerAccounts() {
        $connection = $this->openConnection();
        $stmt = $connection->prepare("SELECT * FROM `user_tbl` WHERE `access` = 'seller'");
        $stmt->execute();
        $data = $stmt->fetchAll();

        return $data;
    }

    public function viewCustomerAccounts() {
        $connection = $this->openConnection();
        $stmt = $connection->prepare("SELECT * FROM `user_tbl` WHERE `access` = 'customer'");
        $stmt->execute();
        $data = $stmt->fetchAll();

        return $data;
    }

    public function viewOnSaleProducts() {
        $connection = $this->openConnection();
        $stmt = $connection->prepare("SELECT * FROM `products_tbl`");
        $stmt->execute();
        $data = $stmt->fetchAll();
        
        return $data;
    }

    public function viewSellerDetails($seller_id) {
        $connection = $this->openConnection();
        $stmt = $connection->prepare("SELECT * FROM `user_tbl` WHERE `access` = 'seller' AND `id` = ?");
        $stmt->execute([$seller_id]);
        $data = $stmt->fetch();

        return $data;
    }

    // public function viewOrders($seller_id) {
    //     $connection = $this->openConnection();
    //     $stmt = $connection->prepare("SELECT
    //                                     sales_tbl.id AS sale_id,
    //                                     sales_tbl.cart_id AS sale_cart_id,
    //                                     sales_tbl.product_id AS sale_product_id,
    //                                     sales_tbl.brand_name AS sale_brand_name,
    //                                     sales_tbl.qty AS sale_qty,
    //                                     sales_tbl.price AS sale_price,
    //                                     sales_tbl.qty * sales_tbl.price AS total_price,
    //                                     sales_tbl.date_purchased AS sale_order_date, 
    //                                     sales_tbl.status AS sale_status,
    //                                     sales_tbl.customer_name AS sale_customer_name,
    //                                     products_tbl.id AS product_id,
    //                                     products_tbl.seller_id AS product_seller_id
    //                                 FROM
    //                                     sales_tbl
    //                                 JOIN
    //                                     products_tbl ON sales_tbl.product_id = products_tbl.id
    //                                 WHERE
    //                                     products_tbl.seller_id = ?
    //                                 ");
    //     $stmt->execute([$seller_id]);
    //     $data = $stmt->fetchAll();

    //     return $data;
    // }
    public function viewOrders($seller_id) {
        $connection = $this->openConnection();
        $stmt = $connection->prepare("SELECT
                                        MIN(sales_tbl.id) AS sale_id,
                                        sales_tbl.cart_id AS sale_cart_id,
                                        sales_tbl.product_id AS sale_product_id,
                                        sales_tbl.brand_name AS sale_brand_name,
                                        sales_tbl.qty AS sale_qty,
                                        sales_tbl.price AS sale_price,
                                        sales_tbl.qty * sales_tbl.price AS total_price,
                                        sales_tbl.date_purchased AS sale_order_date, 
                                        sales_tbl.status AS sale_status,
                                        sales_tbl.customer_name AS sale_customer_name,
                                        products_tbl.id AS product_id,
                                        products_tbl.seller_id AS product_seller_id
                                    FROM
                                        sales_tbl
                                    JOIN
                                        products_tbl ON sales_tbl.product_id = products_tbl.id
                                    WHERE
                                        products_tbl.seller_id = ?
                                    GROUP BY
                                        sales_tbl.cart_id
                                    ");
        $stmt->execute([$seller_id]);
        $data = $stmt->fetchAll();
    
        return $data;
    }
    

    public function shipOrder() {

        if(isset($_POST['submit_status'])) {
            $customer_name = $_POST['customer_name'];
            $sales_id = $_POST['sales_id'];

            $connection = $this->openConnection();
            $stmt = $connection->prepare("UPDATE `sales_tbl` SET `status` = 'Shipped' WHERE `customer_name` = ? AND `id` = ?");
            $stmt->execute([$customer_name,$sales_id]);

            unset($_SESSION['sales_id']);
            header("Location: orders.php");
        }
    }

    public function viewSellerOrder($cart_id) {
        $connection = $this->openConnection();
        $stmt = $connection->prepare("SELECT * FROM `sales_tbl` WHERE `cart_id` = ?");
        $stmt->execute([$cart_id]);
        $data = $stmt->fetchAll();

        return $data;
    }
    
    public function viewShippingAddress($customer_id) {
        $connection = $this->openConnection();
        $stmt = $connection->prepare("SELECT * FROM `billing_tbl` WHERE `user_id` = ?");
        $stmt->execute([$customer_id]);
        $data = $stmt->fetch();

        return $data;
    }

    public function viewOrderHistory($seller_id) {
        $connection = $this->openConnection();
        $stmt = $connection->prepare("SELECT
                                        MIN(sales_tbl.id) AS sale_id,
                                        sales_tbl.cart_id AS sale_cart_id,
                                        sales_tbl.product_id AS sale_product_id,
                                        sales_tbl.brand_name AS sale_brand_name,
                                        sales_tbl.qty AS sale_qty,
                                        sales_tbl.price AS sale_price,
                                        sales_tbl.qty * sales_tbl.price AS total_price,
                                        sales_tbl.date_purchased AS sale_order_date, 
                                        sales_tbl.status AS sale_status,
                                        sales_tbl.customer_name AS sale_customer_name,
                                        products_tbl.id AS product_id,
                                        products_tbl.seller_id AS product_seller_id
                                    FROM
                                        sales_tbl
                                    JOIN
                                        products_tbl ON sales_tbl.product_id = products_tbl.id
                                    WHERE
                                        products_tbl.seller_id = ? AND sales_tbl.status = 'Shipped'
                                    GROUP BY
                                        sales_tbl.cart_id
                                    ORDER BY
                                    sales_tbl.date_purchased DESC
                                    ");
        $stmt->execute([$seller_id]);
        $data = $stmt->fetchAll();
    
        return $data;
    }

    public function viewCustomerDetails($customer_id) {
        $connection = $this->openConnection();
        $stmt = $connection->prepare("SELECT * FROM `user_tbl` WHERE `access` = 'customer' AND `id` = ?");
        $stmt->execute([$customer_id]);
        $data = $stmt->fetch();

        return $data;
    }

    public function viewStores() {
        $connection = $this->openConnection();
        $stmt = $connection->prepare("SELECT * FROM `user_tbl` WHERE `access` = 'seller'");
        $stmt->execute();
        $data = $stmt->fetchAll();

        return $data;
    }

    public function viewTotalCustomer() {
        $connection = $this->openConnection();
        $stmt = $connection->prepare("SELECT COUNT(*) AS totalCustomer FROM `user_tbl` WHERE `access` = 'customer'");
        $stmt->execute();
        $totalCustomer = $stmt->fetchColumn();
    
        return $totalCustomer;
    }

    public function viewTotalSellers() {
        $connection = $this->openConnection();
        $stmt = $connection->prepare("SELECT COUNT(*) AS totalSeller FROM `user_tbl` WHERE `access` = 'seller'");
        $stmt->execute();
        $totalSeller = $stmt->fetchColumn();
    
        return $totalSeller;
    }

    public function viewTotalGMV() {
        $connection = $this->openConnection();
        $stmt = $connection->prepare("SELECT SUM(qty * price) AS gmv FROM `sales_tbl`");
        $stmt->execute();
        $totalGMV = $stmt->fetchColumn();
    
        return $totalGMV;
    }
    
    public function getSalesWithAdminShare() {
        $connection = $this->openConnection();
        $stmt = $connection->prepare("SELECT *, (price * 0.1) AS admin_share FROM `sales_tbl`");
        $stmt->execute();
        $salesWithAdminShare = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        return $salesWithAdminShare;
    }
    
    public function searchStores() {
        if(isset($_POST['search_store'])) {
            $search = $_POST['store'];
    
            $connection = $this->openConnection();
            $stmt = $connection->prepare("SELECT * FROM `user_tbl` WHERE `storename` LIKE ?");
            $stmt->execute(["%$search%"]);
            $data = $stmt->fetchAll();
    
            return $data;
        }
    }

    public function searchItem() {
        if(isset($_POST['search_item'])) {

            $search = $_POST['item'];
            $seller_name = $_POST['seller_name'];
            $connection = $this->openConnection();
            $stmt = $connection->prepare("SELECT * FROM `productItems_tbl` WHERE `vendor_name` LIKE ? AND `added_by` = ?");
            $stmt->execute(["%$search%",$seller_name]);
            $data = $stmt->fetchAll();
    
            return $data;
        }
    }   
    
    public function viewBestSellerDetails($seller) {
        $connection = $this->openConnection();
        $stmt = $connection->prepare("SELECT * FROM `productItems_tbl` WHERE `added_by` = ? ORDER BY qty ASC LIMIT 6");
        $stmt->execute([$seller]);
        $data = $stmt->fetchAll();

        return $data;
    }
      
    public function viewOnlinePaymentDetails($seller_id) {
        $connection = $this->openConnection();
        $stmt = $connection->prepare("SELECT * FROM `online_payment_settings` WHERE `seller_id` = ?");
        $stmt->execute([$seller_id]);
        $data = $stmt->fetch();

        return $data;
    }


}

?>