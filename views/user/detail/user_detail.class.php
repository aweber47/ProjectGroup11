<?php

/*** Author: your name*
 * Date: 4/7/2022*
 * File: user_detail.class.php*
 * Description: */
class UserDetail extends UserIndexView
{
    public function display($user_id, $user, $confirm = "")
    {
        //display page header
        parent::displayHeader("Display User Details");

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
            <input type="button" id="edit-button" value="   Edit   "
                   onclick="window.location.href = '<?= BASE_URL ?>/user/edit/<?= $id ?>'">&nbsp;|
            <input type="button" id="delete-button" value="   Delete Account   "
                   onclick="window.location.href = '<?= BASE_URL ?>/user/deleteDisplay/<?= $id ?>'">&nbsp;|
            <input type="button" id="cancel-button" value="  Return to Account  "
                   onclick="window.location.href = '<?= BASE_URL ?>/user/login/'">
        </div>
        <div id="confirm-message"><?= $confirm ?></div>
        <?php
        //display page footer
        parent::displayFooter();
    }
//end of display method
}