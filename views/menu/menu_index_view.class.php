<?php

/*** Author: your name*
 * Date: 4/5/2022*
 * File: menu_index_view.class.php*
 * Description: */
class MenuIndexView extends IndexView
{
    public static function displayHeader($title){
        parent::displayHeader($title)
        ?>
<!----
Script and media type, forms, suggestions and search box would go here.
-->
        <?php
    }

    public static function displayFooter()
    {
        parent::displayFooter();
    }

}