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

    public function viewAllStocks($id) {

        $connection = $this->openConnection();
        $stmt = $connection->prepare("SELECT * FROM `productItems_tbl` WHERE `product_id` = ?");
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
    
}

?>