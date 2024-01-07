<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'].'/e-commerce/vendor/autoload.php';


class Signup extends Config {

    public function signup() {

        if (isset($_POST['submit'])) {
            $firstname = $_POST['firstname'];
            $lastname = $_POST['lastname'];
            $middlename = $_POST['middlename'];
            $email = $_POST['email'];
            $password = md5($_POST['password']);
            $confirmPassword = md5($_POST['confirmPassword']);
            $verify_token = md5(rand());
            $otp = $this->generateOTP();

            if($this->emailExists($email) > 0) {
                echo '<div class="alert alert-info alert-dismissible fade show" role="alert">
                        Email already exists.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>';
            } else if (!$this->validatePassword($_POST['password'])) {
                echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                        Password must be at least 8 characters long and include at least one uppercase letter, one lowercase letter, and one number.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>';
            } else if (!$this->passwordsMatch($_POST['password'], $_POST['confirmPassword'])) {
                echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                        Passwords do not match.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>';
            } else {
                // Save user information, verify token, and account type in session
                $_SESSION['signup_data'] = [
                    'firstname' => $firstname,
                    'lastname' => $lastname,
                    'middlename' => $middlename,
                    'email' => $email,
                    'password' => $password,
                    'verify_token' => $verify_token,
                    'otp' => $otp,
                    'account_type' => $_POST['accountType'],
                ];

                // Send the OTP to the user's email
                $this->verifyEmail($_SESSION['signup_data']);

                // Redirect to OTP verification page
                // header("Location: otp_input.php");
                // exit();
            }
        }
    }

    public function emailExists($email) {
        $connection = $this->openConnection();
        $stmt = $connection->prepare("SELECT * FROM `user_tbl` WHERE `email` = ?");
        $stmt->execute([$email]);
        $result = $stmt->fetch();

        return $result;
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

    public function passwordsMatch($password, $confirmPassword) {
        return $password === $confirmPassword;
    }

    public function verifyEmail($userData) {

        $email = $userData['email'];
        $otp = $userData['otp'];

        // Create SMTP transport
        $transport = new \Swift_SmtpTransport('smtp.gmail.com', 587, 'tls'); // Use port 587 and 'tls'
        $transport->setUsername('johnjacobdimaya0@gmail.com');
        $transport->setPassword('nwixlkkkgrqxqyqs');

        // Set stream options to disable SSL verification
        $transport->setStreamOptions(['ssl' => ['allow_self_signed' => true, 'verify_peer' => false]]);

        // Create Swift Mailer instance
        $mailer = new \Swift_Mailer($transport);

        // Create and send the email with OTP
        $message = new \Swift_Message('OTP for Signup');
        $message->setFrom(['johnjacobdimaya0@gmail.com' => 'Mailer']);
        $message->addTo($email);
        $message->setBody("
            <h2>You have Registered with Shopify</h2>
            <h5>Use the following OTP to complete your signup:</h5>
            <br></br>
            <strong>{$otp}</strong>
        ", 'text/html');

        try {
            $result = $mailer->send($message);
            if ($result) {
                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                        OTP has been sent to your email address.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>';
                      
                header("Location: otp_input.php?email=" . urlencode($email));
                exit();    

            } else {
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                        Failed to send the OTP.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>';
            }
        } catch (\Swift_TransportException $e) {
            echo "Message could not be sent. Mailer Error: {$e->getMessage()}";
        }
        
    }

    public function generateOTP($length = 6) {
        // Generate a random numeric OTP
        $otp = '';
        for ($i = 0; $i < $length; $i++) {
            $otp .= mt_rand(0, 9);
        }
        return $otp;
    }

    public function verifyOTP($userEnteredOTP) {

        $storedOTP = $_SESSION['signup_data']['otp'];
        $newOTP = isset($_SESSION['newOTP']) ? $_SESSION['newOTP'] : '';

        // var_dump($storedOTP,$newOTP,$userEnteredOTP);
        if($userEnteredOTP == $storedOTP || $userEnteredOTP == $newOTP) {

            $this->insertUserIntoDatabase();

            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    Email verification successfull.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
        
            unset($_SESSION['newOTP']);
            unset($_SESSION['signup_data']);
            
        } else {
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    Incorrect OTP. Please try again.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
        }
    }

    public function resendOTP() {   

        if(isset($_POST['resendOTP'])) {

            $storedEmail = $_SESSION['signup_data']['email'];

            $newOTP = $this->generateOTP();
            
            $this->newOTPGenerator($storedEmail,$newOTP);

        }
    }

    public function newOTPGenerator($email,$newOTP) {

        // $newOTP = $this->generateOTP();
        
        // Create SMTP transport
        $transport = new \Swift_SmtpTransport('smtp.gmail.com', 587, 'tls'); // Use port 587 and 'tls'
        $transport->setUsername('johnjacobdimaya0@gmail.com');
        $transport->setPassword('nwixlkkkgrqxqyqs');

        // Set stream options to disable SSL verification
        $transport->setStreamOptions(['ssl' => ['allow_self_signed' => true, 'verify_peer' => false]]);

        // Create Swift Mailer instance
        $mailer = new \Swift_Mailer($transport);

        // Create and send the email with OTP
        $message = new \Swift_Message('OTP for Signup');
        $message->setFrom(['johnjacobdimaya0@gmail.com' => 'Mailer']);
        $message->addTo($email);
        $message->setBody("
            <h2>You have Registered with Shopify</h2>
            <h5>Use the following OTP to complete your signup:</h5>
            <br></br>
            <strong>{$newOTP}</strong>
        ", 'text/html');

        try {
            $result = $mailer->send($message);
            if ($result) {
                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                        OTP resent successfull.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>';
            } else {
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                        Failed to send the OTP.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>';
            }
        } catch (\Swift_TransportException $e) {
            echo "Message could not be sent. Mailer Error: {$e->getMessage()}";
        }

        $_SESSION['newOTP'] = $newOTP;
    }

    public function insertUserIntoDatabase() {
        // Retrieve user data from the session
        $userData = $_SESSION['signup_data'];

        // Extract user data including account type
        $firstname = $userData['firstname'];
        $lastname = $userData['lastname'];
        $middlename = $userData['middlename'];
        $email = $userData['email'];
        $password = $userData['password'];
        $verify_token = $userData['verify_token'];
        $account_type = $userData['account_type'];

        $access = 'customer';
        
        // If the account type is business, change access to "seller"
        if ($account_type === 'business') {
            $access = 'seller';
        }

        // Insert user into the database with account_type
        $connection = $this->openConnection();
        $stmt = $connection->prepare("INSERT INTO `user_tbl` (`firstname`,`lastname`,`middlename`,`email`,`password`,`account_type`, `access`, `verify_token`) VALUES(?,?,?,?,?,?,?,?)");
        $stmt->execute([$firstname, $lastname, $middlename, $email, $password, $account_type, $access, $verify_token]);
        $result = $stmt->rowCount();

        if ($result > 0) {
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    User successfully registered.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>';
        } else {
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    Failed to register user.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>';
        }
    }
}
?>

