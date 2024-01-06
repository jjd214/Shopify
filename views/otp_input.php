<?php require_once('../php/init.php'); ?>
<?php include('../partials/__header.php'); ?>

<?php
$email = isset($_GET['email']) ? urldecode($_GET['email']) : header('Location: signin.php');
?>
<style>
    .custom-btn {
        width: 100%; /* Adjust the width as needed */
    }
   
    .logo-img {
        max-width: 100%; /* Adjust the maximum width as needed */
        height: 300px; /* Maintain the aspect ratio */
    }

    .card {
        transform: scale(0.8);
        transform-origin: top center;
    }

</style>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-5">  
            <div class="card shadow p-4">
                <div class="text-center mb-4">
                    <img src="../images/shopify cutie.png" alt="Shopify Logo" class="logo-img">
                    <?php verifyOTP(); ?>
                    <?php resendOTP(); ?>
                </div>
                <div class="card-body">
                    <form method="post">
                        <div class="mb-3">
                            <label for="otpInput" class="form-label">OTP</label>
                            <div class="input-group">
                                <input type="text" name="otp" class="form-control" id="otpInput" placeholder="Enter OTP" maxlength="6" required>
                            </div>
                        </div>
                        <button type="submit" name="submit" class="btn btn-primary btn-block custom-btn mb-2">Submit OTP</button>
                        </form>
                        <form method="post">
                            <button type="submit" name="resendOTP" class="btn btn-success btn-block custom-btn">Resend OTP</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

<script>
    var countdown = 120; // 2 minutes
    var resendTimer;

    function startResendTimer() {
        document.getElementById('resendTimer').style.display = 'block';
        document.getElementById('resendLink').style.pointerEvents = 'none';

        resendTimer = setInterval(function() {
            countdown--;
            document.getElementById('countdown').textContent = countdown;

            if (countdown <= 0) {
                clearInterval(resendTimer);
                document.getElementById('resendTimer').style.display = 'none';
                document.getElementById('resendLink').style.pointerEvents = 'auto';
            }
        }, 1000);
    }

    function resendOTP() {
        // Implement your logic to resend OTP here
        // For demonstration purposes, let's just reset the timer
        clearInterval(resendTimer);
        countdown = 120;
        startResendTimer();

        // You may want to send a new OTP to the user's email or phone
        console.log('Resending OTP...');
    }
</script>

<?php include('../partials/__footer.php'); ?>
