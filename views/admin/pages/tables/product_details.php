<?php include($_SERVER['DOCUMENT_ROOT'].'/e-commerce/php/init.php'); ?>

<style>
    body {
        font-family: Arial, Helvetica, sans-serif;
    }
    #checkoutbtn {
        margin-top: 1rem;
    }
    .disabledbtn {
        pointer-events: none;
        opacity: 0.4;
    }
</style>

<?php $adminDetails = userDetails(); ?>

<?php

if($adminDetails['fullname'] == null) {
  header("Location: /e-commerce/signin.php");
} else if ($adminDetails['access'] == 'customer') {
  header("Location: /e-commerce/index.php");
} else if($adminDetails['fullname'] == 'seller') {
  header("Location: /e-commerce/views/seller/index.php");
} else {
  deleteStockItem();
?>

<?php $adminDetails = userDetails(); ?>
<?php $product = productDetails(); ?>
<?php $stocks = viewAllStocks(); ?>
<?php $customerName = userDetails(); ?>
<?php $inventoryArr = array(); } ?>


<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Connect Plus</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="../../assets/vendors/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="../../assets/vendors/flag-icon-css/css/flag-icon.min.css">
  <link rel="stylesheet" href="../../assets/vendors/css/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <!-- endinject -->
  <!-- Layout styles -->
  <link rel="stylesheet" href="../../assets/css/style.css">
  <!-- End layout styles -->
  <link rel="shortcut icon" href="../../assets/images/favicon.png" />
</head>

