<?php
/*** Author: Alex Weber and James Ritter*
 * Date: 4/5/2022*
 * File: menu_edit.class.php*
 * Description: Displays the menu edit view/form for the admin to edit the information*/

class MenuEdit extends MenuIndexView
{
    //put your code here

    public function display($menuItem)
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


        //display page header
        parent::displayHeader("Edit Menu Item");

        //get categories from a session variable
        if (isset($_SESSION['categories'])) {
            $categories = $_SESSION['categories'];
        }

        // retrieve menu details
        $id = $menuItem->getId();
        $product = $menuItem->getProduct();
        $image = $menuItem->getImage();
        $category = $menuItem->getCategory();
        $price = $menuItem->getPrice();
        $description = $menuItem->getDescription();

        ?>
        <!-- display the user details in a form -->
        <form id="edit-form" action='<?= BASE_URL . "/menu/update/" . $id ?>' method="post">
            <input type="hidden" name="id" value="<?= $id ?>">

            <fieldset id="edit-fieldset">
                <legend>Edit Menu Item</legend>

                <label for="Item Name" class="edit-left">Item Name</label>
                <input id="Item Name" class="edit-right" name="product" type="text" size="100" value="<?= $product ?>"
                       autofocus>

                <br>

                <label for="Image" class="edit-left">Image:</label>
                <input id="Image" class="edit-right" name="image" type="text" size="100" value="<?= $image ?>">

                <br>

                <label for="Category" class="edit-left">Category:</label>
                <select name="category" id="Category" class="edit-right">
                    <option value="1">App</option>
                    <option value="2">Entrees</option>
                    <option value="3">Soup</option>
                </select>

                <br>

                <label for="Price" class="edit-left">Price:</label>
                <input id="Price" class="edit-right" name="price" type="text" size="50" value="<?= $price ?>">

                <br>

                <label for="Description" class="edit-left">Description:</label>
                <!-- The reason the update failed was due to text being changed from an input to a textarea -->
                <!-- The tag has to be an input... if you want a text area you have to somehow incorp that with the input tag....-->
                <input id="Description" class="edit-right" name="description" type="text" size="100"
                       value="<?= $description ?>">
            </fieldset>

            <br>

            <div id="button-group">
                <input class="edit-buttons" type="submit" name="action" value="Update Menu">
                <input class="edit-buttons" type="button" value="Cancel"
                       onclick='window.location.href = "<?= BASE_URL . "/menu/detail/$id" ?>"'>
            </div>
        </form>

        <?php
        //display page footer
        parent::displayFooter();
    }//end of display method
}