<?php

/*** Author: your name*
 * Date: 4/5/2022*
 * File: user_error.class.php*
 * Description: */
class UserError extends UserIndexView
{
    public function display($message)
    {
        // header
        parent::displayHeader("Error");
        ?>
        <!--<div id="main-header">Error</div>-->
        <br><br><br><br>
        <div class="menu-error-msg">
            <h1>An Error has Occurred.</h1>
            <h3><?= urldecode($message) ?></h3>
        </div>

        <br><br>

        <input class="return-button" type="button" value="Return to Register Form"
               onclick="window.location.href='<?= BASE_URL ?>/user/register'">
        <br><br>

        <?php
        //display page footer
        parent::displayFooter();
    }

}