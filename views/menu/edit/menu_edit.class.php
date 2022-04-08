<?php

/*** Author: your name*
 * Date: 4/5/2022*
 * File: menu_edit.class.php*
 * Description: */
class MenuEdit extends MenuIndexView
{
    //put your code here

    public function display($menuItem)
    {
        //display page header
        parent::displayHeader("Edit Menu Item");

        //get videogame ratings from a session variable
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

        <div id="main-header">Edit Menu Item Details</div>

        <!-- display menu item details in a form -->
        <form class="new-media" id="edit-form" action='<?= BASE_URL . "/menu/update/" . $id ?>' method="post"
              style="border: 1px solid #bbb; margin-top: 10px; padding: 10px;">
            <input type="hidden" name="id" value="<?= $id ?>">
            <p><strong>Item Name</strong>: <input name="product" type="text" size="100" value="<?= $product ?>" required
                                                  autofocus></p>
            <p><strong>Image</strong>: url (http:// or https://) or local file including path and file extension<br>
                <input name="image" type="text" size="100" required value="<?= $image ?>"></p>
            <p><strong>Category</strong>:
                <select name="category" form="edit_form" value="<?= $category ?>">
                    <option value="1">App</option>
                    <option value="2">Entrees</option>
                    <option value="3">Soup</option>
                </select></p>
            <input type="hidden" name="rating" value="1">
            <p><strong>Price</strong>: <input name="price" type="text" size="40" value="<?= $price ?>" required=""></p>
            <p><strong>Description</strong>:<br>
                <textarea name="description" rows="8" cols="100"><?= $description ?></textarea></p>
            <input type="submit" name="action" value="Update menuItem">
            <input type="button" value="Cancel" onclick='window.location.href = "<?= BASE_URL . "/menu/detail/$id" ?>"'>
        </form>
        <?php
        //display page footer
        parent::displayFooter();
    }

//end of display method
}