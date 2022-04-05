<?php

/*** Author: your name*
 * Date: 4/5/2022*
 * File: menu_add.class.php*
 * Description: */
class MenuAdd extends MenuIndexView
{
    //put your code here

    public function display() {
        //display page header
        parent::displayHeader("Edit Menu Item");

        //get videogame ratings from a session variable
        if (isset($_SESSION['categories'])) {
            $categories = $_SESSION['categories'];
        }

        ?>

        <div id="main-header">Edit Menu Item Details</div>

        <!-- display menu item details in a form -->
        <form class="new-media"  id="edit_form" action='<?= BASE_URL . "/menu/add/" . $id ?>' method="post" style="border: 1px solid #bbb; margin-top: 10px; padding: 10px;">
            <input type="hidden" name="id" value="<?= $id ?>">
            <p><strong>Item Name</strong>: <input name="product" type="text" size="100" value="Title" required autofocus></p>
            <p><strong>Category</strong>:
                <select name="category" form="edit_form">
                    <option value="1">App</option>
                    <option value="2">Entrees</option>
                    <option value="3">Soup</option>
                </select></p>
            <input type="hidden" name="rating" value="1">
            <p><strong>Price</strong>: <input name="price" type="text" size="40" value="0.00" required=""></p>
            <p><strong>Description</strong>:<br>
                <textarea name="description" rows="8" cols="100">Fill your description here</textarea></p>
            <input type="submit" name="action" value="Add menuItem">
            <input type="button" value="Cancel" onclick='window.location.href = "<?= BASE_URL . "/menu/index/"?>"'>
        </form>
        <?php
        //display page footer
        parent::displayFooter();
    }

//end of display method
}