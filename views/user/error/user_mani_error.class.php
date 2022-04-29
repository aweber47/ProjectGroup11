<?php

/*** Author: Alex Weber and James Ritter*
 * Date: 4/5/2022*
 * File: user_error.class.php*
 * Description: Displays an error for the user. The error handling and exception handling utilizes this view.*/
class UserManiError extends UserIndexView
{
    public function display($message)
    {
        ?>
        <br><br><br><br>
        <div class="menu-error-msg">
            <h1>WARNING WARNING WARNING WARNING WARNING WARNING WARNING WARNING WARNING</h1>
            <h3><?= urldecode($message) ?></h3>
        </div>

        <br><br>
        <div id="button-group">
            <input class="edit-buttons" type="button" value=" Homepage  "
                   onclick="window.location.href='<?= BASE_URL ?>/menu/index'">
            <input class="edit-buttons" type="button" value="  Login  "
                   onclick="window.location.href='<?= BASE_URL ?>/user/login'">
        </div>
        <br><br>

        <?php
        //display page footer
        parent::displayFooter();
    }

}