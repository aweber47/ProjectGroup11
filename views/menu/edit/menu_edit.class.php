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
        <!-- REBUILDING THE ORIGINAL FORM - READ THIS

         James: for your form I had to semi revert it back to the original. I kept or at least tried to revert your styles,
         The update menu Item feature is working on my end and should work for you as well. The reason it didn't work
         was due to the description 'input tag' being reverted to a 'textarea'. This caused the INPUT_POST, method to fail
         causing the error. I kept your form commented out so if I forgot anything you could implement it back in
         (as you know the css better than I do). Just remove it once complete.

         - You will also need to create a 'Category' id within the css file.

         Things to keep in mind when doing this for the edit user...

         1. Don't change the input tags... I need those tags to stay the same in order for INPUT_POST to receive the form data.

         2. If an id is missing, create one and implement it (don't use the variable name as an id, that could mess with the post stuff).

         3. If you have any doubts or it isn't working send me a text.


         --->
        <!-- display the user details in a form -->
        <form id="edit-form" action='<?= BASE_URL . "/menu/update/" . $id ?>' method="post">
            <input type="hidden" name="id" value="<?= $id ?>">

            <fieldset id="edit-fieldset">
                <legend>Edit Menu Item</legend>

                <label for="Item Name" class="edit-left">Item Name</label>
                <input id="Item Name" class="edit-right" name="product" type="text" size="100" value="<?= $product ?>"
                       required autofocus>

                <br>

                <label for="Image" class="edit-left">Image:</label>
                <input id="Image" class="edit-right" name="image" type="text" size="100" value="<?= $image ?>" required>

                <br>

                <label for="Category" class="edit-left">Category:</label>
                <select name="category" id="Category" class="edit-right">
                    <option value="1">App</option>
                    <option value="2">Entrees</option>
                    <option value="3">Soup</option>
                </select>

                <br>

                <label for="Price" class="edit-left">Price:</label>
                <input id="Price" class="edit-right" name="price" type="text" size="50" value="<?= $price ?>"
                       required="">

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


        <!--
       Form to edit menu item details
        <form id="edit-form" action='<? /*= BASE_URL . "/menu/update/" . $id */ ?>' method="post">
            <input type="hidden" name="id" value="<? /*= $id */ ?>">
            <fieldset id="edit-fieldset">
                <legend>Edit Menu Item</legend>
                <label for="Item Name" class="edit-left">Item Name:</label>
                    <input name="product" type="text" size="100" value="<? /*= $product */ ?>" id="Item Name" required autofocus class="edit-right">
                
                <br>
                
                <label for="Image" class="edit-left">Image:</label>
                    <input name="image" type="text" size="100" value="<? /*= $image */ ?>" id="Image" class="edit-right" placeholder="url (http:// or https://) or local file including path and file extension">
                
                <br>
                
                <label for="category" class="edit-left">Category:</label>

                    <select  name="category" form="edit_form"  id="category" class="edit-right">
                        <option value="1">App</option>
                        <option value="2">Entrees</option>
                        <option value="3">Soup</option>
                    </select>
                
                <br>

                <label for="Price" class="edit-left">Price:</label>
                    <input id="Price" name="price" type="text" size="40" value="<? /*= $price */ ?>" required="" class="edit-right">
                
                <br>
                
                <label for="Description" class="edit-left">Description:</label>
                    <textarea id="Description" name="description" rows="8" cols="100"><? /*= $description */ ?></textarea class="edit-right">
            </fieldset>
            
            <br>
            
            <input class="edit-buttons" type="submit" name="action" value=" Update ">
            <input class="edit-buttons" type="button" value=" Cancel " onclick='window.location.href = "<? /*= BASE_URL . "/menu/detail/$id" */ ?>"'>
        </form>
        -->

        <?php
        //display page footer
        parent::displayFooter();
    }//end of display method
}