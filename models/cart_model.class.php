<?php

/*** Author: your name*
 * Date: 4/8/2022*
 * File: cart_model.class.php*
 * Description: */
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