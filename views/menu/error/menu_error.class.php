<?php

/*** Author: your name*
 * Date: 4/5/2022*
 * File: menu_error.class.php*
 * Description: */
class MenuError extends MenuIndexView
{
    public function display($message)
    {
        // header
        parent::displayHeader("Error");
        ?>
        <!--<div id="main-header">Error</div>-->
        <hr>
        <div class="menu-error-msg">
            <h1>Sorry, but an error has occurred.</h1>
            <h3><?= urldecode($message) ?></h3>
        </div>
        <hr>
        <input class="return-button" type="button" value="Return to List" onclick="window.location.href='<?= BASE_URL ?>/menu/index'">
        <br><br>
        <?php
        //display page footer
        parent::displayFooter();
    }

}