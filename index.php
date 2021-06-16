<?php

declare(strict_types=1);

require_once('cart.php');
require_once('productBase.php');

session_start();
?>

<html>

<head>
    <title>PHP Test</title>
    <!-- <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet"> -->
</head>

<body>


    <!-- for the products -->
    <div>
        <?php
        $myCart = new Cart();
        $productList = getProducts();


        echo "<form method='POST' action=''>";
        foreach ($productList as $item) {
            echo "<p>Item: {$item['name']}, Price: {$item['price']}</p>";
            echo "<button type='submit' name='add' value={$item['name']}>Add this item to cart</button>";
        }
        echo "</form>";

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
    <div>
        <?php
        $myCart->showCart();
        ?>
    </div>
</body>

</html>