<?php
/*** Author: Alex Weber & James Ritter*
 * Date: 4/8/2022*
 * File: user_update.class.php*
 * Description: Displays a verification message to user if an action was successful. */

class UserUpdate extends UserIndexView
{
    public function display($message, $id)
    {
        parent::displayHeader("User Update Screen");
        ?>

        <br><br><br><br>

        <!-- display user verification message in a div -->
        <div style="border: 1px solid black; margin: auto; padding: 10px; text-align: center; background-color: rgba(255, 215, 0, 0.85)">
            <input type="hidden" name="id" value="<?= $id ?>">
            <?php
            echo '<h2>' . $message . '</h2>';
            ?>
            <div id="button-group">
                <input class="edit-buttons" type="button" value="Back to Account"
                       onclick='window.location.href = "<?= BASE_URL . "/user/detail/$id" ?>"'>
            </div>
        </div>

        <br><br>

        <?php
        parent::displayFooter();
    }
}