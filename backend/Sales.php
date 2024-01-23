<?php
class Sales extends Config {


    private $view;

    public function __construct(View $view) {
        $this->view = $view;
    }

    public function insertSales($stock_ids, $qtys, $prices, $product_id, $customer_name,$customer_id,$cart_id) {
        foreach ($stock_ids as $index => $stock_id) {
            
            $items = $this->view->getStockDetails($stock_id);
            $brand = $items['vendor_name'];
    
            $connection = $this->openConnection();
            $stmt = $connection->prepare("INSERT INTO `sales_tbl` (`cart_id`,`product_id`, `stocks_id`, `brand_name`, `qty`, `price`, `customer_name`,`customer_id`) VALUES (?,?,?,?,?,?,?,?)");
            $stmt->execute([$cart_id,$product_id, $stock_id, $brand, $qtys[$index], $prices[$index], $customer_name,$customer_id]);
        }
    }
    

}

?>