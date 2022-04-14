<?php
/*** Author: your name*
 * Date: 4/8/2022*
 * File: user_verify.class.php*
 * Description: */

class UserVerify extends UserIndexView{
    public function display($message){
        //display page header
        parent::displayHeader("Verify");
        
        ?>

        <!--<div id="main-header">Login</div>-->

        <!-- display user  details in a form -->
        <br><br><br><br>
        <div style="border: 1px solid black; margin: auto; padding: 10px; text-align: center; background-color: rgba(255, 215, 0, 0.85)">
            <input type="hidden" name="id" value="<?= $id ?>">
            <?php
            echo '<p><strong>' . $message . '</strong><br>';
            ?>
            <div id="button-group">
                <input class="edit-buttons" type="button" value="View Menu" onclick='window.location.href = "<?= BASE_URL . "/menu/index/" ?>"'>
                
                <input class="edit-buttons" type="button" value="Continue to Index" onclick='window.location.href = "<?= BASE_URL ?>"'>
            </div>
        </div>
        <br><br>
        <?php
        //display page footer
        parent::displayFooter();
    }
}