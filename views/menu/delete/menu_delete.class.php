<?php
/*** Author: ALEX WEBER AND JAMES RITTER*
 * Date: 4/5/2022*
 * File: menu_delete.class.php*
 * Description: Displays a warning message and double checks if the user wants to delete the item*/

class MenuDelete extends MenuIndexView
{
    public function display($menuItem, $confirm = "")
    {
        // if a user of the web page trys to alter the url it fails.
        try {
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }
            if (isset($_SESSION['role'])) {
                error_reporting(0);
                $role = $_SESSION['role'];
                echo $role;
            } else {
                $unauthorized = TRUE;
            }

            if ($unauthorized === TRUE || $role != 1) {
                throw new UnauthorizedAccessException("YOU DO NOT HAVE ACCESS TO THIS PAGE");
            }
        } catch (UnauthorizedAccessException $e) {
            $view = new MenuController();
            $view->unauthorized_error($e->getMessage());
            return false;
        }


        // display page header
        parent::displayHeader("VERIFY PRODUCT DELETION");

        // retrieve menu details
        $id = $menuItem->getId();

        // create a session variable to hold the wanted deleted menu item
        $_SESSION['sad_item'] = $id;

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

            <br><br>

            <form action="<?= BASE_URL ?>/menu/delete" method="post">
                <div id="button-group">
                    <label><strong>Type YES:</strong></label>
                    <input class="edit-buttons" type="text" name="conDel" required size="10">
                    <input class="edit-buttons" type="submit" value=" DELETE MENU ITEM ">
                    <input class="edit-buttons" type="button" id="cancel-button" value="  CANCEL  "
                           onclick="window.location.href = '<?= BASE_URL ?>/menu/detail/<?= $id ?>'">


                </div>
            </form>
        </div>

        <?php
        // display page footer
        parent::displayFooter();
    }
}