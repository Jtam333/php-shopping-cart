<?php

session_start();

?>

<html>

<head>
    <title>PHP Test</title>
</head>

<body>
    <?php
    //"Product database"
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
    class CartItem
    {
        public string $name;
        public float $price;
        public int $quantity;
        public float $totalPrice;

        function __construct($name, $price)
        {
            $this->name = $name;
            $this->price = $price;
            $this->quantity = 1;
            $this->totalPrice = $price;
        }

        function getName()
        {
            return $this->name;
        }

        function getPrice()
        {
            return number_format($this->price, 2);
        }

        function setPrice($price)
        {
            $this->price = $price;
        }

        function getQuantity()
        {
            return $this->quantity;
        }

        function setQuantity($quantity)
        {
            $this->quantity = $quantity;
            $this->totalPrice = $this->price*$this->quantity;
        }

        function getTotalPrice()
        {
            return number_format($this->totalPrice, 2);
        }

        function setTotalPrice($price)
        {
            $this->price = $price;
        }
    }

    class Cart
    {
        public $productList = [];

        function __construct()
        {
            if (isset($_SESSION['productList'])) {
                $this->productList = $_SESSION['productList'];
            }
        }

        function addProduct($name)
        {
            global $products;

            //See if item already exists in cart. If it does, increase the quantity
            foreach ($this->productList as $item) {
                if ($item->getName() == $name) {
                    $item->setQuantity($item->getQuantity() + 1);
                    return;
                }
            }

            //Search for price in "product database
            $newItem = array_search($name, array_column($products, 'name'));
            $newItemPrice = $products[$newItem]['price'];

            //Add new product to cart
            $cartItem = new CartItem($name, $newItemPrice);
            $this->productList[] = $cartItem;

            //Update the product list in server session
            $_SESSION['productList'] = $this->productList;
        }

        function deleteProduct()
        {
            //TODO
        }

        function showCart()
        {
            if (!$this->productList) {
                echo 'There are no items in your cart.';
            } else {
                foreach ($this->productList as $item) {
                    echo "<li>Item: {$item->getName()}, Price: {$item->getPrice()}, Quantity: {$item->getQuantity()}, Total: {$item->getTotalPrice()}</li>";
                }
            };
        }
    }
    ?>

    <!-- for the products -->
    <div>
        <?php

        $myCart = new Cart();

        function showProducts($arr)
        {
            foreach ($arr as $item) {
                echo "<p>Item: {$item['name']}, Price: {$item['price']}</p>";
                echo "<button type='submit' name='add' value={$item['name']}>Add this item to cart</button>";
            }
        }

        echo "<form method='POST' action=''>";
        showProducts($products, $myCart);
        if (isset($_POST['add'])) {
            $myCart->addProduct($_POST['add']);
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