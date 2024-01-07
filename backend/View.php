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
            header("Location: /e-commerce/error/page404.php");
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
    
}

?>