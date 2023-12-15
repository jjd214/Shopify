<?php
class Add_new_product extends Config {


    public function addNewProduct() {

        if(isset($_POST['submit'])) {

            $product_name = $_POST['product_name'];
            $product_type = $_POST['product_type'];
            $description = $_POST['description'];
            $min_stock = $_POST['min_stock'];

            if($this->checkProductExist($product_name) > 0) {

                echo 'Product Already Exist';

            } else {

                $connection = $this->openConnection();
                $stmt = $connection->prepare("INSERT INTO `products_tbl` (`product_name`,`product_type`,`description`,`min_stock`) VALUES (?,?,?,?)");
                $stmt->execute([$product_name,$product_type,$description,$min_stock]);
                $result = $stmt->rowCount();
    
                if($result > 0) {
                    echo 'Product Added';
                } else {
                    echo 'Product add failed';
                }

            }
        }
    }

    public function checkProductExist($product_name) {

        $connection = $this->openConnection();
        $stmt = $connection->prepare("SELECT LOWER('product_name') FROM `products_tbl` WHERE `product_name` = ?");
        $stmt->execute([strtolower($product_name)]);
        $result = $stmt->rowCount();

        return $result;
    }
}


?>