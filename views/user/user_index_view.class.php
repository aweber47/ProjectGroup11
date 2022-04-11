<?php

/*** Author: your name*
 * Date: 4/7/2022*
 * File: user_index_view.class.php*
 * Description: */
class UserIndexView extends IndexView
{

    public static function displayHeader($title)
    {
        parent::displayHeader($title)
        ?>
        <script>
            //the media type
            var media = "users";
        </script>
        <?php
    }

    public static function displayFooter()
    {
        parent::displayFooter();
    }
}