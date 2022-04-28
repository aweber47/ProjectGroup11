<?php
/*** Author: your name*
 * Date: 4/8/2022*
 * File: cart_index.class.php*
 * Description: */

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
        // preset vars
        $cart = $_SESSION['cart'];
        $total = 0;


        if (!isset($_SESSION['cart']) || !$_SESSION['cart']) {
            echo "<h1 style='text-align: center; background-color: rgba(255, 215, 0, 0.85); padding: 40px 40px; width: 50%; margin: auto; font-size: 2.75em'>You currently have no items within your cart!</h1>";
            exit();
        } else {

            foreach ($cart as $menuItem) {
                $id = $menuItem->getId();
                $Product = $menuItem->getProduct();
                $category = $menuItem->getCategory();

                if ($category == 1) {
                    $category = $categories[1];
                }
                if ($category == 2) {
                    $category = $categories[2];
                }
                if ($category == 3) {
                    $category = $categories[3];
                }
                $price = $menuItem->getPrice();
                echo "
                    <table id='menu-detail'>
                        <tr class='detail-labels'>
                            <th>Item:</th>
                            <th>Category:</th>
                            <th>Price:</th>
                       
                        </tr>
                        <tr class='detail-info'>
                            <td>$Product</td>
                            <td>$category</td>
                            <td>$$price</td>
                       
                        </tr>    
                        <tr>
                        </tr>
                    </table>
                ";
                //   echo $price . "<br>";
                // setting a price var that holds the amount of the order.
            }
        }
        $tax = 0.07 * $total;
        $total = $total + $tax;

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