<?php

/*** Author: Alex Weber and James Ritter*
 * Date: 4/8/2022*
 * File: user_delete.class.php*
 * Description: Holds the view for the user delete feature. */
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
            <form action="<?= BASE_URL ?>/user/delete/" method="post">
                <label for="confirm">Type: YES to delete account.</label>
                <input class="edit-buttons" type="text" name="confirm" size="50">
                <input class="edit-buttons" type="submit" value=" Submit  ">
            </form>
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