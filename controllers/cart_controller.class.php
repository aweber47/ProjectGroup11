<?php

/*** Author: Alex Weber*
 * Date: 5/2/2022*
 * File: cart_controller.class.php*
 * Description: Cart controller invokes actions in the cart model.*/
class CartController
{
    private $cart_model;

    //construct
    public function __construct()
    {
        // create an instance of the MenuModel class
        $this->cart_model = CartModel::getCartModel();

        // verify that a session has been started
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        // verify if the user logging in is an admin user
        if (!isset($_SESSION['user'])) {
            $_SESSION['user'] = false;
        }
    }

    public function index()
    {
        $view = $this->cart_model->view_cart();
        return $view;
    }

    public function cart()
    {


        $view = new CartView();
        $view->display();
        if (!$view) {
            echo "didn't work";
        }
    }

    // start methods here
    public function add()
    {
        $view = $this->cart_model->add_cart();
        return $view;
    }

    // removes an item from the cart
    public function remove()
    {
        $remove = $this->cart_model->remove();
        return $remove;
    }

    // empty cart
    public function emptyCart()
    {
        $view = $this->cart_model->empty_cart();
        return $view;
    }

    //checkout page
    public function CartCheckout()
    {
        $view = new CartCheckout();
        $view->display();
    }

    public function order()
    {
        $view = $this->cart_model->order();
        return $view;
    }

    public function number()
    {
        $view = $this->cart_model->numberCart();
        return $view;
    }

    public function pastTransactions(){
        $view = new PastTransactions();
        $view->display();

    }
}