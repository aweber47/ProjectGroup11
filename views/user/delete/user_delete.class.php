<?php

/*** Author: your name*
 * Date: 4/8/2022*
 * File: user_delete.class.php*
 * Description: */
class UserDelete extends UserIndexView
{
    public function display($user, $confirm = "")
    {
        //display page header
        parent::displayHeader("Delete User Details");

        //retrieve user details by calling get methods
        $id = $user->getId();
        $username = $user->getUsername();
        $firstname = $user->getFirstname();
        $lastname = $user->getLastname();
        $email = $user->getEmail();
        ?>

        <div id="main-header">User Details</div>
        <hr>
        <!-- display user details in a table -->
        <table id="detail">
            <tr>
                <td style="width: 130px;">
                    <p><strong>Username:</strong></p>
                    <p><strong>First Name:</strong></p>
                    <p><strong>Last Name:</strong></p>
                    <p><strong>Email:</strong></p>
                </td>
                <td>
                    <p><?= $username ?></p>
                    <p><?= $firstname ?></p>
                    <p><?= $lastname ?></p>
                    <p><?= $email ?></p>
                    <div id="confirm-message"><?= $confirm ?></div>
                </td>
            </tr>
        </table>
        <div id="button-group">
            <input class="edit-buttons" type="button" id="delete-button"
                   value="   Are you sure you want to delete?   "
                   onclick="window.location.href = '<?= BASE_URL ?>/user/delete/<?= $id ?>'">&nbsp;
            <input class="edit-buttons" type="button" id="cancel-button" value="   Cancel   "
                   onclick="window.location.href = '<?= BASE_URL ?>/user/detail/<?= $id ?>'">&nbsp;
        </div>
        <?php
        ?>

        <?php
        //display page footer
        parent::displayFooter();
    }
//end of display method
}