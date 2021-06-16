<?php
declare(strict_types=1);

require_once('cart.php');

session_start();
?>

<html>

<head>
    <title>PHP Test</title>
    <!-- <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet"> -->
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
            //POST redirect GET pattern, prevents duplicate form submissions
            //https://stackoverflow.com/questions/4142809/simple-php-post-redirect-get-code-example
            header("Location: {$_SERVER['REQUEST_URI']}", true, 303);
            exit();
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