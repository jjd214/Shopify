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

    public function getTotalSales() {
        $connection = $this->openConnection();
        $stmt = $connection->prepare("SELECT `added_by` FROM `productItems_tbl` INNER JOIN `sales_tbl` ON productItems_tbl.added_by");
    }
    
}

?>