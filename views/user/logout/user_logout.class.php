<?php

/*** Author: your name*
 * Date: 4/8/2022*
 * File: user_logout.class.php*
 * Description: */
class UserLogout extends UserIndexView
{
    //put your code here
    public function display()
    {
        parent::displayHeader("Logout");

        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $_SESSION = array();
        setcookie(session_name(), "", time() - 3600);
        session_destroy();

        ?>
        <br><h2 style="color: goldenrod">Logged Out</h2>
        <p><span  style="background: linear-gradient(to right, #ef5350, #f48fb1, #7e57c2, #2196f3, #26c6da, #43a047, #eeff41, #f9a825, #ff5722)" class="logout">Thank you for your visit...</span></p>
        <input type="button" value="Homepage" onclick='window.location.href = "<?= BASE_URL . "/welcome/index/" ?>"'>
        <?php
        //display page footer
        parent::displayFooter();
    }
}