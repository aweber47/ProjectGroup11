<?php
/*** Author: Alex Weber and James Ritter*
 * Date: 4/8/2022*
 * File: cart_index.class.php*
 * Description: Displays all information about the cart and holds the main cart information. */

class CartIndex extends CartIndexView
{
    public function display($cart)
    {
        parent::displayHeader("Cart");

        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        //get categories from a session variable
        if (isset($_SESSION['categories'])) {
            $categories = $_SESSION['categories'];
        }

        ?>

        <!--<div>Shopping Cart</div>-->
        <br><br><br><br><br>
        <?php


        ?>

        <!--Total of cart-->
        <!--<div id="total">
            <h3 class="menu-detail">Taxes (7%) = <?php printf("$%.2f", $tax); ?></h3>
            <h3 class="menu-detail">Total = <?php printf("$%.2f", $total); ?></h3>
        </div>-->

        <div id="button-group">
            <input class="detail-buttons" type="button" id="return-button" value="Return to Menu"
                   onclick="window.location.href='<?= BASE_URL ?>/menu/index'">

            <input class="detail-buttons" type="button" id="delete-from-button" value="Empty Cart"
                   onclick="window.location.href='<?= BASE_URL ?>/menu/deleteFromCart/<?= $id ?>'">

            <input class="detail-buttons" type="button" id="checkout-button" value="Checkout"
                   onclick="window.location.href='<?= BASE_URL ?>/menu/clearCart'">
        </div>
        <?php

        parent::displayFooter();
    }
}