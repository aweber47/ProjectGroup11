<?php

/*** Author: your name*
 * Date: 4/5/2022*
 * File: menu_error.class.php*
 * Description: */
class MenuUnauthorizedError extends MenuIndexView
{
    public function display($message)
    {
        // header
        parent::displayHeader("ALERT: UNAUTHORIZED ACCESS");
        ?>
        <!--<div id="main-header">Error</div>-->
        <div class="menu-error-msg">
            <h1>Sorry, but...</h1>
            <h3><?= urldecode($message) ?></h3>
        </div>
        <div id="button-group">
            <input class="edit-buttons" type="button" value=" BACK TO HOME "
                   onclick="window.location.href='<?= BASE_URL ?>'">
        </div>
        <br><br>

        <?php
        //display page footer
        parent::displayFooter();
    }

}