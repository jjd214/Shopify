<?php include($_SERVER['DOCUMENT_ROOT'].'/e-commerce/php/init.php'); ?>

<?php include($_SERVER['DOCUMENT_ROOT'].'/e-commerce/partials/__header.php'); ?>

<?php addNewProduct(); ?>

<form action="" method="post">
    <label for="">Product Name</label>
    <input type="text" name="product_name" placeholder="Enter Product Name" required />

    <label for="">Product Type</label>
    <select name="product_type" id="product_type">
        <option value="">---</option>
        <option value="Food">Food</option>
        <option value="Clothing">Clothing</option>
        <option value="Tools">Tools</option>
    </select>

    <label for="">Description</label>
    <input type="text" name="description" placeholder="Enter short description" required />

    <label for="">Minimum Stock</label>
    <input type="number" name="min_stock" min="1" required />

    <input type="submit" name="submit" value="Add Product">
</form>

<?php include($_SERVER['DOCUMENT_ROOT'].'/e-commerce/partials/__footer.php'); ?>
