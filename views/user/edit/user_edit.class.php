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

        <!--<div id="main-header">Edit User Details</div>-->
        <br><br><br><br><br>

        <!-- display the user details in a form -->
        <form id="edit-form" action='<?= BASE_URL . "/user/update/" . $id ?>' method="post"
              style="padding: 20px 0; text-align: center">
            <table id="menu-detail">
                <tr class="detail-labels">
                    <th>Username</th>
                    <th>Password</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                </tr>
                <tr class="detail-info">
                    <td><input name="username" type="text" size="50" value="<?= $username ?>"></td>
                    <td><input name="password" type="password" size="50" value="<?= $password ?>"></td>
                    <td><input name="firstname" type="text" size="50" value="<?= $firstname ?>"></td>
                    <td><input name="lastname" type="text" size="50" value="<?= $lastname ?>"></td>
                    <td><input name="email" type="text" size="50" value="<?= $email ?>" required=""></td>
                </tr>
            </table>
            <div id="button-group">
                <input class="edit-buttons" type="submit" name="action" value="Update User">
                <input class="edit-buttons" type="button" value="Cancel"
                       onclick='window.location.href = "<?= BASE_URL . "/user/detail/$id" ?>"'>
            </div>
        </form>
        <?php
        //display page footer
        parent::displayFooter();
    }
//end of display method
}