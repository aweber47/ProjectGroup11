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
        <table id="detail">
            <tr>
                <td style="width: 130px;">
                    <p><strong>Product:</strong></p>
                    <p><strong>Category:</strong></p>
                    <p><strong>Price:</strong></p>
                    <p><strong>Description:</strong></p>
                    <div id="button-group">
                        <input type="button" id="delete-button" value="   Are you sure you want to delete?   "
                               onclick="window.location.href = '<?= BASE_URL ?>/menu/delete/<?= $id ?>'">&nbsp;
                    </div>
                    <div id="button-group">
                        <input type="button" id="cancel-button" value="   Cancel   "
                               onclick="window.location.href = '<?= BASE_URL ?>/menu/detail/<?= $id ?>'">&nbsp;
                    </div>
                </td>
                <td>
                    <p><?= $product ?></p>
                    <p><?= $category ?></p>
                    <p><?= $price ?></p>
                    <p class="media-description"><?= $description ?></p>
                    <div id="confirm-message"><?= $confirm ?></div>
                </td>
            </tr>
        </table>
        <a href="<?= BASE_URL ?>/menu/index">Go to menu list</a>

        <?php
        // display page footer
        parent::displayFooter();
    }
}