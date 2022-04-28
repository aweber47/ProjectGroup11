<?php
/*** Author: Alex Weber *
 * Date: 4/5/2022*
 * File: menu_update.class.php*
 * Description: display a confirmation view of a menu item being updated*/

class MenuUpdate extends MenuIndexView
{
    public function display($message, $id)
    {
        parent::displayHeader("Menu Item Update");
        ?>

        <!--<div id="main-header">Menu Item Updated</div>-->

        <!-- display menu details in a form -->
        <div style="border: 1px solid black; margin-top: 10px; padding: 10px; background-color: gold">
            <input type="hidden" name="id" value="<?= $id ?>">
            <?php
            echo '<p style="text-align: center"><strong>' . $message . '</strong><br>';
            ?>
            <div id="button-group">
                <input type="button" value="Continue to Details"
                       onclick='window.location.href = "<?= BASE_URL . "/menu/detail/$id" ?>"'>
            </div>
        </div>
        <br><br>

        <?php
        parent::displayFooter();
    }
}