<?php

/*** Author: your name*
 * Date: 4/11/2022*
 * File: cart_checkout.class.php*
 * Description: */
class CartCheckout extends CartIndexView
{
    public function display($cart){
        parent::displayHeader("Checkout Page");

        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $_SESSION['cart'] = '';

        ?>
        <div>
            <h2>Confirmation</h2>
            <h3>Order Placed</h3>
            <img src="https://img.icons8.com/ios-filled/100/000000/clock--v2.gif"/>
            <h3>Will be ready in 20 minutes.</h3>
        </div>
        <div id="button-group">
            <input class="edit-buttons" type="button" id="return-button" value="Return to Menu" onclick='window.location.href = "<?= BASE_URL . "/menu/index/" ?>"'>
            <input class="edit-buttons" type='button' value='Logout' onclick='window.location.href = "<?= BASE_URL . "/user/logout/" ?>"'>
        </div>
        <?php
        //unset all the session variables
        $_SESSION = array();

        //delete the session cookie
        setcookie(session_name(), "", time() - 3600);

        //destroy the session
        session_destroy();
        ?>
        <?php
    }
}