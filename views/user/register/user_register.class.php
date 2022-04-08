<?php

/*** Author: your name*
 * Date: 4/8/2022*
 * File: user_register.class.php*
 * Description: */
class UserRegister extends UserIndexView
{

    //put your code here
    public function display()
    {
        //display page header
        parent::displayHeader("Signup");
        ?>

        <div id="main-header">Signup</div>

        <!-- display the user information register in a form -->
        <form class="new-media" action='<?= BASE_URL . "/user/add/" ?>' method="post"
              style="border: 1px solid #bbb; margin-top: 10px; padding: 10px;">
            <input type="hidden" name="id" value="<?= $id ?>">
            <p><strong>Username</strong><br>
                <input name="username" type="text" size="40" value="Name" required></p>
            <p><strong>Password</strong><br>
                <input name="password" type="text" size="100" required value="Password"></p>
            <p><strong>First name</strong><br>
                <input name="firstname" type="text" size="40" value="" required></p>
            <p><strong>Last name</strong><br>
                <input name="lastname" type="text" size="40" required value=""></p>
            <p><strong>Email</strong><br>
                <input name="email" type="email" size="100" value="username@example.com" required></p>
            <input type="submit" name="action" value="Signup">
            <input type="button" value="Cancel" onclick='window.location.href = "<?= BASE_URL . "/welcome/index/" ?>"'>
        </form>
        <?php
        //display page footer
        parent::displayFooter();
    }

}
