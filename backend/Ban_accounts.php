<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/e-commerce/vendor/autoload.php';

class Ban_accounts extends Config {

    public function ban_seller_accounts() {
        if(isset($_POST['ban_account'])) {  
            $seller_id = $_POST['seller_id'];
            $ban_by = $_POST['ban_by'];
            $violation = $_POST['violation_reason'];

            $connection = $this->openConnection();
            $stmt = $connection->prepare("SELECT * FROM `user_tbl` WHERE `access` = 'seller' AND `id` = ?");
            $stmt->execute([$seller_id]);
            $sellerData = $stmt->fetch();
            $result = $stmt->rowCount();
            
            if($result > 0) {
                $id = $sellerData['id'];
                $firstname = $sellerData['firstname'];
                $lastname = $sellerData['lastname'];
                $middlename = $sellerData['middlename'];
                $email = $sellerData['email'];
                $account_type = $sellerData['account_type'];
                $storename = $sellerData['storename'];
                $store_image = $sellerData['image'];

                $this->sendBannedNotice($email, $storename, $account_type, $violation);

                $stmt = $connection->prepare("INSERT INTO `banned_accounts_tbl` (`firstname`,`lastname`,`middlename`,`email`,`account_type`,`storename`,`ban_by`,`violation`,`store_image`) VALUES(?,?,?,?,?,?,?,?,?)");
                $stmt->execute([$firstname,$lastname,$middlename,$email,$account_type,$storename,$ban_by,$violation,$store_image]);

                $stmt = $connection->prepare("DELETE FROM `user_tbl` WHERE `id` = ?");
                $stmt->execute([$id]);
            }
        }
    }

    public function ban_customer_accounts() {
        if(isset($_POST['ban_account'])) {  
            
            $customer_id = $_POST['customer_id'];
            $ban_by = $_POST['ban_by'];
            $violation = $_POST['violation_reason'];

            $connection = $this->openConnection();
            $stmt = $connection->prepare("SELECT * FROM `user_tbl` WHERE `access` = 'customer' AND `id` = ?");
            $stmt->execute([$customer_id]);
            $customerData = $stmt->fetch();
            $result = $stmt->rowCount();
            
            if($result > 0) {
                $id = $customerData['id'];
                $firstname = $customerData['firstname'];
                $lastname = $customerData['lastname'];
                $middlename = $customerData['middlename'];
                $email = $customerData['email'];
                $account_type = $customerData['account_type'];
                $storename = $customerData['storename'];
                $store_image = $customerData['image'];

                $fullname = $firstname. " ".$lastname;

                $this->sendBannedNotice($email, $fullname, $account_type, $violation);

                $stmt = $connection->prepare("INSERT INTO `banned_accounts_tbl` (`firstname`,`lastname`,`middlename`,`email`,`account_type`,`storename`,`ban_by`,`violation`,`store_image`) VALUES(?,?,?,?,?,?,?,?,?)");
                $stmt->execute([$firstname,$lastname,$middlename,$email,$account_type,$storename,$ban_by,$violation,$store_image]);

                $stmt = $connection->prepare("DELETE FROM `user_tbl` WHERE `id` = ?");
                $stmt->execute([$id]);
            }
        }
    }

    private function sendBannedNotice($recipientEmail, $recipientName, $accountType, $violation) {
        $transport = (new Swift_SmtpTransport('smtp.gmail.com', 587, 'tls'))
            ->setUsername('johnjacobdimaya0@gmail.com')
            ->setPassword('nwixlkkkgrqxqyqs')
            ->setStreamOptions(['ssl' => ['allow_self_signed' => true, 'verify_peer' => false, 'verify_peer_name' => false]]);
        $mailer = new Swift_Mailer($transport);

        $subject = 'Notice of Account Ban';
        $message = "
            Dear $recipientName,

            We hope this message finds you well.

            We regret to inform you that your account on Shopify has been permanently banned due to a violation of our business policies. This decision has been made after a careful review of your account activity, and it has been determined that certain actions were not in compliance with our policies.

            The specific violation(s) $violation. Our policies are in place to ensure a fair and secure marketplace for all users, and any breaches must be addressed to maintain the integrity of our platform.

            Please be advised that this ban is effective immediately. You will no longer be able to access your account or conduct any business transactions on our platform.

            If you have any questions regarding the violation or the ban, please contact our support team at [johnjacob.dimaya@cvsu.edu.ph] for further assistance. We will do our best to address your concerns and provide clarification on the matter.

            Thank you for your understanding.

            Sincerely,
            Shopify
        ";

        $swiftMessage = (new Swift_Message($subject))
            ->setFrom(['noreply@example.com' => 'Shopify'])
            ->setTo([$recipientEmail => $recipientName])
            ->setBody($message, 'text/plain');

        // Send the banned notice
        $result = $mailer->send($swiftMessage);

        // Check if the email was sent successfully
        if ($result) {
            // You can log or handle the success scenario if needed
            echo '<script>alert("Account banned successfully!")</script>';
        } else {
            echo '<script>alert("Failed to send banned notice.")</script>';
        }
    }

    public function delete_seller_account() {
        if(isset($_POST['delete_account'])) {
            $seller_id = $_POST['seller_id'];

            $connection = $this->openConnection();
            $stmt = $connection->prepare("DELETE FROM `user_tbl` WHERE `access` = 'seller' AND `id` = ?");
            $stmt->execute([$seller_id]);
        }
    }
}
?>
