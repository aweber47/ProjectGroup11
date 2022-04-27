<?php
/*** Author: your name*
 * Date: 4/5/2022*
 * File: menu_delete.class.php*
 * Description: */

class MenuDelete extends MenuIndexView{
    public function display($menuItem, $confirm = ""){
        // display page header
        parent::displayHeader("Product Details");

        // retrieve menu details
        $id = $menuItem->getId();
        $product = $menuItem->getProduct();
        $category = $menuItem->getCategory();
        $price = $menuItem->getPrice();
        $description = $menuItem->getDescription();
        ?>
        <!-- Display menu details-->

        <!--<div id="main-header">Menu Details</div>-->
        <hr>
        <!-- display item details in a table -->
        <div id="edit-form">
        <fieldset id="edit-fieldset">
        <legend>Delete Menu Item</legend>
            <label class="edit-left">Product:</label>
            <p id="Item Name" class="edit-right"><?= $product ?></p>

            <br>

            <label class="edit-left">Category:</label>
            <p id="Category" class="edit-right"><?= $category ?></p>

            <br>

            <label class="edit-left">Price:</label>
            <p id="Price" class="edit-right"><?= $price ?></p>

            <br>

            <label class="edit-left">Description:</label>
            <p id="Description" class="edit-right"><?= $description ?></p>

            <div id="confirm-message"><?= $confirm ?></div>

        </fieldset>

            <div id="button-group">
                <input type="button" id="delete-button" class="edit-buttons" value="   Are you sure you want to delete?   "
                       onclick="window.location.href = '<?= BASE_URL ?>/menu/delete/<?= $id ?>'">&nbsp;
                <input type="button" id="cancel-button" class="edit-buttons"  value="   Cancel   "
                       onclick="window.location.href = '<?= BASE_URL ?>/menu/detail/<?= $id ?>'">&nbsp;
                <input type="button" id="return-button" class="edit-buttons"   value=" Index "
                       onclick="window.location.href = '<?= BASE_URL ?>/menu/index/'">

            </div>

        </div>

        <?php
        // display page footer
        parent::displayFooter();
    }
}