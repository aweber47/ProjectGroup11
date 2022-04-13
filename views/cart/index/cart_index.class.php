<?php

/*** Author: your name*
 * Date: 4/8/2022*
 * File: cart_index.class.php*
 * Description: */
class CartIndex extends CartIndexView{
    public function display($cart){
        parent::displayHeader("Cart");

        ?>

        <div>Shopping Cart</div>
        <br><br>
        
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
                    <div id='menu-detail'>
                        <p class='product'>$Product</p>
                        <br>
                        <p class='category'>Category: $category</p>
                        <br>
                        <p>Price: $$price . "."</p>
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

            <div class="total">
                <h3 class="menu-detail">Taxes (7%) = <?php printf("$%.2f", $tax); ?></h3>
                <h3 class="menu-detail">Total = <?php printf("$%.2f", $total); ?></h3>
            </div>
        <br><br>
        <button>
            <a id="menu-list-button" href="<?= BASE_URL ?>/menu/index">Back to Menu</a>
        </button>
        <button>
            <a id="menu-list-button" href="<?= BASE_URL ?>/menu/clearCart">Checkout</a>
        </button>
        <?php

        parent::displayFooter();

    }

}