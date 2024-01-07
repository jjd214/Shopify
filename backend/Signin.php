<?php
class Signin extends Config {

    public function signin() {
        if(isset($_POST['submit'])) {

            $email = $_POST['email'];
            $password = md5($_POST['password']);

            $connection = $this->openConnection();
            $stmt = $connection->prepare("SELECT * FROM `user_tbl` WHERE `email` = ? AND `password` = ? ");
            $stmt->execute([$email,$password]);
            $data = $stmt->fetch();
            $count = $stmt->rowCount();

            if ($count == 1) {
                $this->set_session($data);
                header("Location: index.php");
            } else {
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            Incorrect email or password
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
            }
        }
    }
    public function set_session($array){

        if (!isset($_SESSION)) {
            session_start();
        }
        $_SESSION['userdata'] = array (
            "id" => $array['id'],
            "email" => $array['email'],
            "fullname" => $array['firstname']." ".$array['lastname'],
            "access" => $array['access']
        );
        return $_SESSION['userdata'];
    }
    public function get_session(){

        if (!isset($_SESSION)) {
            session_start();
        }
        if (isset($_SESSION['userdata'])) {
            return $_SESSION['userdata'];
        } else {
            return null;
        }
    }
    public function signout() {
        
        if (!isset($_SESSION)) {
            session_start();
        }
        $_SESSION['userdata'] = null;
        unset($_SESSION['userdata']);
    }
}

?>