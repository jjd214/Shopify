<?php
class account_settings extends Config {

    public function businessSettings() {
        if(isset($_POST['submit'])) {
            $img_name = $_FILES['image']['name'];
            $img_size = $_FILES['image']['size'];
            $tmp_name = $_FILES['image']['tmp_name'];
            $error = $_FILES['image']['error'];

            $storename = $_POST['store_name'];
            $firstname = $_POST['fname'];
            $lastname = $_POST['lname'];
            $middlename = $_POST['mname'];
            $description = $_POST['description'];
            $sellerId = $_POST['id'];

            // Check if an image is selected
            if ($error === 0) {
                $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
                $img_ex_lc = strtolower($img_ex);
                $allowed_exs = array("jpg", "jpeg", "png");

                if (in_array($img_ex_lc, $allowed_exs)) {
                    date_default_timezone_set('Asia/Manila');
                    $currentDateTime = date('Y-m-d h:i:s A');
                    $formattedDateTime = date('Y-m-d-h-i-s-A', strtotime($currentDateTime));
                    $new_img_name = "IMG-" . $sellerId . "-" . $formattedDateTime . '.' . $img_ex_lc;
                    // Define the upload path
                    $img_upload_path = '/e-commerce/img/business_account/' . $new_img_name;
                    
                    // Move the uploaded image to the specified location
                    move_uploaded_file($tmp_name, $_SERVER['DOCUMENT_ROOT'] . $img_upload_path);

                    // Update user's business settings in the database
                    $connection = $this->openConnection();
                    $stmt = $connection->prepare("UPDATE `user_tbl` SET `firstname` = ?, `lastname` = ?, `middlename` = ?, `image` = ?, `storename` = ? WHERE `id` = ?");
                    $stmt->execute([$firstname, $lastname, $middlename, $new_img_name,$storename, $sellerId]);

                    // Check if the update was successful
                    $result = $stmt->rowCount();

                    if ($result > 0) {
                        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                Business settings updated.
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
                echo '<div class="alert alert-info alert-dismissible fade show" role="alert">
                        Unknown error occurred.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
            }
        }
    }
}
?>
