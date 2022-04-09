<?php

/*** Author: your name*
 * Date: 4/8/2022*
 * File: user_edit.class.php*
 * Description: */
class UserEdit extends UserIndexView
{
    //put your code here

    public function display($user)
    {
        //display page header
        parent::displayHeader("Edit User Details");

        //get order cart (shopping cart info) session var

        // retrieve user details
        $id = $user->getId();
        $username = $user->getUsername();
        $password = $user->getPassword();
        $firstname = $user->getFirstname();
        $lastname = $user->getLastname();
        $email = $user->getEmail();

        ?>

        <div id="main-header">Edit User Details</div>

        <!-- display the user details in a form -->
        <form class="new-media" id="edit-form" action='<?= BASE_URL . "/user/update/" . $id ?>' method="post"
              style="border: 1px solid #bbb; margin-top: 10px; padding: 10px;">
            <input type="hidden" name="id" value="<?= $id ?>">
            <p><strong>Username</strong>: <input name="username" type="text" size="100" value="<?= $username ?>"
                                                 required autofocus></p><br>
            <p><strong>Password</strong>:<input name="password" type="password" size="100" value="<?= $password ?>"
                                                required></p><br>
            <p><strong>First Name</strong>: <input name="firstname" type="text" size="50" value="<?= $firstname ?>"
                                                   required=""></p><br>
            <p><strong>Last Name</strong>: <input name="lastname" type="text" size="50" value="<?= $lastname ?>"
                                                  required=""></p><br>
            <p><strong>Email</strong>: <input name="email" type="email" size="50" value="<?= $email ?>" required="">
            </p><br>
            <input type="submit" name="action" value="Update User">
            <input type="button" value="Cancel" onclick='window.location.href = "<?= BASE_URL . "/user/detail/$id" ?>"'>
        </form>
        <?php
        //display page footer
        parent::displayFooter();
    }
//end of display method
}