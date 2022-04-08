<?php

/*** Author: your name*
 * Date: 4/5/2022*
 * File: menu_detail.class.php*
 * Description: */
class MenuDetail extends MenuIndexView
{
    public function display($menuItem, $confirm = "")
    {
        // display page header
        parent::displayHeader("Product Details");

        // retrieve menu details
        $id = $menuItem->getId();
        $product = $menuItem->getProduct();
        $image = $menuItem->getImage();
        $category = $menuItem->getCategory();
        $price = $menuItem->getPrice();
        $description = $menuItem->getDescription();
        if (strpos($image, "http://") === false AND strpos($image, "https://") === false) {
            $image = BASE_URL . $image;
        }

        ?>
        
        <!-- Display menu details-->
        <div id="main-header">Menu Details</div>
        
        <hr>
        
        <!-- display movie details in a table -->
        <table id="menu-detail-ind">
            <tr>
                <td>
                    <img src="<?= $image ?>" alt="<?= $product ?>"
                </td>
                <td style="width: 130px;">
                    <p><strong>Product:</strong></p>
                    <p><strong>Category:</strong></p>
                    <p><strong>Price:</strong></p>
                    <p><strong>Description:</strong></p>
                </td>
                <td>
                    <p><?= $product ?></p>

                    <p><?= $category ?></p>

                    <p><?= $price ?></p>
                    <p class="media-description"><?= $description ?></p>
                </td>
            </tr>
        </table>
        
        <div id="button-group">
            <input type="button" id="edit-button" value="   Edit   "
                   onclick="window.location.href = '<?= BASE_URL ?>/menu/edit/<?= $id ?>'">&nbsp;
            <input type="button" id="delete-button" value="   Delete Item   "
                   onclick="window.location.href = '<?= BASE_URL ?>/menu/deleteDisplay/<?= $id ?>'">&nbsp;
            <button>
                <a id="menu-list-button" href="<?= BASE_URL ?>/menu/index">Return to Menu</a>
            </button>
        </div>
        <div id="confirm-message"><?= $confirm ?></div>
        <?php
        // display page footer
        parent::displayFooter();
    }
}

