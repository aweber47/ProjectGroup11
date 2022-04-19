<?php
/*** Author: your name*
 * Date: 4/8/2022*
 * File: user_update.class.php*
 * Description: */

class UserUpdate extends UserIndexView{
    public function display($message, $id){
        parent::displayHeader("User Update Screen");
        ?>
        
        <!--<div id="main-header">User Details Have Been Updated</div>-->

        <br><br><br><br>
        
        <!-- display user details in a form -->
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