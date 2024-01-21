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
        $stmt = $connection->prepare("SELECT * FROM `user_tbl`");
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
        $stmt = $connection->prepare("SELECT SUM(sales_tbl.price) AS total_sales
                                      FROM products_tbl
                                      INNER JOIN sales_tbl ON products_tbl.id = sales_tbl.product_id
                                      WHERE products_tbl.added_by = :sellerName");
        $stmt->bindParam(':sellerName', $sellerName, PDO::PARAM_STR);
        $stmt->execute();
    
        // Fetch the total sales
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
    
}

?>