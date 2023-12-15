<?php require_once('../php/init.php'); ?>
<?php include('../partials/__header.php'); ?>
<style>
    .logo-img {
        max-width: 100%; /* Adjust the maximum width as needed */
        height: 200px; /* Maintain the aspect ratio */
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
                </div>
                <div class="card-body">
                    <?php signup(); ?>
                    <form method="post">
                        <div class="row mb-3">
                            <div class="col">
                                <label for="firstname" class="form-label">First Name</label>
                                <input type="text" class="form-control" id="firstname" name="firstname" placeholder="Enter your Firstname..." required>
                            </div>
                            <div class="col">
                                <label for="lastname" class="form-label">Last Name</label>
                                <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Enter your Lastname..." required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="middlename" class="form-label">Middle Name</label>
                            <input type="text" class="form-control" id="middlename" name="middlename" placeholder="Enter your Middlename..." required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email address</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Enter your Email..." required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password..." required>
                        </div>
                        <div class="mb-3">
                            <label for="confirmPassword" class="form-label">Confirm Password</label>
                            <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" placeholder="Confirm your password..." required>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block" name="submit">Sign Up</button>
                    </form>
                    <hr class="my-4">
                    <p class="text-center mb-0">Already have an account? <a href="signin.php">Sign in</a></p>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('../partials/__footer.php'); ?>

