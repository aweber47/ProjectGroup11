<?php

/*** Author: Alex Weber & James Ritter*
 * Date: 4/5/2022*
 * File: menu_verify.class.php*
 * Description: Displays a verification message to user if an action was successful. */
class MenuVerify extends MenuIndexView
{
    public function display($message)
    {
        //display header
        parent::displayHeader("Error");
        ?>

        <!-- display a user verification message in a div tag -->
        <br><br><br><br>
        <div style="border: 1px solid black; margin: auto; padding: 10px; text-align: center; background-color: rgba(255, 215, 0, 0.85)">
            <?php
            echo '<strong>' . $message . '</strong><br>';
            ?>
            <div id="button-group">
                <input class="edit-buttons" type="button" value="Back to Menu"
                       onclick='window.location.href = "<?= BASE_URL . "/menu/index/" ?>"'>
            </div>
        </div>
        <br><br>


        <?php
        //display footer
        parent::displayFooter();
    }
}