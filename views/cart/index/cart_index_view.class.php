<?php
/*** Author: Alex Weber*
 * Date: 4/8/2022*
 * File: cart_index_view.class.php*
 * Description: CartIndexView just displays the header and footer of the main pages.*/

class CartIndexView extends IndexView
{

    public static function displayHeader($title)
    {
        parent::displayHeader($title);
    }

    public static function displayFooter()
    {
        parent::displayFooter();
    }

}