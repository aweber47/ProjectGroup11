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

        // retrieve user and role session variables for this file.
        if (isset($_SESSION['user'])) {
            $user = $_SESSION['user'];
        }
        if (isset($_SESSION['admin'])) {
            $role = $_SESSION['admin'];
        }

        // retrieve menu details
        $id = $menuItem->getId();
        $product = $menuItem->getProduct();
        $image = $menuItem->getImage();
        $category = $menuItem->getCategory();
        $price = $menuItem->getPrice();
        $description = $menuItem->getDescription();
        if (strpos($image, "http://") === false and strpos($image, "https://") === false) {
            $image = BASE_URL . $image;
        }

        ?>

        <!-- Display menu details -->
        <div id="main-header"><br></div>

        <hr>

        <!-- Display menu details in a table -->
        <table id="menu-detail-ind">
            <tr class="detail-image">
                <td><img src="<?= $image ?>" alt="<?= $product ?>" style="width: 250px; height: 250px"></td>
            </tr>
            <tr class="detail-labels">
                <th>Product:</th>
                <th>Category:</th>
                <th>Price:</th>
                <th>Description:</th>
            </tr>
            <tr class="detail-info">
                <td><?= $product ?></td>
                <td><?= $category ?></td>
                <td>$<?= $price ?></td>
                <td><?= $description ?></td>
            </tr>
        </table>

        <div id="button-group">
            <input class="detail-buttons" type="button" id="edit-button" value="Edit" onclick="window.location.href = '<?= BASE_URL ?>/menu/edit/<?= $id ?>'">
            
            <input class="detail-buttons" type="button" id="delete-button" value="Delete Item" onclick="window.location.href = '<?= BASE_URL ?>/menu/deleteDisplay/<?= $id ?>'">
            
            <input class="detail-buttons" type="button" id="return-button" value="Return to Menu" onclick="window.location.href='<?= BASE_URL ?>/menu/index/<?= $id ?>'">

            <input class="detail-buttons" type="button" id="add-to-button" value="Add to Cart" onclick="window.location.href='<?= BASE_URL ?>/menu/addToCart/<?= $id ?>'">
        </div>
        <div id="confirm-message"><?= $confirm ?></div>
        <?php
        // display page footer
        parent::displayFooter();
    }
}

