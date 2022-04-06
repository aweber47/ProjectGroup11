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
        parent::displayHeader("Add Menu Item");

        //get videogame ratings from a session variable
        if (isset($_SESSION['categories'])) {
            $categories = $_SESSION['categories'];
        }

        ?>

        <div id="main-header">Add a(n) Menu Item</div>

        <!-- display menu item details in a form -->
        <form class="new-media"  id="add_form" action='<?= BASE_URL . "/menu/add/" ?>' method="post" style="border: 1px solid #bbb; margin-top: 10px; padding: 10px;">
            <p><strong>Item Name</strong>: <input name="product" type="text" size="100" value="Title" required autofocus></p>
            <p><strong>Category</strong>:
                <input type="radio" value="1" id="App" name="category" form="add_form">
                <label for="App">App</label>
                <input type="radio" value= "2" id="Ent" name="category" form="add_form">
                <label for="Ent">Entree</label>
                <input type="radio" value="3" id="Soup" name="category" form="add_form">
                <label for="3">Soup</label>
                </input></p>
            <p><strong>Price</strong>: <input name="price" type="number" size="40" placeholder="0.00" required=""></p>
            <p><strong>Description</strong>:<br>
                <textarea name="description" rows="8" cols="100">Fill your description here</textarea></p>
            <input type="submit" name="action" value="Add Menu Item">
            <input type="button" value="Cancel" onclick='window.location.href = "<?= BASE_URL . "/menu/index/"?>"'>
        </form>
        <?php
        //display page footer
        parent::displayFooter();
    }

//end of display method
}