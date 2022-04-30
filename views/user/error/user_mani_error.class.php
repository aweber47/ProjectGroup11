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
        <?php
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        if (isset($_SESSION['user_id'])) {
            $Adminid = $_SESSION['user_id'];
            $result = TRUE;
        } else {
            $Adminid = NULL;
            $result = FALSE;
        }

        ?>
        <br><br><br><br>
        <div class="menu-error-msg">
            <h1>WARNING WARNING WARNING WARNING WARNING WARNING WARNING WARNING WARNING</h1>
            <h3><?= urldecode($message) ?></h3>
        </div>

        <br><br>
        <div id="button-group">
            <?php if ($result == FALSE) { ?>
                <input class="edit-buttons" type="button" value=" BACK TO DELETE "
                       onclick="window.location.href='<?= BASE_URL ?>/user/deleteDisplay/<?= $Adminid ?>'">

            <?php } ?>
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