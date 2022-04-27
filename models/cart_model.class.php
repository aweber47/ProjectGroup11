<?php

class CartModel
{
    private $session;
    static private $_instance = NULL;


    public static function getCartModel()
    {
        if (self::$_instance == NULL) {
            self::$_instance = new MenuModel();
        }
        return self::$_instance;
    }

    public function addToCart($id)
    {

    }

    public function deleteFromCart($id)
    {
        $this->session['cart'] = [$id];
    }

    public function getCart()
    {
//if isset else
        $this->session['cart'] = [];
    }
}