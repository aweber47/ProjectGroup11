<?php

/*** Author: your name*
 * Date: 4/5/2022*
 * File: menu_update.class.php*
 * Description: */
class MenuUpdate extends MenuIndexView{
    public function display($message, $id){
        parent::displayHeader("Menu Item Update");
        ?>
        
        <!--<div id="main-header">Menu Item Updated</div>-->

        <!-- display menu details in a form -->
        <div class="new-media" style="border: 1px solid #bbb; margin-top: 10px; padding: 10px;">
            <input type="hidden" name="id" value="<?= $id ?>">
            <?php
                echo '<p><strong>' . $message . '</strong><br>';
            ?>
            <input type="button" value="Continue to Details"
                   onclick='window.location.href = "<?= BASE_URL . "/menu/detail/$id" ?>"'>

        </div>
        
        <?php
        parent::displayFooter();
    }
}