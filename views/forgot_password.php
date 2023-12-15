<?php require_once('../php/init.php'); ?>
<?php include('../partials/__header.php'); ?>
<style>
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
        <div class="col-md-6">
            <div class="card shadow p-4">
                <div class="text-center mb-4">
                    <img src="../images/shopify cutie.png" alt="Shopify Logo" class="logo-img">
                    <?php forgotPassword(); ?>
                </div>
                <div class="card-body">
                    <form method="post">
                        <div class="mb-3">
                            <label for="email" class="form-label">Email address</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Enter your Email..." required>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block" name="submit">Send Email Verification</button>
                    </form>
                    <hr class="my-4">
                    <p class="text-center mb-0">Already have an account? <a href="signin.php">Sign in</a></p>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('../partials/__footer.php'); ?>