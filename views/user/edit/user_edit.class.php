<?php

/*** Author: Alex Weber and James Ritter*
 * Date: 4/8/2022*
 * File: user_edit.class.php*
 * Description: displays the user edit form in a view. */
class UserEdit extends UserIndexView
{
    //put your code here

    public function display($user)
    {
        //display page header
        parent::displayHeader("Edit User Details");

        $id = $user->getId();
        $username = $user->getUsername();
        $password = $user->getPassword();
        $firstname = $user->getFirstname();
        $lastname = $user->getLastname();
        $email = $user->getEmail();
        $role = $user->getRole();


        // php session created and retrieve the users role
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        if (isset($_SESSION['user_id'])) {
            $Adminid = $_SESSION['user_id'];
        }


        //if block to determine if the user is an admin or not
        // based on that, determine if it blocks the user from changing the base url
        if ($role == 1) {
        } else {
            if ($role == 0) {
                try {
                    if ($Adminid != $id) {
                        throw new UserIssueException("<p><strong>" . "WARNING WARNING WARNING" . "<br><br>" . "YOU ARE NOT THIS USER" . "<br><br>" . "PLEASE CONTACT SERVER ADMIN IF PROBLEM CONTINUES" . "</strong></p>");
                    }
                } catch (UserIssueException $e) {
                    $view = new UserController();
                    $view->manierror($e->getMessage());
                    return false;
                }
            }
            if ($role == 2) {
                try {
                    if ($Adminid != $id) {
                        throw new UserIssueException("<p><strong>" . "WARNING WARNING WARNING" . "<br><br>" . "YOU ARE NOT THIS USER" . "<br><br>" . "PLEASE CONTACT SERVER ADMIN IF PROBLEM CONTINUES" . "</strong></p>");
                    }
                } catch (UserIssueException $e) {
                    $view = new UserController();
                    $view->manierror($e->getMessage());
                    return false;
                }
            }
        }
        ?>

        <!--<div id="main-header">Edit User Details</div>-->
        <br><br><br><br><br>

        <!-- display the user details in a form -->
        <form id="edit-form" action='<?= BASE_URL . "/user/update/" . $id ?>' method="post"
              style="padding: 20px 0; text-align: center">
            <table id="menu-detail">
                <tr class="detail-labels-all">
                    <th>Username</th>
                    <th>Password</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <?php if ($role == 1) { ?>
                        <th>Role</th>
                    <?php } ?>

                </tr>
                <tr class="detail-info-all">
                    <td><input name="username" type="text" size="50" value="<?= $username ?>"></td>
                    <td><input name="password" type="password" size="50" value="<?= $password ?>"></td>
                    <td><input name="firstname" type="text" size="50" value="<?= $firstname ?>"></td>
                    <td><input name="lastname" type="text" size="50" value="<?= $lastname ?>"></td>
                    <td><input name="email" type="text" size="50" value="<?= $email ?>"></td>
                    <?php if ($role == 1) { ?>
                        <td>
                            <div class="edit-left" style="font-size: small; color: red"><strong>Current Role
                                    is: <?= $role ?></strong></div>
                            <select name="role">
                                <option value="1">1 - Admin</option>
                                <option value="2">2 - Default</option>
                            </select>
                        </td>
                    <?php } ?>
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