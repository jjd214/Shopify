<?php include($_SERVER['DOCUMENT_ROOT'].'/e-commerce/php/init.php'); ?>

<?php include($_SERVER['DOCUMENT_ROOT'].'/e-commerce/partials/__header.php'); ?>

<?php $sellerId = userDetails(); ?>
<?php businessSettings(); ?>

<h1>Manange Account Settings</h1>

<form action="" method="post" enctype="multipart/form-data">

<label>Business Image</label>
<input type="file" name="image">

<input type="text" name="store_name" placeholder="Store name">

<input type="text" name="fname" placeholder="First Name">
<input type="text" name="lname" placeholder="Last Name">
<input type="text" name="mname" placeholder="Middle Name">
<input type="email" name="email" placeholder="Email">

<label>Business Description</label>
<textarea name="description" id="" cols="30" rows="10" placeholder="Description"></textarea>

<input type="hidden" name="id" value="<?= $sellerId['id'] ?>">
<input type="submit" name="submit" value="submit">

</form>
<?php include($_SERVER['DOCUMENT_ROOT'].'/e-commerce/partials/__footer.php'); ?>