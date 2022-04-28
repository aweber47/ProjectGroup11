<?php
/*** Author: Alex Weber and James Ritter*
 * Date: 4/11/2022*
 * File: user_nonverify.class.php*
 * Description: If a user enters an incorrect login this confirm message will display. */

class UserNonVerify extends UserIndexView
{

    //put your code here
    public function display($message)
    {
        //display page header
        parent::displayHeader("Verify");

        ?>
        <br><br><br><br>
        <div class="login-issue"
             style="border: 1px solid #bbb; margin: auto; padding: 10px; text-align: center; background-color: rgba(255, 215, 0, 0.85)">
            <input type="hidden" name="id" value="<?= $id ?>">
            <?php
            echo '<p><strong>' . $message . '</strong><br>';
            echo '<h2><strong>There was an issue with your login information</strong></h2>';
            echo '<h4><strong>Please check your username and password</strong></h4>';
            echo '<h5><strong>If you have not created an account before, please register now!</strong></h5>';
            ?>
            <div id="button-group">
                <input class="edit-buttons" type="button" value="Register an Account"
                       onclick='window.location.href = "<?= BASE_URL . "/user/register/" ?>"'>
                <input class="edit-buttons" type="button" value="Back to Login Page"
                       onclick='window.location.href = "<?= BASE_URL . "/user/login/" ?>"'>
            </div>
        </div>
        <br>
        <?php
        //display page footer
        parent::displayFooter();
    }
}