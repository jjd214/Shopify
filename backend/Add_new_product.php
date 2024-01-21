<?php
class Add_new_product extends Config {

    public function addNewProduct() {

        if(isset($_POST['submit'])) {

            $product_name = $_POST['product_name'];
            $product_type = $_POST['product_type'];
            $description = $_POST['description'];
            $min_stock = $_POST['min_stock'];
            $seller = $_POST['name'];
            $seller_id = $_POST['seller_id'];

            if($this->checkStoreExist($seller_id) == 0) {

                $_SESSION['status'] = '<div class="alert alert-info alert-dismissible fade show" role="alert">
                                        Set your business account first.
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>';

                echo '<script>window.location.href = "/e-commerce/views/seller/pages/forms/settings.php";</script>';
                exit();

            } else if($this->checkProductExist($product_name,$seller_id) > 0) {

                echo '<div class="alert alert-info alert-dismissible fade show" role="alert">
                                        Product already exist in your store.
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>';

            } else {

                $connection = $this->openConnection();
                $stmt = $connection->prepare("INSERT INTO `products_tbl` (`seller_id`,`product_name`,`product_type`,`description`,`min_stock`,`added_by`) VALUES (?,?,?,?,?,?)");
                $stmt->execute([$seller_id,$product_name,$product_type,$description,$min_stock,$seller]);
                $result = $stmt->rowCount();
    
                if($result > 0) {
                    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                Product Added.
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>';
                } else {
                    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                            Added Failed.
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>';
                }
            }
        }
    }

    public function checkProductExist($product_name,$seller_id) {
        $connection = $this->openConnection();
        $stmt = $connection->prepare("SELECT LOWER('product_name') FROM `products_tbl` WHERE `product_name` = ? AND `seller_id` = ?");
        $stmt->execute([strtolower($product_name),$seller_id]);
        $result = $stmt->rowCount();

        return $result;
    }

    public function checkStoreExist($seller_id) {
        $connection = $this->openConnection();
        $stmt = $connection->prepare("SELECT storename FROM `user_tbl` WHERE `id` = ?");
        $stmt->execute([$seller_id]);
        $storeData = $stmt->fetch(PDO::FETCH_ASSOC);
    
        return isset($storeData['storename']);
    }
    
    
}


?>