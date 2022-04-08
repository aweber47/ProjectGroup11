<?php

/*** Author: your name*
 * Date: 4/8/2022*
 * File: user_login.class.php*
 * Description: */
class UserLogin extends UserIndexView {
    //put your code here
    public function display() {
        //display page header
        parent::displayHeader("Signup");

        //get the users shopping cart details here (session var)
        ?>

        <div id="main-header">Login</div>

        <!-- display movie details in a form -->
        <form class="new-media"  action='<?= BASE_URL . "/user/verify/"?>' method="post" style="border: 1px solid #bbb; margin-top: 10px; padding: 10px;">
            <input type="hidden" name="id" value="<?= $id ?>">

            <p><strong>Username</strong><br>
                <input name="username" type="text" size="40" value="Name" required=""></p>
            <p><strong>Password</strong><br>
                <input name="password" type="text" size="100" required value="Password"></p>
            <input type="submit" name="action" value="Login">
            <input type="button" value="Cancel" onclick='window.location.href = "<?= BASE_URL . "/welcome/index/"?>"'>
            <input type="button" value="Signup" onclick='window.location.href = "<?= BASE_URL . "/user/register/"?>"'>
        </form>
        <?php
        //display page footer
        parent::displayFooter();
    }
}