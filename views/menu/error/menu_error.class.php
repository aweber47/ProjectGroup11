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
        <div class="menu-error-msg">
            <h1>Sorry, but an error has occurred.</h1>
            <h3><?= urldecode($message) ?></h3>
        </div>
        <div id="button-group">
        <input class="edit-buttons" type="button" value=" Retry Entry " onclick="window.location.href='<?= BASE_URL ?>/menu/addDisplay'">
        </div>
        <br><br>
        
        <?php
        //display page footer
        parent::displayFooter();
    }

}