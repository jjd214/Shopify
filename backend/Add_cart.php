<?php
class Add_cart extends Config {

    public function addToMyCart() {

        if(isset($_POST['add_cart'])) {
    
            $userid = $_POST['customer_id'];
            $itemid = $_POST['item_id'];
            $productid = $_POST['product_id'];
            $itemName = $_POST['item_name'];
            $qty = $_POST['qty'];
            $price = $_POST['price'];
    
            $connection = $this->openConnection();
    
            // Check if the item already exists in the cart
            $stmtCheck = $connection->prepare("SELECT * FROM `cart_tbl` WHERE `user_id` = ? AND `item_id` = ?");
            $stmtCheck->execute([$userid, $itemid]);
            $existingItem = $stmtCheck->fetch(PDO::FETCH_ASSOC);
    
            if ($existingItem) {
                // Item exists, update the quantity
                $stmtUpdate = $connection->prepare("UPDATE `cart_tbl` SET `qty` = `qty` + ? WHERE `user_id` = ? AND `item_id` = ?");
                $stmtUpdate->execute([$qty, $userid, $itemid]);
                $result = $stmtUpdate->rowCount();
            } else {
                // Item does not exist, insert a new row
                $stmtInsert = $connection->prepare("INSERT INTO `cart_tbl` (`user_id`, `item_id`, `product_id`,  `item_name`, `qty`, `price`) VALUES (?, ?, ?, ?, ?, ?)");
                $stmtInsert->execute([$userid, $itemid, $productid, $itemName, $qty, $price]);
                $result = $stmtInsert->rowCount();
            }
    
            if($result > 0) {
                echo "Item added to cart, and quantity updated in cart_tbl.";
            } else {
                echo "Item not added to cart or there was an issue updating quantity in cart_tbl.";
            }
        }
    }

    public function addToCart($customer_id,$item_id,$product_id,$item_name,$price) {

            $connection = $this->openConnection();
    
            // Check if the item already exists in the cart
            $stmtCheck = $connection->prepare("SELECT * FROM `cart_tbl` WHERE `user_id` = ? AND `item_id` = ?");
            $stmtCheck->execute([$customer_id, $item_id]);
            $existingItem = $stmtCheck->fetch(PDO::FETCH_ASSOC);
    
            if ($existingItem) {
                $result = 1;
                echo '<script>alert("Item already added")</script>';
            } else {
                // Item does not exist, insert a new row
                $stmtInsert = $connection->prepare("INSERT INTO `cart_tbl` (`user_id`, `item_id`, `product_id`,  `item_name`, `price`) VALUES (?, ?, ?, ?, ?)");
                $stmtInsert->execute([$customer_id,$item_id,$product_id,$item_name,$price]);
                $result = $stmtInsert->rowCount();
            }
    
            if($result > 0) {
                echo "Item added to cart, and quantity updated in cart_tbl.";
            } else {
                echo "Item not added to cart or there was an issue updating quantity in cart_tbl.";
            }
    }

    public function deleteCartItem() {

        if(isset($_POST['delete_item'])) {

            $itemid = $_POST['item_id'];

            $connection = $this->openConnection();
            $stmt = $connection->prepare("DELETE FROM `cart_tbl` WHERE `item_id` = ?");
            $stmt->execute([$itemid]);

            header("Refresh: 0");
        }

    }

    public function deductQtyItem($qty, $itemid) {
        $connection = $this->openConnection();
    
        // Check if $qty is an array, and if so, use the first element
        if (is_array($qty)) {
            $qty = reset($qty);
        }
    
        $stmtDeduct = $connection->prepare("UPDATE `productItems_tbl` SET `qty` = `qty` - ? WHERE `id` = ?");
        $stmtDeduct->execute([$qty, $itemid]);
    
        // Check if the update was successful
        $rowsAffected = $stmtDeduct->rowCount();
        if ($rowsAffected <= 0) {
            echo "Error updating quantity in stock_tbl.";
            return; // Exit the function if the update fails
        }
    }

    public function deleteItem($itemid) {
        $connection = $this->openConnection();
        $stmt = $connection->prepare("DELETE FROM `cart_tbl` WHERE `item_id` = ?");
        $stmt->execute([$itemid]);
    }
}

?>