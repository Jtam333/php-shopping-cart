<?php

/**
 * CartItem is a class for modelling each unique product in the cart.
 */
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
            return $this->price;
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
            $this->totalPrice = $this->price * $this->quantity;
        }

        function getTotalPrice()
        {
            return $this->totalPrice;
        }

        function setTotalPrice($price)
        {
            $this->price = $price;
        }
    }
