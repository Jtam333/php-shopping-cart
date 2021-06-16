<?php
require_once('cartItem.php');
require_once('database/productBase.php');

/**
 * Cart is a class for a shopping cart.
 */
class Cart
{
    //TODO: hash objects in cart with SplObjectStorage to allow for easy array manipulation
    public $cart = [];
    public float $totalPrice;

    function __construct()
    {
        if (isset($_SESSION['cart'])) {
            $this->cart = $_SESSION['cart'];
            $this->totalPrice = $_SESSION['totalPrice'];
        }
    }

    function getCart()
    {
        return $this->cart;
    }

    function getTotalPrice()
    {
        return $this->totalPrice;
    }

    private function updateTotalPrice()
    {
        $prices = [];
        foreach ($this->cart as $item) {
            $prices[] = $item->getTotalPrice();
        }
        $this->totalPrice = array_sum($prices);
    }

    private function storeCartInfoInSession()
    {
        $_SESSION['cart'] = $this->cart;
        $_SESSION['totalPrice'] = $this->totalPrice;
    }

    function addProduct($name)
    {
        //See if item already exists in cart. If it does, only increase the quantity.
        foreach ($this->cart as $item) {
            if ($item->getName() == $name) {
                $item->setQuantity($item->getQuantity() + 1);

                // Update cart info
                $this->updateTotalPrice();
                $this->storeCartInfoInSession();
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

        // Update cart info
        $this->updateTotalPrice();
        $this->storeCartInfoInSession();
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

        // Update cart info
        $this->updateTotalPrice();
        $this->storeCartInfoInSession();
    }
}
