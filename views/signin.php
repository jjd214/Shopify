<?php require_once('../php/init.php'); ?>
<?php include('../partials/__header.php'); ?>

<style>
    .logo-img {
        max-width: 100%; /* Adjust the maximum width as needed */
        height: 300px; /* Maintain the aspect ratio */
    }

    .password-container {
        position: relative;
    }

    .password-toggle {
        position: absolute;
        top: 73%;
        right: 10px;
        transform: translateY(-50%);
        cursor: pointer;
    }

    .custom-btn {
        width: 100%; /* Adjust the width as needed */
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
                </div>
                <div class="card-body">
                    <?php signin(); ?>
                    <form method="post">
                        <div class="mb-3">
                            <label for="email" class="form-label">Email address</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Enter your Email..." required>
                        </div>
                        <div class="mb-3 password-container">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password..." required>
                            <i class="fas fa-eye password-toggle" id="togglePassword"></i>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block custom-btn" name="submit">Sign In</button>
                    </form>

                    <!-- Include Forgot Password Link -->
                    <div class="text-center mt-3">
                        <a href="forgot_password.php">Forgot Password?</a>
                    </div>

                    <hr class="my-4">
                    <p class="text-center mb-0">Don't have an account? <a href="signup.php">Sign up</a></p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    const passwordInput = document.getElementById('password');
    const togglePassword = document.getElementById('togglePassword');

    togglePassword.addEventListener('click', function () {
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);
        this.classList.toggle('fa-eye-slash');
    });
</script>

<?php include('../partials/__footer.php'); ?>
