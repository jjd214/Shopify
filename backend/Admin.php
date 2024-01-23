<?php
class Admin extends Config {

    public function create_new_admin() {
        if(isset($_POST['submit'])) {
            
            $firstname = $_POST['firstname'];
            $lastname = $_POST['lastname'];
            $middlename = $_POST['middlename'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $confirm_password = $_POST['confirm_password'];
            $access = 'admin';

            // Validate and hash the password using MD5 (not recommended)
            if ($password === $confirm_password) {
                $hashed_password = md5($password);

                $connection = $this->openConnection();
                $stmt = $connection->prepare("INSERT INTO `user_tbl` (`firstname`,`lastname`,`middlename`,`email`,`password`,`access`) VALUES (?,?,?,?,?,?) ");
                $stmt->execute([$firstname, $lastname, $middlename, $email, $hashed_password, $access]);
                
                echo '<div class="alert alert-info alert-dismissible fade show" role="alert">
                                    Account added.
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>';
            } else {
                // Handle password mismatch error
                echo "Password and confirm password do not match.";
            }
        }
    }
}
?>
