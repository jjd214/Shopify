<?php
class Account_settings extends Config {

    public function businessSettings() {
        if(isset($_POST['submit'])) {
            $storename = $_POST['store_name'];
            $firstname = $_POST['fname'];
            $lastname = $_POST['lname'];
            $middlename = $_POST['mname'];
            $email = $_POST['email'];
            $sellerId = $_POST['id'];
            
            $connection = $this->openConnection();
            
            if (!empty($_FILES['image']['name'])) {
                $img_name = $_FILES['image']['name'];
                $img_size = $_FILES['image']['size'];
                $tmp_name = $_FILES['image']['tmp_name'];
                $error = $_FILES['image']['error'];
    
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
                    $stmt = $connection->prepare("UPDATE `user_tbl` SET `firstname` = ?, `lastname` = ?, `middlename` = ?, `image` = ?, `email` = ?, `storename` = ? WHERE `id` = ?");
                    $stmt->execute([$firstname, $lastname, $middlename, $new_img_name, $email, $storename, $sellerId]);

    
                    // Check if the update was successful
                    $result = $stmt->rowCount();
    
                    if ($result > 0) {
                        $_SESSION['update_status'] = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                Business settings updated.
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>';

                            header("Location: ".$_SERVER['HTTP_REFERER']);
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

                $stmt = $connection->prepare("UPDATE `user_tbl` SET `firstname` = ?, `lastname` = ?, `middlename` = ?, `email` = ?, `storename` = ? WHERE `id` = ?");
                $stmt->execute([$firstname, $lastname, $middlename, $email, $storename, $sellerId]);
    
                $result = $stmt->rowCount();
    
                if ($result > 0) {
                    $_SESSION['update_status'] = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                            Business settings updated.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>';

                    header("Location: ".$_SERVER['HTTP_REFERER']);
                        
                } else {
                    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                            Failed to update business settings.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>';
                }
            }
        }
    }

    public function customerSettings() {
        if(isset($_POST['submit'])) {

            $firstname = $_POST['fname'];
            $lastname = $_POST['lname'];
            $middlename = $_POST['mname'];
            $email = $_POST['email'];

            $customerId = $_POST['id'];
            
            $connection = $this->openConnection();
            
            if (!empty($_FILES['image']['name'])) {
                $img_name = $_FILES['image']['name'];
                $img_size = $_FILES['image']['size'];
                $tmp_name = $_FILES['image']['tmp_name'];
                $error = $_FILES['image']['error'];
    
                $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
                $img_ex_lc = strtolower($img_ex);
                $allowed_exs = array("jpg", "jpeg", "png");
    
                if (in_array($img_ex_lc, $allowed_exs)) {
                    // Generate a unique image name
                    date_default_timezone_set('Asia/Manila');
                    $currentDateTime = date('Y-m-d h:i:s A');
                    $formattedDateTime = date('Y-m-d-h-i-s-A', strtotime($currentDateTime));
                    $new_img_name = "IMG-" . $customerId . "-" . $formattedDateTime . '.' . $img_ex_lc;
    
                    // Define the upload path
                    $img_upload_path = '/e-commerce/img/personal_account/' . $new_img_name;
    
                    // Move the uploaded image to the specified location
                    move_uploaded_file($tmp_name, $_SERVER['DOCUMENT_ROOT'] . $img_upload_path);
    
                    // Get the current image name from the database
                    $stmt_get_image = $connection->prepare("SELECT `image` FROM `user_tbl` WHERE `id` = ?");
                    $stmt_get_image->execute([$customerId]);
                    $current_image = $stmt_get_image->fetchColumn();
    
                    // Delete the previous image
                    if ($current_image) {
                        $previous_image_path = $_SERVER['DOCUMENT_ROOT'] . '/e-commerce/img/personal_account/' . $current_image;
                        if (file_exists($previous_image_path)) {
                            unlink($previous_image_path);
                        }
                    }
    
                    // Update user's business settings in the database with the new image
                    $stmt = $connection->prepare("UPDATE `user_tbl` SET `firstname` = ?, `lastname` = ?, `middlename` = ?, `image` = ?, `email` = ?, `storename` = ? WHERE `id` = ?");
                    $stmt->execute([$firstname, $lastname, $middlename, $new_img_name, $email, $storename, $customerId]);
    
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

                $stmt = $connection->prepare("UPDATE `user_tbl` SET `firstname` = ?, `lastname` = ?, `middlename` = ?, `email` = ? WHERE `id` = ?");
                $stmt->execute([$firstname, $lastname, $middlename, $email, $customerId]);
    
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
    
            $checkStmt = $connection->prepare("SELECT COUNT(*) as count FROM `billing_tbl` WHERE `user_id` = ?");
            $checkStmt->execute([$user_id]);
            $rowCount = $checkStmt->fetchColumn();
    
            if ($rowCount > 0) {

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

    public function sellerChangePassword() {
        if (isset($_POST['security_submit'])) {
            $old_password = md5($_POST['old_password']);
            $new_password = $_POST['new_password'];
            $confirm_password = $_POST['confirm_password'];
            $seller_id = $_POST['seller_id'];
    
            $connection = $this->openConnection();
            $stmt = $connection->prepare("SELECT password FROM `user_tbl` WHERE `id` = ?");
            $stmt->execute([$seller_id]);
            $stored_password = $stmt->fetchColumn();
    
            if ($stored_password === $old_password) {
                if ($new_password === $confirm_password) {
                    if ($this->validatePassword($new_password)) {
                        $encryptedPassword = md5($new_password);
    
                        $stmt = $connection->prepare("UPDATE `user_tbl` SET `password` = ? WHERE `id` = ?");
                        $stmt->execute([$encryptedPassword, $seller_id]);
    
                        if ($stmt->rowCount() > 0) {
                            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                    Password successfully changed.
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>';
                        } else {
                            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    Failed to update password.
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>';
                        }
                    } else {
                        echo '<div class="alert alert-info alert-dismissible fade show" role="alert">
                        Password must be at least 8 characters long and include at least one uppercase letter, one lowercase letter, and one number.
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>';
                    }
                } else {
                    echo '<div class="alert alert-info alert-dismissible fade show" role="alert">
                            Passwords do not match.
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>';
                }
            } else {
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                        Incorrect old password.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>';
            }
        }
    }
    
    public function validatePassword($password) {
        // Define password requirements
        $minLength = 8;
        $hasUppercase = preg_match('/[A-Z]/', $password);
        $hasLowercase = preg_match('/[a-z]/', $password);
        $hasNumber = preg_match('/\d/', $password);
    
        // Check if password meets the requirements
        if (strlen($password) < $minLength || !$hasUppercase || !$hasLowercase || !$hasNumber) {
            return false;
        }
    
        return true;
    }
    
    
    
    
    
    
}
?>
