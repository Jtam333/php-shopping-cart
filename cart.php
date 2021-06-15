<?php
class Cart
    {
        public $cart = [];

        function __construct()
        {
            if (isset($_SESSION['cart'])) {
                $this->cart = $_SESSION['cart'];
            }
        }

        function addProduct($name)
        {
            global $products;

            //See if item already exists in cart. If it does, increase the quantity
            foreach ($this->cart as $item) {
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
            $this->cart[] = $cartItem;

            //Update the product list in server session
            $_SESSION['cart'] = $this->cart;
        }

        function deleteProduct()
        {
            //TODO
        }

        function showCart()
        {
            if (!$this->cart) {
                echo 'There are no items in your cart.';
            } else {
                foreach ($this->cart as $item) {
                    echo "<li>Item: {$item->getName()}, Price: {$item->getPrice()}, Quantity: {$item->getQuantity()}, Total: {$item->getTotalPrice()}</li>";
                }
            };
        }
    }
?>
