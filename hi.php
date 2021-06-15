<?php

session_start();

?>

<html>

<head>
    <title>PHP Test</title>
</head>

<body>
    <?php
    $products = [
        ["name" => "Sledgehammer", "price" => 125.75],
        ["name" => "Axe",          "price" => 190.50],
        ["name" => "Bandsaw",      "price" => 562.131],
        ["name" => "Chisel",       "price" => 12.9],
        ["name" => "Hacksaw",      "price" => 18.45],
    ];

    function console_log($output, $with_script_tags = true)
    {
        $js_code = 'console.log(' . json_encode($output, JSON_HEX_TAG) .
            ');';
        if ($with_script_tags) {
            $js_code = '<script>' . $js_code . '</script>';
        }
        echo $js_code;
    }

    ?>

    <?php
    class Product
    {
        public string $name;
        public float $price;
        public int $quantity;

        function __construct($name, $price)
        {
            $this->name = $name;
            $this->price = $price;
        }

        function get_name()
        {
            return $this->name;
        }

        function get_price()
        {
            return $this->price;
        }

        function get_quantity()
        {
            return $this->quantity;
        }

        function set_quantity($quantity)
        {
            $this->quantity = $quantity;
        }
    }

    class Cart
    {
        public $productList = [];

        function __construct()
        {
            if(isset($_SESSION['productList'])){
                $this->productList = $_SESSION['productList'];
            }
        }

        function add_product_to_list($name, $price)
        {
            foreach($this->productList as $item){
                if ($item->get_name() == $name){
                    $item->set_quantity($item->get_quantity() + 1);
                    return;
                }
            }
            $i = new Product($name, $price);
            $i->set_quantity(1);
            $this->productList[] = $i;
            $_SESSION['productList'] = $this->productList;
            //echo gettype($this->productList);
            console_log('finished');
            echo "<script>window.location.href='hi.php'</script>";
        }

        function delete_product_from_list()
        {
            //TODO
        }

        function showCart()
        {
            if (!$this->productList) {
                echo 'There are no items in your cart.';
            } else {
                foreach ($this->productList as $item) {
                    echo "<li>Item: {$item->get_name()}, Price: {$item->get_price()}, Quantity: {$item->get_quantity()}</li>";
                }
                //console_log('showing');
            };
        }
    }
    ?>

    <!-- for the products -->
    <div>
        <?php

        $myCart = new Cart();

        function showProducts($arr, $cart)
        {
            foreach ($arr as $item) {
                echo "<p>Item: {$item['name']}, Price: {$item['price']}</p>";
                echo "<a href='?name={$item['name']}&price={$item['price']}'>Add this item to cart</a>";
                //echo "<button type='submit' name='action' value={$item['name']}>Add this item to cart</button>";
            }

            if (isset($_POST['action']) && ($_POST['action'] == $item['name'])) {
                //console_log('hi');
                //echo "<p>'hi'</p>";
                $cart->add_product_to_list($item['name'], $item['price']);
            }
        }

        echo "<form method='POST' action=''>";
        showProducts($products, $myCart);
        
        if (isset($_GET['name'])) {
            //console_log('hi');
            echo "<p>'hi'</p>";
            $myCart->add_product_to_list($_GET['name'],$_GET['price']);
        }
        echo "</form>";

        ?>

    </div>

    <!-- for the cart -->
    <div>
        <?php
        $myCart->showCart();
        ?>
    </div>
</body>

</html>