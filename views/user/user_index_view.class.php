<?php

/*** Author: Alex Weber & James Ritter*
 * Date: 4/7/2022*
 * File: user_index_view.class.php*
 * Description: Default View for the userIndexView. Displays the header and footer and defines the media type for the user views. */
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