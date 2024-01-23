<?php include($_SERVER['DOCUMENT_ROOT'].'/e-commerce/php/init.php'); ?>

<?php $customerID = userDetails(); ?>
<?php $carts = viewCartItems($customerID['id']); ?>
<?php $randomStores = viewRandomStores(); ?>

<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Ogani Template">
    <meta name="keywords" content="Ogani, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ogani | Template</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;900&display=swap" rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="css/nice-select.css" type="text/css">
    <link rel="stylesheet" href="css/jquery-ui.min.css" type="text/css">
    <link rel="stylesheet" href="css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="css/style.css" type="text/css">
</head>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <!-- Humberger Begin -->
    <div class="humberger__menu__overlay"></div>
    <div class="humberger__menu__wrapper">
        <div class="humberger__menu__logo">
            <a href="#"><img src="img/logo.png" alt=""></a>
        </div>
        <div class="humberger__menu__cart">
            <ul>
                <li><a href="#"><i class="fa fa-heart"></i> <span>1</span></a></li>
                <li><a href="#"><i class="fa fa-shopping-bag"></i> <span>3</span></a></li>
            </ul>
            <div class="header__cart__price">item: <span>$150.00</span></div>
        </div>
        <div class="humberger__menu__widget">
            <div class="header__top__right__language">
                <img src="img/language.png" alt="">
                <div>English</div>
                <span class="arrow_carrot-down"></span>
                <ul>
                    <li><a href="#">Spanis</a></li>
                    <li><a href="#">English</a></li>
                </ul>
            </div>
            <div class="header__top__right__auth">
                <a href="#"><i class="fa fa-user"></i><?= $customerID['fullname'] ?></a>
            </div>
        </div>
        <nav class="humberger__menu__nav mobile-menu">
        <ul>
                            <li class="active"><a href="./index.php">Home</a></li>
                            <li><a href="./stores.php">Stores</a></li>
                            <li><a href="#">Pages</a>
                                <ul class="header__menu__dropdown">
                                <li><a href="./shoping-cart.php">Shoping Cart</a></li>
                                    <li><a href="./my_address.php">My Address</a></li>
                                    <li><a href="./logout.php">Logout</a></li>
                                </ul>
                            </li>
                            <li><a href="./settings.php">Settings</a></li>
                        </ul>
        </nav>
        <div id="mobile-menu-wrap"></div>
        <div class="header__top__right__social">
            <a href="#"><i class="fa fa-facebook"></i></a>
            <a href="#"><i class="fa fa-twitter"></i></a>
            <a href="#"><i class="fa fa-linkedin"></i></a>
            <a href="#"><i class="fa fa-pinterest-p"></i></a>
        </div>
        <div class="humberger__menu__contact">
            <ul>
                <li><i class="fa fa-envelope"></i> hello@colorlib.com</li>
                <li>Free Shipping for all Order of $99</li>
            </ul>
        </div>
    </div>
    <!-- Humberger End -->

    <!-- Header Section Begin -->
    <header class="header">
        <div class="header__top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="header__top__left">
                            <ul>
                                <li><i class="fa fa-envelope"></i> hello@colorlib.com</li>
                                <li>Free Shipping for all Order of $99</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="header__top__right">
                            <div class="header__top__right__social">
                                <a href="#"><i class="fa fa-facebook"></i></a>
                                <a href="#"><i class="fa fa-twitter"></i></a>
                                <a href="#"><i class="fa fa-linkedin"></i></a>
                                <a href="#"><i class="fa fa-pinterest-p"></i></a>
                            </div>
                            <div class="header__top__right__language">
                                <img src="img/language.png" alt="">
                                <div>English</div>
                                <span class="arrow_carrot-down"></span>
                                <ul>
                                    <li><a href="#">Spanis</a></li>
                                    <li><a href="#">English</a></li>
                                </ul>
                            </div>
                            <div class="header__top__right__auth">
                                <a href="#"><i class="fa fa-user"></i><?= $customerID['fullname'] ?></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="header__logo">
                        <a href="./index.php"><img src="img/logo.png" alt=""></a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <nav class="header__menu">
                    <ul>
                            <li class="active"><a href="./index.php">Home</a></li>
                            <li><a href="./stores.php">Stores</a></li>
                            <li><a href="#">Pages</a>
                                <ul class="header__menu__dropdown">
                                <li><a href="./shoping-cart.php">Shoping Cart</a></li>
                                    <li><a href="./my_address.php">My Address</a></li>
                                    <li><a href="./logout.php">Logout</a></li>
                                </ul>
                            </li>
                            <li><a href="./settings.php">Settings</a></li>
                        </ul>
                    </nav>
                </div>
                <div class="col-lg-3">
                    <div class="header__cart">
                        <ul>
                            <li><a href="#"><i class="fa fa-heart"></i> <span>1</span></a></li>
                            <li><a href="#"><i class="fa fa-shopping-bag"></i> <span>3</span></a></li>
                        </ul>
                        <div class="header__cart__price">item: <span>$150.00</span></div>
                    </div>
                </div>
            </div>
            <div class="humberger__open">
                <i class="fa fa-bars"></i>
            </div>
        </div>
    </header>
    <!-- Header Section End -->

    <!-- Hero Section Begin -->
    <section class="hero hero-normal">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="hero__categories">
                        <div class="hero__categories__all">
                            <i class="fa fa-bars"></i>
                            <span>Stores</span>
                        </div>
                        <ul>
                            <?php foreach($randomStores as $stores) : ?>
                            <li><a href="store_details.php?storeid=<?= $stores['id']; ?>"><?= $stores['storename'] ?></a></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="hero__search">
                        <div class="hero__search__form">
                            <form action="#">
                                <div class="hero__search__categories">
                                    All Categories
                                    <span class="arrow_carrot-down"></span>
                                </div>
                                <input type="text" placeholder="What do yo u need?">
                                <button type="submit" class="site-btn">SEARCH</button>
                            </form>
                        </div>
                        <div class="hero__search__phone">
                            <div class="hero__search__phone__icon">
                                <i class="fa fa-phone"></i>
                            </div>
                            <div class="hero__search__phone__text">
                                <h5>+65 11.188.888</h5>
                                <span>support 24/7 time</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Hero Section End -->

    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="img/breadcrumb.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Shopping Cart</h2>
                        <div class="breadcrumb__option">
                            <a href="./index.html">Home</a>
                            <span>Shopping Cart</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Shoping Cart Section Begin -->
    <?php if ($carts !== null && !empty($carts)): ?>
    <form action="checkout.php" method="post" id="checkoutForm">
    <section class="shoping-cart spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="shoping__cart__table">
                            <table id="cartTable">
                                <thead>
                                    <tr>
                                        <th class="shoping__product">Items</th>
                                        <th>Quantity</th>
                                        <th>Price</th>
                                        <th>Total</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($carts as $index => $cartItem): ?>
                                        <?php $itemQty = viewStockItems($cartItem['item_id']); ?>
                                        <tr>
                                            <td class="shoping__cart__item">
                                                <h5><?= $cartItem['item_name'] ?></h5>
                                            </td>
                                            <td class="shoping__cart__quantity">
                                                <div class="quantity">
                                                    <div class="pro-qty">
                                                        <input type="number" name="qty[<?= $index ?>]" min="1" max="<?= $itemQty ?>" value="<?= $cartItem['qty'] ?>" class="qty-input" data-price="<?= $cartItem['price'] ?>">
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="shoping__cart__price">
                                                <input type="hidden" name="price[<?= $index ?>]" value="<?= $cartItem['price'] ?>">
                                                <?= $cartItem['price'] ?>
                                            </td>
                                            <td class="shoping__cart__total">
                                                 <span class="total-amount"><?= $cartItem['qty'] * $cartItem['price'] ?></span>
                                            </td>
                                            <td class="shoping__cart__item__close">
                                                <input type="hidden" name="stock_id[<?= $index ?>]" value="<?= $cartItem['item_id'] ?>">
                                                <input type="hidden" name="item_id" value="<?= $cartItem['item_id'] ?>">
                                                <input type="hidden" name="user_id" value="<?= $customerID['id'] ?>">
                                                <input type="hidden" name="cart_id" value="<?= $cartId ?>">
                                                <button type="submit" name="delete_item" class="btn btn-danger" value="<?= $cartItem['item_id'] ?>">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                            <input type="hidden" name="product_id" value="<?= $cartItem['product_id'] ?>">
                            <input type="hidden" name="customer_name" value="<?= $customerID['fullname'] ?>">
                            <input type="hidden" name="total" id="hiddenTotal" value="">
                            <!-- <button type="submit" name="checkout" class="checkout-button">
                                Checkout All Items
                            </button> -->
                       
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="shoping__cart__btns">
                        <a href="#" class="primary-btn cart-btn">CONTINUE SHOPPING</a>
                        <a href="#" class="primary-btn cart-btn cart-btn-right" id="updateCartBtn">
                            <span class="icon_loading"></span> Update Cart
                        </a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="shoping__checkout">
                        <h5>Cart Total</h5>
                        <ul id="cartTotalList">
                            <li>Subtotal <span id="subtotalAmount">₱ 0.00</span></li>
                            <li>Total <span id="cartTotal">₱ 0.00</span></li>
                        </ul>
                        <button type="submit" name="submit" style="border: none; width: 100%;" class="primary-btn">PROCEED TO CHECKOUT</button>
                    </div>
                </div>
            </div>
        </div>
        </form>
    </section>
    <!-- Shoping Cart Section End -->
    <?php else : ?>
        <p>Your cart is empty</p>
    <?php endif; ?>


    <!-- Footer Section Begin -->
    <footer class="footer spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="footer__about">
                        <div class="footer__about__logo">
                            <a href="./index.html"><img src="img/logo.png" alt=""></a>
                        </div>
                        <ul>
                            <li>Address: 60-49 Road 11378 New York</li>
                            <li>Phone: +65 11.188.888</li>
                            <li>Email: hello@colorlib.com</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 offset-lg-1">
                    <div class="footer__widget">
                        <h6>Useful Links</h6>
                        <ul>
                            <li><a href="#">About Us</a></li>
                            <li><a href="#">About Our Shop</a></li>
                            <li><a href="#">Secure Shopping</a></li>
                            <li><a href="#">Delivery infomation</a></li>
                            <li><a href="#">Privacy Policy</a></li>
                            <li><a href="#">Our Sitemap</a></li>
                        </ul>
                        <ul>
                            <li><a href="#">Who We Are</a></li>
                            <li><a href="#">Our Services</a></li>
                            <li><a href="#">Projects</a></li>
                            <li><a href="#">Contact</a></li>
                            <li><a href="#">Innovation</a></li>
                            <li><a href="#">Testimonials</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12">
                    <div class="footer__widget">
                        <h6>Join Our Newsletter Now</h6>
                        <p>Get E-mail updates about our latest shop and special offers.</p>
                        <form action="#">
                            <input type="text" placeholder="Enter your mail">
                            <button type="submit" class="site-btn">Subscribe</button>
                        </form>
                        <div class="footer__widget__social">
                            <a href="#"><i class="fa fa-facebook"></i></a>
                            <a href="#"><i class="fa fa-instagram"></i></a>
                            <a href="#"><i class="fa fa-twitter"></i></a>
                            <a href="#"><i class="fa fa-pinterest"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="footer__copyright">
                        <div class="footer__copyright__text">
                            <p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                                Copyright &copy;
                                <script>document.write(new Date().getFullYear());</script> All rights reserved | This
                                template is made with <i class="fa fa-heart" aria-hidden="true"></i> by <a
                                    href="https://colorlib.com" target="_blank">Colorlib</a>
                                <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                            </p>
                        </div>
                        <div class="footer__copyright__payment"><img src="img/payment-item.png" alt=""></div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- Footer Section End -->

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Add an event listener for input changes to recalculate total
        document.querySelectorAll('.qty-input').forEach(function (input) {
            input.addEventListener('input', function () {
                updateCartItemTotal(input);
            });
        });

        // Add an event listener for the update cart button
        document.getElementById('updateCartBtn').addEventListener('click', function () {
            updateCartTotal();
        });

        // Calculate initial values when the page loads
        calculateInitialValues();

        // Add an event listener for form submission
        const form = document.getElementById('checkoutForm');
        form.addEventListener('submit', function () {
            // Update the hidden input with the total value
            const cartTotalElement = document.getElementById('cartTotal');
            const total = parseFloat(cartTotalElement.textContent.replace('₱ ', '')).toFixed(2);

            // Set the hidden input value
            document.getElementById('hiddenTotal').value = total;
        });
    });

    function updateCartItemTotal(input) {
        const price = parseFloat(input.getAttribute('data-price'));
        const quantity = parseInt(input.value);

        if (!isNaN(quantity) && quantity >= 1) {
            const totalAmount = quantity * price;
            input.closest('tr').querySelector('.total-amount').textContent = '₱ ' + totalAmount.toFixed(2);
            updateCartTotal();
        } else {
            alert('Please enter a valid quantity.');
        }
    }

    function calculateInitialValues() {
        const totalElements = document.querySelectorAll('.total-amount');
        let subtotal = 0;

        totalElements.forEach(function (element) {
            subtotal += parseFloat(element.textContent.replace('₱ ', ''));
        });

        const subtotalElement = document.getElementById('subtotalAmount');
        const cartTotalElement = document.getElementById('cartTotal');

        subtotalElement.textContent = '₱ ' + subtotal.toFixed(2);
        cartTotalElement.textContent = '₱ ' + subtotal.toFixed(2);
    }

    function updateCartTotal() {
        const totalElements = document.querySelectorAll('.total-amount');
        let subtotal = 0;

        totalElements.forEach(function (element) {
            subtotal += parseFloat(element.textContent.replace('₱ ', ''));
        });

        const subtotalElement = document.getElementById('subtotalAmount');
        const cartTotalElement = document.getElementById('cartTotal');

        subtotalElement.textContent = '₱ ' + subtotal.toFixed(2);
        cartTotalElement.textContent = '₱ ' + subtotal.toFixed(2);
    }
</script>


    <!-- Js Plugins -->
    <script src="javascript/jquery-3.3.1.min.js"></script>
    <script src="javascript/bootstrap.min.js"></script>
    <script src="javascript/jquery.nice-select.min.js"></script>
    <script src="javascript/jquery-ui.min.js"></script>
    <script src="javascript/jquery.slicknav.js"></script>
    <script src="javascript/mixitup.min.js"></script>
    <script src="javascript/owl.carousel.min.js"></script>
    <script src="javascript/main.js"></script>


</body>

</html>