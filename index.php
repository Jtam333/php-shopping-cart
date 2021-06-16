<?php

declare(strict_types=1);

require_once('classes/cart.php');
require_once('database/productBase.php');

session_start();
?>

<html>

<head>
    <title>PHP Test</title>
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
</head>

<body>
    <div class='grid grid-cols-2 gap-5 p-10 divide-x divide-black'>
        <!-- for the products -->
        <div>
            <?php
            $myCart = new Cart();
            $productList = getProducts();


            echo "<form method='POST' action=''>";
            echo "<div class='grid'>";
            foreach ($productList as $item) {
                echo "<div class='border border-blue-400 rounded relative p-5 my-3'>";
                echo "<p>Item: {$item['name']}</p>";
                echo '<p>Price: $' . number_format($item['price'], 2) . '</p>';
                echo "<button class= 'border absolute bottom-2 right-2 bg-green-300 p-2 rounded-lg ring-green-500 ring-opacity-50' type='submit' name='add' value={$item['name']}>Add this item to cart</button>";
                echo "</div>";
            }
            echo "</form>";
            echo "</div>";

            if (isset($_POST['add'])) {
                $myCart->addProduct($_POST['add']);
                //POST redirect GET pattern, prevents duplicate form submissions
                //https://stackoverflow.com/questions/4142809/simple-php-post-redirect-get-code-example
                header("Location: {$_SERVER['REQUEST_URI']}", true, 303);
                exit();
            }
            ?>

        </div>

        <!-- for the cart -->
        <div class='relative gap-5 p-5 divide-y divide-black'>
            <?php
            echo "<form method='POST' action=''>";
            echo "<div class='divide-y divide-black'>";
            $cartList = $myCart->getCart();
            if (!$cartList) {
                echo 'There are no items in your cart.';
            } else {
                foreach ($cartList as $item) {
                    echo "<div class='relative'>";
                    echo "<div class='relative py-3'>";
                    echo "<p>Item: {$item->getName()}</p>";
                    echo '<p>Price: $' . number_format($item->getPrice(), 2) . '</p>';
                    echo "<p>Quantity: {$item->getQuantity()}</p>";
                    echo "<p class='text-right'>Total: $" . number_format($item->getTotalPrice(), 2) . '</p>';
                    echo "</div>";
                    echo "<button class='absolute right-2 top-5 center border border-black rounded-full px-2' type='submit' name='delete' value={$item->getname()}>x</button>";
                    echo "</div>";
                }
                echo "<p class='text-3x1 font-bold absolute right-2'>Subtotal: $" . number_format($myCart->getTotalPrice(), 2) . '</p>';
            };
            echo "</div>";
            echo "</form>";


            //$_POST['delete'] holds the value of the item's name, from the button.
            if (isset($_POST['delete'])) {
                $myCart->deleteProduct($_POST['delete']);
                //POST redirect GET pattern, prevents duplicate form submissions
                //https://stackoverflow.com/questions/4142809/simple-php-post-redirect-get-code-example
                header("Location: {$_SERVER['REQUEST_URI']}", true, 303);
                exit();
            }
            ?>
        </div>
    </div>
</body>

</html>