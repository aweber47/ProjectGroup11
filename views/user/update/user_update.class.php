<?php

/*** Author: your name*
 * Date: 4/8/2022*
 * File: user_update.class.php*
 * Description: */
class UserUpdate extends UserIndexView
{
    public function display($message, $id)
    {
        parent::displayHeader("User Update Screen");
        ?>
        <div id="main-header">User Details Have Been Updated</div>

        <!-- display user details in a form -->
        <div class="new-media" style="border: 1px solid #bbb; margin-top: 10px; padding: 10px;">
            <input type="hidden" name="id" value="<?= $id ?>">
            <?php
            echo '<p><strong>' . $message . '</strong><br>';
            ?>
            <input type="button" value="Continue to Details"
                   onclick='window.location.href = "<?= BASE_URL . "/user/detail/$id" ?>"'>
        </div>
        <?php
        parent::displayFooter();
    }
}