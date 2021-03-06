<?php
/*** Author: Alex Weber*
 * Date: 4/8/2022*
 * File: user_verify.class.php*
 * Description: verify the users login, if it passes give them a verification message and links to the menu, homepage and to view there account details.*/

class UserVerify extends UserIndexView
{
    public function display($message)
    {
        //display page header
        parent::displayHeader("Verify");

        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        // set the login status (default is to show the login form)
        $login_status = 2;

        //obtain user id session variable
        if (isset($_SESSION['user_id'])) {
            $id = $_SESSION['user_id'];
        }

        ?>
        <!--<div id="main-header">Login</div>-->

        <!-- display user  details in a form -->
        <br><br><br><br>

        <div style="border: 1px solid black; margin: auto; padding: 10px; text-align: center; background-color: rgba(255, 215, 0, 0.85)">
            <input type="hidden" name="id" value="<?= $id ?>">
            <?php
            echo '<strong>' . $message . '</strong><br>';
            ?>
            <div id="button-group">
                <input class="edit-buttons" type="button" value="Menu"
                       onclick='window.location.href = "<?= BASE_URL . "/menu/index/" ?>"'>

                <input class="edit-buttons" type="button" value="Home"
                       onclick='window.location.href = "<?= BASE_URL ?>"'>

                <input class="edit-buttons" type="button" value="Account"
                       onclick="window.location.href = '<?= BASE_URL ?>/user/detail/<?= $id ?>'">

            </div>
        </div>

        <br><br>

        <?php
        //display page footer
        parent::displayFooter();
    }
}