<body>
  <div class="container-scroller">
    <!-- partial:../../partials/_navbar.html -->
    <nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
        <a class="navbar-brand brand-logo" href="../../index.html"><img src="../../assets/images/logo.svg"
            alt="logo" /></a>
        <a class="navbar-brand brand-logo-mini" href="../../index.html"><img src="../../assets/images/logo-mini.svg"
            alt="logo" /></a>
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-stretch">
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
          <span class="mdi mdi-menu"></span>
        </button>
        <div class="search-field d-none d-xl-block">
          <form class="d-flex align-items-center h-100" action="#">
            <div class="input-group">
              <div class="input-group-prepend bg-transparent">
                <i class="input-group-text border-0 mdi mdi-magnify"></i>
              </div>
              <input type="text" class="form-control bg-transparent border-0" placeholder="Search products">
            </div>
          </form>
        </div>
        <ul class="navbar-nav navbar-nav-right">
          <li class="nav-item  dropdown d-none d-md-block">
            <a class="nav-link dropdown-toggle" id="reportDropdown" href="#" data-toggle="dropdown"
              aria-expanded="false"> Reports </a>
            <div class="dropdown-menu navbar-dropdown" aria-labelledby="reportDropdown">
              <a class="dropdown-item" href="#">
                <i class="mdi mdi-file-pdf mr-2"></i>PDF </a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="#">
                <i class="mdi mdi-file-excel mr-2"></i>Excel </a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="#">
                <i class="mdi mdi-file-word mr-2"></i>doc </a>
            </div>
          </li>
          <li class="nav-item  dropdown d-none d-md-block">
            <a class="nav-link dropdown-toggle" id="projectDropdown" href="#" data-toggle="dropdown"
              aria-expanded="false"> Projects </a>
            <div class="dropdown-menu navbar-dropdown" aria-labelledby="projectDropdown">
              <a class="dropdown-item" href="#">
                <i class="mdi mdi-eye-outline mr-2"></i>View Project </a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="#">
                <i class="mdi mdi-pencil-outline mr-2"></i>Edit Project </a>
            </div>
          </li>
          <li class="nav-item nav-language dropdown d-none d-md-block">
            <a class="nav-link dropdown-toggle" id="languageDropdown" href="#" data-toggle="dropdown"
              aria-expanded="false">
              <div class="nav-language-icon">
                <i class="flag-icon flag-icon-us" title="us" id="us"></i>
              </div>
              <div class="nav-language-text">
                <p class="mb-1 text-black">English</p>
              </div>
            </a>
            <div class="dropdown-menu navbar-dropdown" aria-labelledby="languageDropdown">
              <a class="dropdown-item" href="#">
                <div class="nav-language-icon mr-2">
                  <i class="flag-icon flag-icon-ae" title="ae" id="ae"></i>
                </div>
                <div class="nav-language-text">
                  <p class="mb-1 text-black">Arabic</p>
                </div>
              </a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="#">
                <div class="nav-language-icon mr-2">
                  <i class="flag-icon flag-icon-gb" title="GB" id="gb"></i>
                </div>
                <div class="nav-language-text">
                  <p class="mb-1 text-black">English</p>
                </div>
              </a>
            </div>
          </li>
          <li class="nav-item nav-profile dropdown">
            <a class="nav-link dropdown-toggle" id="profileDropdown" href="#" data-toggle="dropdown"
              aria-expanded="false">
              <div class="nav-profile-img">
                <img src="../../assets/images/faces/face28.png" alt="image">
              </div>
              <div class="nav-profile-text">
                <p class="mb-1 text-black"><?= $adminDetails['fullname'] ?></p>
              </div>
            </a>
            <div class="dropdown-menu navbar-dropdown dropdown-menu-right p-0 border-0 font-size-sm"
              aria-labelledby="profileDropdown" data-x-placement="bottom-end">
              <div class="p-3 text-center bg-primary">
                <img class="img-avatar img-avatar48 img-avatar-thumb" src="../../assets/images/faces/face28.png" alt="">
              </div>
              <div class="p-2">
                <h5 class="dropdown-header text-uppercase pl-2 text-dark">User Options</h5>
                <a class="dropdown-item py-1 d-flex align-items-center justify-content-between" href="#">
                  <span>Inbox</span>
                  <span class="p-0">
                    <span class="badge badge-primary">3</span>
                    <i class="mdi mdi-email-open-outline ml-1"></i>
                  </span>
                </a>
                <a class="dropdown-item py-1 d-flex align-items-center justify-content-between" href="#">
                  <span>Profile</span>
                  <span class="p-0">
                    <span class="badge badge-success">1</span>
                    <i class="mdi mdi-account-outline ml-1"></i>
                  </span>
                </a>
                <a class="dropdown-item py-1 d-flex align-items-center justify-content-between"
                  href="javascript:void(0)">
                  <span>Settings</span>
                  <i class="mdi mdi-settings"></i>
                </a>
                <div role="separator" class="dropdown-divider"></div>
                <h5 class="dropdown-header text-uppercase  pl-2 text-dark mt-2">Actions</h5>
                <a class="dropdown-item py-1 d-flex align-items-center justify-content-between" href="#">
                  <span>Lock Account</span>
                  <i class="mdi mdi-lock ml-1"></i>
                </a>
                <a class="dropdown-item py-1 d-flex align-items-center justify-content-between" href="/e-commerce/signout.php">
                  <span>Log Out</span>
                  <i class="mdi mdi-logout ml-1"></i>
                </a>
              </div>
            </div>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link count-indicator dropdown-toggle" id="messageDropdown" href="#" data-toggle="dropdown"
              aria-expanded="false">
              <i class="mdi mdi-email-outline"></i>
              <span class="count-symbol bg-success"></span>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list"
              aria-labelledby="messageDropdown">
              <h6 class="p-3 mb-0 bg-primary text-white py-4">Messages</h6>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                  <img src="../../assets/images/faces/face4.jpg" alt="image" class="profile-pic">
                </div>
                <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                  <h6 class="preview-subject ellipsis mb-1 font-weight-normal">Mark send you a message</h6>
                  <p class="text-gray mb-0"> 1 Minutes ago </p>
                </div>
              </a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                  <img src="../../assets/images/faces/face2.jpg" alt="image" class="profile-pic">
                </div>
                <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                  <h6 class="preview-subject ellipsis mb-1 font-weight-normal">Cregh send you a message</h6>
                  <p class="text-gray mb-0"> 15 Minutes ago </p>
                </div>
              </a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                  <img src="../../assets/images/faces/face3.jpg" alt="image" class="profile-pic">
                </div>
                <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                  <h6 class="preview-subject ellipsis mb-1 font-weight-normal">Profile picture updated</h6>
                  <p class="text-gray mb-0"> 18 Minutes ago </p>
                </div>
              </a>
              <div class="dropdown-divider"></div>
              <h6 class="p-3 mb-0 text-center">4 new messages</h6>
            </div>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#"
              data-toggle="dropdown">
              <i class="mdi mdi-bell-outline"></i>
              <span class="count-symbol bg-danger"></span>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list"
              aria-labelledby="notificationDropdown">
              <h6 class="p-3 mb-0 bg-primary text-white py-4">Notifications</h6>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                  <div class="preview-icon bg-success">
                    <i class="mdi mdi-calendar"></i>
                  </div>
                </div>
                <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                  <h6 class="preview-subject font-weight-normal mb-1">Event today</h6>
                  <p class="text-gray ellipsis mb-0"> Just a reminder that you have an event today </p>
                </div>
              </a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                  <div class="preview-icon bg-warning">
                    <i class="mdi mdi-settings"></i>
                  </div>
                </div>
                <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                  <h6 class="preview-subject font-weight-normal mb-1">Settings</h6>
                  <p class="text-gray ellipsis mb-0"> Update dashboard </p>
                </div>
              </a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                  <div class="preview-icon bg-info">
                    <i class="mdi mdi-link-variant"></i>
                  </div>
                </div>
                <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                  <h6 class="preview-subject font-weight-normal mb-1">Launch Admin</h6>
                  <p class="text-gray ellipsis mb-0"> New admin wow! </p>
                </div>
              </a>
              <div class="dropdown-divider"></div>
              <h6 class="p-3 mb-0 text-center">See all notifications</h6>
            </div>
          </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
          data-toggle="offcanvas">
          <span class="mdi mdi-menu"></span>
        </button>
      </div>
    </nav>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:../../partials/_sidebar.html -->
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item nav-category">Main</li>
          <li class="nav-item">
            <a class="nav-link" href="../../index.php">
              <span class="icon-bg"><i class="mdi mdi-cube menu-icon"></i></span>
              <span class="menu-title">Dashboard</span>
            </a>
          </li>
          <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
                <span class="icon-bg"><i class="mdi mdi-crosshairs-gps menu-icon"></i></span>
                <span class="menu-title">Manage</span>
                <i class="menu-arrow"></i>
              </a>
              <div class="collapse" id="ui-basic">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="../list/seller_accounts.php">Seller Accounts</a></li>
                  <li class="nav-item"> <a class="nav-link" href="../list/customer_accounts.php">Customer Accounts</a></li>
                  <li class="nav-item"> <a class="nav-link" href="../list/products.php">Products</a></li>
                </ul>
              </div>
            </li>
          <li class="nav-item">
                <a class="nav-link" href="../../pages/list/seller_sales.php">
                    <span class="icon-bg"><i class="mdi mdi-chart-line menu-icon"></i></span>
                    <span class="menu-title">Sales Overview</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="../../pages/forms/create_new_admin.php">
                    <span class="icon-bg"><i class="mdi mdi-account-plus menu-icon"></i></span>
                    <span class="menu-title">Create New Admin</span>
                </a>
            </li>
          <!-- <li class="nav-item">
            <a class="nav-link" href="../../pages/charts/chartjs.html">
              <span class="icon-bg"><i class="mdi mdi-chart-bar menu-icon"></i></span>
              <span class="menu-title">Charts</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../../pages/tables/basic-table.html">
              <span class="icon-bg"><i class="mdi mdi-table-large menu-icon"></i></span>
              <span class="menu-title">Tables</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
              <span class="icon-bg"><i class="mdi mdi-lock menu-icon"></i></span>
              <span class="menu-title">User Pages</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="auth">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="../../pages/samples/blank-page.html"> Blank Page </a>
                </li>
                <li class="nav-item"> <a class="nav-link" href="../../pages/samples/login.html"> Login </a></li>
                <li class="nav-item"> <a class="nav-link" href="../../pages/samples/register.html"> Register </a></li>
                <li class="nav-item"> <a class="nav-link" href="../../pages/samples/error-404.html"> 404 </a></li>
                <li class="nav-item"> <a class="nav-link" href="../../pages/samples/error-500.html"> 500 </a></li>
              </ul>
            </div>
          </li> -->
          <li class="nav-item sidebar-user-actions mt-3">
            <div class="user-details">
              <div class="d-flex justify-content-between align-items-center">
                <div>
                  <div class="d-flex align-items-center">
                    <div class="sidebar-profile-img">
                      <img src="../../assets/images/faces/face28.png" alt="image">
                    </div>
                    <div class="sidebar-profile-text">
                      <p class="mb-1"><?= $adminDetails['fullname'] ?></p>
                    </div>
                  </div>
                </div>
                <div class="badge badge-danger">3</div>
              </div>
            </div>
          </li>
          <li class="nav-item sidebar-user-actions">
            <div class="sidebar-user-menu">
              <a href="#" class="nav-link"><i class="mdi mdi-settings menu-icon"></i>
                <span class="menu-title">Settings</span>
              </a>
            </div>
          </li>
          <li class="nav-item sidebar-user-actions">
            <div class="sidebar-user-menu">
              <a href="#" class="nav-link"><i class="mdi mdi-speedometer menu-icon"></i>
                <span class="menu-title">Take Tour</span></a>
            </div>
          </li>
          <li class="nav-item sidebar-user-actions">
            <div class="sidebar-user-menu">
              <a href="/e-commerce/signout.php" class="nav-link"><i class="mdi mdi-logout menu-icon"></i>
                <span class="menu-title">Log Out</span></a>
            </div>
          </li>
        </ul>
      </nav>
      <!-- partial -->
      <div class="main-panel">
    <div class="content-wrapper">

        <!-- Product Details Section -->
        <div class="jumbotron text-dark">
            <div class="container">
                <h1 class="display-4"><?= $product['productDetails']['product_name']; ?></h1>
                <p class="lead">Category: <?= $product['productDetails']['product_type']; ?></p>
                <hr class="my-4">
                <p><strong>Minimum Stock:</strong> <?= $product['productDetails']['min_stock']; ?></p>
            </div>
        </div>

        <!-- Sales Table Section -->
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Sales Table</h4>
                        <p class="card-description"> Items <code></code> </p>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>Item name</th>
                                        <th>Base Stock Qty</th>
                                        <th>SRP</th>
                                        <th>Sales Qty</th>
                                        <th>Total Sales</th>
                                        <th>Qty Remaining</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($stocks as $stock): ?>
                                        <?php $sum = $stock['qty'] - $stock['sale_qty']; ?>
                                        <?php $inventoryArr[] = $sum; ?>
                                        <tr class="<?= ($sum == 0) ? 'disabledbtn' : 'Available'; ?>">
                                            <td>
                                                <div id="parent_<?= $stock['id']; ?>">
                                                    <a href="product_details.php?id=<?= $stock['id']; ?>" class="text-dark">
                                                        <?= $stock['vendor_name']; ?>
                                                    </a>
                                                </div>
                                            </td>
                                            <td><?= $stock['qty']; ?></td>
                                            <td><?= sprintf('%01.2f', $stock['price']); ?></td>
                                            <td><?= $stock['sale_qty']; ?></td>
                                            <td><?= sprintf('%01.2f', $stock['TotalSales']); ?></td>
                                            <td><?= $stock['qty']; ?></td>
                                            <td><?= ($stock['qty'] == 0) ? 'Out of Stock' : 'Available'; ?></td>
                                            <td>
                                            <form action="" method="post">
                                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal_<?= $stock['id']; ?>">
                                                    Delete
                                                </button>
                                            </form>
                                            </td>
                                        </tr>
                                        <!-- Delete Confirmation Modal for each item -->
                                        <div class="modal fade" id="deleteModal_<?= $stock['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                          <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                              <div class="modal-header">
                                                <h5 class="modal-title" id="deleteModalLabel">Confirmation</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                  <span aria-hidden="true">&times;</span>
                                                </button>
                                              </div>
                                              <div class="modal-body">
                                                Are you sure you want to delete this item?
                                              </div>
                                              <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                <form action="" method="post">
                                                  <input type="hidden" name="stock_id" value="<?= $stock['id'] ?>">
                                                  <button type="submit" class="btn btn-danger" name="delete_item">Delete</button>
                                                </form>
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>

                        <div class="row mt-4">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">Inventory Summary</h5>
                                        <ul class="list-group">
                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                Total
                                                <span class="badge badge-primary badge-pill"><?= $product['totalQuantity']['total']; ?></span>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                Actual Inventory
                                                <span class="badge badge-secondary badge-pill"><?= array_sum($inventoryArr); ?></span>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                Status
                                                <span class="badge badge-info badge-pill">
                                                    <?php
                                                    if (array_sum($inventoryArr) <= $product['productDetails']['min_stock'] && array_sum($inventoryArr) != 0) {
                                                        echo "Low Inventory";
                                                    } elseif (array_sum($inventoryArr) == 0) {
                                                        echo "Out of Stocks";
                                                    } else {
                                                        echo "On Sale";
                                                    }
                                                    ?>
                                                </span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


        <!-- content-wrapper ends -->
        <!-- partial:../../partials/_footer.html -->
        <footer class="footer">
          <div class="footer-inner-wraper">
            <div class="d-sm-flex justify-content-center justify-content-sm-between">
              <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © bootstrapdash.com
                2020</span>
              <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center"> Free <a
                  href="https://www.bootstrapdash.com/" target="_blank">Bootstrap dashboard templates</a> from
                Bootstrapdash.com</span>
            </div>
          </div>
        </footer>
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- plugins:js -->
  <script src="../../assets/vendors/js/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page -->
  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="../../assets/js/off-canvas.js"></script>
  <script src="../../assets/js/hoverable-collapse.js"></script>
  <script src="../../assets/js/misc.js"></script>
  <!-- endinject -->
  <!-- Custom js for this page -->
  <!-- End custom js for this page -->
</body>

</html>