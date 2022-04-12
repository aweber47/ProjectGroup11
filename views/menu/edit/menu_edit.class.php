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
        <!--<div id="main-header">Edit Menu Item Details</div>-->

        <!-- Form to edit menu item details -->
        <form id="edit-form" action='<?= BASE_URL . "/menu/update/" . $id ?>' method="post">
            <fieldset id="edit-fieldset">
                <legend>Edit Menu Item</legend>
                <input type="hidden" name="id" value="<?= $id ?>">
                <label for="Item Name" class="edit-left">Item Name:</label>
                    <input id="Item Name" name="product" type="text" size="100" value="<?= $product ?>" required autofocus class="edit-right">
                
                <br>
                
                <label for="Image" class="edit-left">Image:</label>
                    <input id="Image" name="image" type="text" size="100" value="<?= $image ?>" class="edit-right" placeholder="url (http:// or https://) or local file including path and file extension">
                
                <br>
                
                <label for="<?= $category ?>" class="edit-left">Category:</label>
                    <select name="category" form="edit_form" id="<?= $category ?>" class="edit-right">
                        <option value="1">App</option>
                        <option value="2">Entrees</option>
                        <option value="3">Soup</option>
                    </select>
                
                <br>
                
                <input type="hidden" name="rating" value="1">
                <label for="Price" class="edit-left">Price:</label>
                    <input id="Price" name="price" type="text" size="40" value="<?= $price ?>" required="" class="edit-right">
                
                <br>
                
                <label for="Description" class="edit-left">Description:</label>
                    <textarea id="Description" name="description" rows="8" cols="100"><?= $description ?></textarea class="edit-right">
            </fieldset>
            
            <br>
            
            <input class="edit-buttons" type="submit" name="action" value=" Update ">
            <input class="edit-buttons" type="button" value=" Cancel " onclick='window.location.href = "<?= BASE_URL . "/menu/detail/$id" ?>"'>
        </form>
        
        <?php
        //display page footer
        parent::displayFooter();
    }//end of display method
}