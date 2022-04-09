<?php

/*** Author: your name*
 * Date: 4/8/2022*
 * File: user_verify.class.php*
 * Description: */
class UserVerify extends UserIndexView
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
            ?>
            <input type="button" value="View Account Details"
                   onclick='window.location.href = "<?= BASE_URL . "/user/detail/$id" ?>"'>
            <input type="button" value="Continue to Index"
                   onclick='window.location.href = "<?= BASE_URL . "/welcome/index/" ?>"'>

        </div>
        <?php
        //display page footer
        parent::displayFooter();
    }

}