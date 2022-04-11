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
        $role;
        // echo is here (and commented out to fool the variable).
        //echo $role;


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

        <!-- Display menu details-->
        <div id="main-header">Menu Details</div>

        <hr>

        <!-- display menu details in a table -->
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

            <?php
            error_reporting(0);
            // display edit and delete buttons if user role is 1
            if ($role == 1) {
                ?>
                <input type="button" id="edit-button" value="   Edit   "
                       onclick="window.location.href = '<?= BASE_URL ?>/menu/edit/<?= $id ?>'">&nbsp;|
                <input type="button" id="delete-button" value="   Delete Item   "
                       onclick="window.location.href = '<?= BASE_URL ?>/menu/deleteDisplay/<?= $id ?>'">&nbsp;|
                <?php
            }
            ?>
            <button>
                <a id="menu-list-button" href="<?= BASE_URL ?>/menu/index">Return to Menu</a>
            </button> |
            <button>
                <a id="menu-list-button" href="<?= BASE_URL ?>/menu/addToCart/<?= $id ?>"> Add to Cart</a>
            </button>
        </div>
        <div id="confirm-message"><?= $confirm ?></div>
        <?php
        // display page footer
        parent::displayFooter();
    }
}

