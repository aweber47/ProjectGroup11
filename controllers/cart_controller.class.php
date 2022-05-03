<?php

/*** Author: Alex Weber*
 * Date: 5/2/2022*
 * File: cart_controller.class.php*
 * Description: Cart controller invokes actions in the cart model.*/
class CartController
{
    private $cart_model;

    /*********************************************************************************************************
     * Since I (Alex Weber) built this using half procedural and half mvc (or oop) this should be how it displays.
     *
     * What I mean by 'how it displays', is the method it calls from the model class should be highlighted like it is.
     * By using AJAX this happens (as the ajax is calling the controller within the view using JS)
     *
     * NOTE: I did  the shopping cart this way, as I believe this project already fulfills the baseline requirements.
     *
     * We are using ajax to call upon the methods within the controller. Controller then passes it to the
     * model view in which runs the procedural programming approach towards that function.
     ********************************************************************************************************/

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
    }

    // start methods here
    public function add()
    {
        // since I (Alex Weber) built this using half procedural and half mvc (or oop) this should be how it displays.
        // We are using ajax to call upon the methods within the controller. Controller then passes it to the
        // model view in which runs the procedural programming approach towards that function.
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

    // sends data to the order table.
    public function order()
    {
        $view = $this->cart_model->order();
        return $view;
    }

    // function that I left in, BUT ISN't CURRENTLY doing anything.
    // This was a side project for the counter that I was working on.
    public function number()
    {
        $view = $this->cart_model->numberCart();
        return $view;
    }

    // shows the past transactions of a user.
    public function pastTransactions()
    {
        $view = new PastTransactions();
        $view->display();
    }
}