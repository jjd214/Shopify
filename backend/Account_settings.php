<?php
class account_settings extends Config {

    public function businessSettings() {
        if(isset($_POST['submit'])) {
            $storename = $_POST['store_name'];
            $firstname = $_POST['fname'];
            $lastname = $_POST['lname'];
            $middlename = $_POST['mname'];
            $description = $_POST['description'];
            $sellerId = $_POST['id'];
            
            $connection = $this->openConnection();
            
            // Check if a new image is selected
            if (!empty($_FILES['image']['name'])) {
                $img_name = $_FILES['image']['name'];
                $img_size = $_FILES['image']['size'];
                $tmp_name = $_FILES['image']['tmp_name'];
                $error = $_FILES['image']['error'];
    
                // Check for allowed image types
                $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
                $img_ex_lc = strtolower($img_ex);
                $allowed_exs = array("jpg", "jpeg", "png");
    
                if (in_array($img_ex_lc, $allowed_exs)) {
                    // Generate a unique image name
                    date_default_timezone_set('Asia/Manila');
                    $currentDateTime = date('Y-m-d h:i:s A');
                    $formattedDateTime = date('Y-m-d-h-i-s-A', strtotime($currentDateTime));
                    $new_img_name = "IMG-" . $sellerId . "-" . $formattedDateTime . '.' . $img_ex_lc;
    
                    // Define the upload path
                    $img_upload_path = '/e-commerce/img/business_account/' . $new_img_name;
    
                    // Move the uploaded image to the specified location
                    move_uploaded_file($tmp_name, $_SERVER['DOCUMENT_ROOT'] . $img_upload_path);
    
                    // Get the current image name from the database
                    $stmt_get_image = $connection->prepare("SELECT `image` FROM `user_tbl` WHERE `id` = ?");
                    $stmt_get_image->execute([$sellerId]);
                    $current_image = $stmt_get_image->fetchColumn();
    
                    // Delete the previous image
                    if ($current_image) {
                        $previous_image_path = $_SERVER['DOCUMENT_ROOT'] . '/e-commerce/img/business_account/' . $current_image;
                        if (file_exists($previous_image_path)) {
                            unlink($previous_image_path);
                        }
                    }
    
                    // Update user's business settings in the database with the new image
                    $stmt = $connection->prepare("UPDATE `user_tbl` SET `firstname` = ?, `lastname` = ?, `middlename` = ?, `image` = ?, `storename` = ? WHERE `id` = ?");
                    $stmt->execute([$firstname, $lastname, $middlename, $new_img_name, $storename, $sellerId]);
    
                    // Check if the update was successful
                    $result = $stmt->rowCount();
    
                    if ($result > 0) {
                        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                Business settings updated.
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>';
                    } else {
                        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                Failed to update business settings.
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>';
                    }
                } else {
                    echo '<div class="alert alert-info alert-dismissible fade show" role="alert">
                            You can\'t upload this type of file.
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>';
                }
            } else {
                // No new image uploaded, retain the current business image
                $stmt = $connection->prepare("UPDATE `user_tbl` SET `firstname` = ?, `lastname` = ?, `middlename` = ?, `storename` = ? WHERE `id` = ?");
                $stmt->execute([$firstname, $lastname, $middlename, $storename, $sellerId]);
    
                // Check if the update was successful
                $result = $stmt->rowCount();
    
                if ($result > 0) {
                    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                            Business settings updated.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>';
                } else {
                    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                            Failed to update business settings.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>';
                }
            }
        }
    }
    
    

    public function setBillingAddress() {
        if(isset($_POST['submit'])) {
            $firstname = $_POST['firstname'];
            $lastname = $_POST['lastname'];
            $country = $_POST['country'];
            $address = $_POST['address'];
            $city = $_POST['city'];
            $zipcode = $_POST['zipcode'];
            $phone_number = $_POST['phoneno'];
            $email = $_POST['email'];
            $order_notes = $_POST['notes'];
            $user_id = $_POST['user_id'];
    
            $connection = $this->openConnection();
    
            // Check if user_id exists
            $checkStmt = $connection->prepare("SELECT COUNT(*) as count FROM `billing_tbl` WHERE `user_id` = ?");
            $checkStmt->execute([$user_id]);
            $rowCount = $checkStmt->fetchColumn();
    
            if ($rowCount > 0) {
                // User_id exists, perform update
                $stmt = $connection->prepare("UPDATE `billing_tbl` SET `firstname`=?, `lastname`=?, `country`=?, `address`=?, `city`=?, `postcode`=?, `phoneno`=?, `email`=?, `order_notes`=? WHERE `user_id`=?");
                $stmt->execute([$firstname, $lastname, $country, $address, $city, $zipcode, $phone_number, $email, $order_notes, $user_id]);
    
                $result = $stmt->rowCount();
    
                if($result > 0) {
                    echo '<div class="alert alert-info alert-dismissible fade show" role="alert">
                                Address updated
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>';
                } else {
                    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                Failed to update address.
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>';
                }
            } else {
                // User_id does not exist, perform insert
                $stmt = $connection->prepare("INSERT INTO `billing_tbl` (`user_id`, `firstname`, `lastname`, `country`, `address`, `city`, `postcode`, `phoneno`, `email`, `order_notes`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                $stmt->execute([$user_id, $firstname, $lastname, $country, $address, $city, $zipcode, $phone_number, $email, $order_notes]);
    
                $result = $stmt->rowCount();
    
                if($result > 0) {
                    echo '<div class="alert alert-info alert-dismissible fade show" role="alert">
                                Address set
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>';
                } else {
                    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                Failed to set address.
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>';
                }
            }
            
        }
        
    }
    
    
}
?>
