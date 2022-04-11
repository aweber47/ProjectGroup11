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
            <div id="button-group">
                <input class="edit-buttons" type="button" value="View Menu"
                       onclick='window.location.href = "<?= BASE_URL . "/menu/index/" ?>"'>
                <input class="edit-buttons" type="button" value="Continue to Index"
                       onclick='window.location.href = "<?= BASE_URL . "/welcome/index/" ?>"'>
            </div>

        </div>
        <?php
        //display page footer
        parent::displayFooter();
    }

}