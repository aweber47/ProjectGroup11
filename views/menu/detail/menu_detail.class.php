<?php

/*** Author: Alex Weber*
 * Date: 4/11/2022*
 * File: menu_detail.class.php*
 * Description: The menu detail page displays the buttons and menu detail of an item. The buttons are controlled by a session variable 'role' defined in the user controller.*/
class MenuDetail extends MenuIndexView
{
    public function display($menuItem, $confirm = "")
    {
        // display page header
        parent::displayHeader("Product Details");
        //session
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        if (isset($_SESSION['role'])) {
            $role = $_SESSION['role'];
        }
        if(!isset($_SESSION['role'])){
            $role = 0;
        }

        //get categories from a session variable
        if (isset($_SESSION['categories'])) {
            $categories = $_SESSION['categories'];
        }

        // echo is here (and commented out to fool the variable).
        //echo $role;

        // retrieve menu details
        $id = $menuItem->getId();
        $product = $menuItem->getProduct();
        $image = $menuItem->getImage();
        $category = $menuItem->getCategory();
        if ($category == 1) {
            $category = $categories[1];
        }
        if ($category == 2) {
            $category = $categories[2];
        }
        if ($category == 3) {
            $category = $categories[3];
        }
        $price = $menuItem->getPrice();
        $description = $menuItem->getDescription();
        if (strpos($image, "http://") === false and strpos($image, "https://") === false) {
            $image = BASE_URL . $image;
        }

        ?>

        <!-- Display menu details-->
        <!--<div id="main-header">Menu Details</div>-->

        <br>

        <!-- Display menu details in a table -->
        <table id="menu-detail">
            <tr class="detail-image">
                <td><img src="<?= $image ?>" alt="<?= $product ?>" style="width: 250px; height: 250px"></td>
            </tr>
            <tr class="detail-labels">
                <th><?= $product ?></th>
                <th>Category:</th>
                <th>Price:</th>
                <th>Description:</th>
            </tr>
            <tr class="detail-info">
                <td><br></td>
                <td><?= $category ?></td>
                <td>$<?= $price ?></td>
                <td><?= $description ?></td>
            </tr>
        </table>

        <?php
        error_reporting(0);
        // display edit and delete buttons if user role is 1
        ?>
        <div id="button-group">


            <input class="detail-buttons" type="button" id="return-button" value="Return to Menu"
                   onclick="window.location.href='<?= BASE_URL ?>/menu/index/<?= $id ?>'">

            <input class="detail-buttons" type="button" id="add-to-button" value="Add to Cart"
                   onclick="window.location.href='<?= BASE_URL ?>/menu/addToCart/<?= $id ?>'">

            <!---display edit, delete and add buttons if user role is 1 -->
            <?php if ($role === 1) { ?>

                <input class="detail-buttons" type="button" id="edit-button" value="Edit Item"
                       onclick="window.location.href = '<?= BASE_URL ?>/menu/edit/<?= $id ?>'">

                <input class="detail-buttons" type="button" id="delete-button" value="Delete Item"
                       onclick="window.location.href = '<?= BASE_URL ?>/menu/deleteDisplay/<?= $id ?>'">

                <input class="detail-buttons" type="button" id="edit-button" value="Add Menu Item"
                       onclick="window.location.href = '<?= BASE_URL ?>/menu/addDisplay/'">

            <?php } ?>
        </div>

        <div id="confirm-message"><?= $confirm ?></div>

        <!--<div id="button-group">-->

        <?php
        // display page footer
        parent::displayFooter();
    }
}

