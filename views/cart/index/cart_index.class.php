<?php

/*** Author: your name*
 * Date: 4/8/2022*
 * File: cart_index.class.php*
 * Description: */
class CartIndex extends CartIndexView{
    public function display($cart){
        parent::displayHeader("Cart");

        ?>

        <!--<div>Shopping Cart</div>-->
        <br><br><br><br><br>
        
        <?php
        // preset vars
        $order = $_SESSION['cart'];
        $total = 0;

        if (!isset($_SESSION['cart']) || !$_SESSION['cart']) {
            echo "You currently have no items within your cart<br><br>";
            exit();
        } else {
            foreach ($cart as $menuItem) {
                $Product = $menuItem->getProduct();
                $category = $menuItem->getCategory();
                $price = $menuItem->getPrice();
                echo "
                    <div id='menu-detail' style='width: 50%'>
                        <table>
                            <tr class='detail-labels'>
                                <th>$Product</th>
                                <th>Category:</th>
                                <th>Price:</th>
                            </tr>
                            <tr class='detail-info'>
                                <td><br></td>
                                <td>$category</td>
                                <td>$$price</td>
                            </tr>
                        </table>
                    </div>
                ";
             //   echo $price . "<br>";
                // setting a price var that holds the amount of the order.
            }
           $total = $price++;
        }
        $tax = 0.07 * $total;
        $total = $total + $tax;
        ?>

        <div id="total">
            <h3 class="menu-detail">Taxes (7%) = <?php printf("$%.2f", $tax); ?></h3>
            <h3 class="menu-detail">Total = <?php printf("$%.2f", $total); ?></h3>
        </div>
        
        <div id="button-group">
            <input class="detail-buttons" type="button" id="return-button" value="Return to Menu" onclick="window.location.href='<?= BASE_URL ?>/menu/index'">

            <input class="detail-buttons" type="button" id="checkout-button" value="Checkout" onclick="window.location.href='<?= BASE_URL ?>/menu/clearCart'">
        </div>
        <!--<button>
            <a id="menu-list-button" href="<?= BASE_URL ?>/menu/index">Back to Menu</a>
        </button>
        <button>
            <a id="menu-list-button" href="<?= BASE_URL ?>/menu/clearCart">Checkout</a>
        </button>-->
        <?php

        parent::displayFooter();

    }

}