<?php
class Add_new_stock extends Config {

    public function addStock() {

        if(isset($_POST['submit'])) {

            $product_id = $_POST['product_id'];
            $brand_name = $_POST['brand_name'];
            $quantity = $_POST['quantity'];
            $batch_number = $_POST['batch_number'];
            $added_by = $_POST['added_by'];
            
            $connection = $this->openConnection();
            $stmt = $connection->prepare("INSERT INTO `productItems_tbl` (`product_id`,`qty`,`vendor_name`,`batch_number`,`added_by`) VALUES (?,?,?,?,?)");
            $stmt->execute([$product_id,$quantity,$brand_name,$batch_number,$added_by]);
            $result = $stmt->rowCount();

            if($result > 0) {
                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                        Stock added.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
            }
        }
    }
}

?>