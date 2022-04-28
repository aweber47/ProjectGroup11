<?php

/*** Author: Alex Weber and James Ritter*
 * Date: 4/5/2022*
 * File: user_error.class.php*
 * Description: Displays an error for the user. The error handling and exception handling utilizes this view.*/
class UserError extends UserIndexView
{
    public function display($message)
    {
        // header
        parent::displayHeader("Error");
        ?>
        <br><br><br><br>
        <div class="menu-error-msg">
            <h1>An Error has Occurred.</h1>
            <h3><?= urldecode($message) ?></h3>
        </div>

        <br><br>
        <div id="button-group">
            <input class="edit-buttons" type="button" value=" Retry Login  "
                   onclick="window.location.href='<?= BASE_URL ?>/user/login'">
            <input class="edit-buttons" type="button" value="  Register  "
                   onclick="window.location.href='<?= BASE_URL ?>/user/register'">
        </div>
        <br><br>

        <?php
        //display page footer
        parent::displayFooter();
    }

}