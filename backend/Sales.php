<?php
class Sales extends Config {


    private $view;

    public function __construct(View $view) {
        $this->view = $view;
    }

    public function insertSales($stock_id, $qty, $price, $product_id, $customername) {
        $items = $this->view->getStockDetails($stock_id);

        $brand = $items['vendor_name'];

        $connection = $this->openConnection();
        $stmt = $connection->prepare("INSERT INTO `sales_tbl` (`product_id`, `stocks_id`, `brand_name`, `qty`, `price`, `customer_name`) VALUES (?,?,?,?,?,?)");
        $stmt->execute([$product_id,$stock_id, $brand, $qty, $price, $customername]);

    }

}

?>