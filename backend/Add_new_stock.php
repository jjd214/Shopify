<?php
class Add_new_stock extends Config {

    public function addStock() {

        if(isset($_POST['submit'])) {

            $img_name = $_FILES['product_image']['name'];
            $img_size = $_FILES['product_image']['size'];
            $tmp_name = $_FILES['product_image']['tmp_name'];
            $error = $_FILES['product_image']['error'];
            
            $product_id = $_POST['product_id'];
            $brand_name = $_POST['brand_name'];
            $quantity = $_POST['quantity'];
            $price = $_POST['price'];
            $batch_number = $_POST['batch_number'];
            $added_by = $_POST['added_by'];
            $description = $_POST['description'];
            
            if ($error === 0) {
                $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
                $img_ex_lc = strtolower($img_ex);
    
                $allowed_exs = array("jpg", "jpeg", "png");
    
                if (in_array($img_ex_lc, $allowed_exs)) {
                    date_default_timezone_set('Asia/Manila');
                    $currentDateTime = date('Y-m-d h:i:s A');
                    $formattedDateTime = date('Y-m-d-h-i-s-A', strtotime($currentDateTime));
                    $new_img_name = "IMG-" . $product_id . "-" . $formattedDateTime . '.' . $img_ex_lc;
    
                    $img_upload_path = '/e-commerce/uploads/' . $new_img_name;
                    move_uploaded_file($tmp_name, $_SERVER['DOCUMENT_ROOT'] . $img_upload_path);
    
                    $connection = $this->openConnection();
                    $stmt = $connection->prepare("INSERT INTO `productItems_tbl` (`product_id`,`product_image`,`description`,`qty`,`price`,`vendor_name`,`batch_number`,`added_by`) VALUES (?,?,?,?,?,?,?,?)");
                    $stmt->execute([$product_id, $new_img_name, $description, $quantity, $price, $brand_name, $batch_number, $added_by]);
                    $result = $stmt->rowCount();
    
                    if($result > 0) {
                        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                Stock added.
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>';
                    }
                } else {
                    echo '<div class="alert alert-info alert-dismissible fade show" role="alert">
                            You can\'t upload this type of file.
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>';
                }
            } else {
                echo '<div class="alert alert-info alert-dismissible fade show" role="alert">
                        Unknown error occurred.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
            }
        }
    }

    public function delete_stock() {
        if(isset($_POST['delete_item'])) {

            $id = $_POST['stock_id'];
            
            $connection = $this->openConnection();
            $stmt = $connection->prepare("DELETE FROM `productItems_tbl` WHERE `id` = ?");
            $stmt->execute([$id]);

            header("Location: " .$_SERVER['HTTP_REFERER']);
        }
    }
}
?>
