<?php

/*** Author: your name*
 * Date: 4/11/2022*
 * File: user_nonverify.class.php*
 * Description: */
class UserNonVerify extends UserIndexView
{


    //put your code here
    public function display($message)
    {
        //display page header
        parent::displayHeader("Verify");

        ?>

        <!--        <div id="main-header">Login</div>-->

        <!-- display user  details in a form -->
        <div class="new-media" style="border: 1px solid #bbb; margin-top: 10px; padding: 10px;">
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
        <?php
        //display page footer
        parent::displayFooter();
    }

}