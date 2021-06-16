<?php
require_once('cartItem.php');
require_once('productBase.php');

/**
 * Cart is a class for a shopping cart.
 */
class Cart
{
    //TODO: hash objects in cart with SplObjectStorage to allow for easy array manipulation
    public $cart = [];

    function __construct()
    {
        if (isset($_SESSION['cart'])) {
            $this->cart = $_SESSION['cart'];
        }
    }

    function getCart()
    {
        return $this->cart;
    }

    function addProduct($name)
    {
        //See if item already exists in cart. If it does, only increase the quantity.
        foreach ($this->cart as $item) {
            if ($item->getName() == $name) {
                $item->setQuantity($item->getQuantity() + 1);
                return;
            }
        }

        //If the item doesn't exist in the cart, add it.
        //Search for price of item in "product database"
        $productList = getProducts();
        $key = array_search($name, array_column($productList, 'name'));
        $newItemPrice = $productList[$key]['price'];

        //Add new product to cart
        $cartItem = new CartItem($name, $newItemPrice);
        $this->cart[] = $cartItem;

        //Update the product list in server session
        $_SESSION['cart'] = $this->cart;
    }

    function deleteProduct($name)
    {
        // Loop through the list to find the item to remove, then remove it.
        foreach ($this->cart as $item) {
            if ($item->getName() == $name) {
                $key = array_search($item, $this->cart);
                unset($this->cart[$key]);
                break;
            }
        }

        //Update the product list in server session
        $_SESSION['cart'] = $this->cart;
    }
}
