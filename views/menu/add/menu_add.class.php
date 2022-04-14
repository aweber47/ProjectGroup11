<?php
/*** Author: your name*
 * Date: 4/5/2022*
 * File: menu_add.class.php*
 * Description: */

class MenuAdd extends MenuIndexView{

    public function display() {
        //display page header
        parent::displayHeader("Add Menu Item");

        //get menu categories from a session variable
        if (isset($_SESSION['categories'])) {
            $categories = $_SESSION['categories'];
        }

        ?>

        <!--<div id="main-header">Add a(n) Menu Item</div>-->

        <!-- display menu item details in a form -->
        <br><br>
        <form class="new-media"  id="add_form" action='<?= BASE_URL . "/menu/add/" ?>' method="post">
            <table id="menu-detail">
                <tr class="detail-labels">
                    <th>Item Name</th>
                    <th>Image</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th>Description</th>
                </tr>
                <tr class="detail-info">
                    <td><input name="product" type="text" size="50" placeholder="product name" onfocus="this.placeholder = ' '" required></td>
                    <td><input placeholder="url: (http:// or https:// ) or local file including path and file extension" onfocus="this.placeholder = ' '" name="image" type="text" size="50" required></td>
                    <td>
                        <input type="radio" value="1" id="App" name="category" form="add_form">
                        <label for="App">Appetizer</label>
                        <input type="radio" value= "2" id="Ent" name="category" form="add_form">
                        <label for="Ent">Entree</label>
                        <input type="radio" value="3" id="Soup" name="category" form="add_form">
                        <label for="3">Soup</label>
                    </td>
                    <td><input name="price" type="number" step="0.01" size="50" placeholder="7.50" onfocus="this.placeholder = ' '" required></td>
                    <td><textarea name="description" rows="8" cols="50" placeholder="Fill your description of the product here" onfocus="this.placeholder = ' '" required></textarea></td>
                </tr>
            </table>
            <!--<p><strong>Item Name</strong>: <input name="product" type="text" size="100" placeholder="product name" onfocus="this.placeholder = ' '" required></p>
            <p><strong>Image</strong>
            <input placeholder="url: (http:// or https:// ) or local file including path and file extension" onfocus="this.placeholder = ' '" name="image" type="text" size="100" required></p>
            <p><strong>Category</strong>:
                <input type="radio" value="1" id="App" name="category" form="add_form">
                <label for="App">App</label>
                <input type="radio" value= "2" id="Ent" name="category" form="add_form">
                <label for="Ent">Entree</label>
                <input type="radio" value="3" id="Soup" name="category" form="add_form">
                <label for="3">Soup</label>
                </input></p>
            <p><strong>Price</strong>: <input name="price" type="number" step="0.01" size="40" placeholder="7.50" onfocus="this.placeholder = ' '" required></p>
            <p><strong>Description</strong>:<br>
                <textarea name="description" rows="8" cols="100" placeholder="Fill your description of the product here" onfocus="this.placeholder = ' '" required></textarea></p>-->
            <div id="button-group">
                <input type="submit" name="action" value="Add Menu Item">
                <input type="button" value="Cancel" onclick='window.location.href = "<?= BASE_URL . "/menu/index/"?>"'>
            </div>
        </form>
        <?php
        //display page footer
        parent::displayFooter();
    }//end of display method
}