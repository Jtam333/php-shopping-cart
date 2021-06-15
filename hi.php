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

        function get_name($name)
        {
            return $this->name;
        }

        function get_price()
        {
            return $this->price;
        }

        function get_quantity($quantity)
        {
            return $this->quantity;
        }

        function set_quantity()
        {
            $this->quantity;
        }
    }

    class Cart
    {
        public $productList = [];
        //$x = new Product("apple","9.99");

        function __construct()
        {
            if(isset($_SESSION['productList'])){
                $this->productList = $_SESSION['productList'];
            }
        }

        function add_product_to_list($name, $price)
        {
            console_log('hi');
            $i = new Product($name, $price);
            $this->productList[] = $i;
            $_SESSION['productList'] = $this->productList;
            echo gettype($this->productList);
            console_log('finished');
            //echo "<p>'hi'</p>";
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
                    echo "<li>Item: $item.get_name().toString(), Price: $item.get_price().toString()</li>";
                }
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
                echo "<button type='submit' name='action' value={$item['name']}>Add this item to cart</button>";
            }

            if (isset($_POST['action']) && ($_POST['action'] == $item['name'])) {
                //console_log('hi');
                //echo "<p>'hi'</p>";
                $cart->add_product_to_list($item['name'], $item['price']);
            }
        }

        echo "<form method='POST' action=''>";
        showProducts($products, $myCart);
        
        if (isset($_POST['action'])) {
            //console_log('hi');
            echo "<p>'hi'</p>";
            $myCart->add_product_to_list($_POST['action'],0);
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