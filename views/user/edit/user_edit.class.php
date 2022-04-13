<?php

/*** Author: your name*
 * Date: 4/8/2022*
 * File: user_edit.class.php*
 * Description: */
class UserEdit extends UserIndexView
{
    //put your code here

    public function display($user)
    {
        //display page header
        parent::displayHeader("Edit User Details");

        //get order cart (shopping cart info) session var

        // retrieve user details
        $id = $user->getId();
        $username = $user->getUsername();
        $password = $user->getPassword();
        $firstname = $user->getFirstname();
        $lastname = $user->getLastname();
        $email = $user->getEmail();

        ?>

        <div id="main-header">Edit User Details</div>

        <!-- display the user details in a form -->
        <form class="new-media" id="edit-form" action='<?= BASE_URL . "/user/update/" . $id ?>' method="post"
              style="border: 1px solid #bbb; margin-top: 10px; padding: 10px;">
            <input type="hidden" name="id" value="<?= $id ?>">
            <p><strong>Username</strong>: <input name="username" type="text" size="100" value="<?= $username ?>"
                                                 required autofocus></p><br>
            <p><strong>Password</strong>:<input name="password" type="password" size="100" value="<?= $password ?>"
                                                required></p><br>
            <p><strong>First Name</strong>: <input name="firstname" type="text" size="50" value="<?= $firstname ?>"
                                                   required=""></p><br>
            <p><strong>Last Name</strong>: <input name="lastname" type="text" size="50" value="<?= $lastname ?>"
                                                  required=""></p><br>
            <p><strong>Email</strong>: <input name="email" type="email" size="50" value="<?= $email ?>" required="">
            </p><br>

            <div id="button-group">
                <input class="edit-buttons" type="submit" name="action" value="Update User">
                <input class="edit-buttons" type="button" value="Cancel"
                       onclick='window.location.href = "<?= BASE_URL . "/user/detail/$id" ?>"'>
            </div>
        </form>



        <!--
       Form to edit menu item details
        <form id="edit-form" action='<?/*= BASE_URL . "/menu/update/" . $id */?>' method="post">
            <input type="hidden" name="id" value="<?/*= $id */?>">
            <fieldset id="edit-fieldset">
                <legend>Edit Menu Item</legend>
                <label for="Item Name" class="edit-left">Item Name:</label>
                    <input name="product" type="text" size="100" value="<?/*= $product */?>" id="Item Name" required autofocus class="edit-right">

                <br>

                <label for="Image" class="edit-left">Image:</label>
                    <input name="image" type="text" size="100" value="<?/*= $image */?>" id="Image" class="edit-right" placeholder="url (http:// or https://) or local file including path and file extension">

                <br>

                <label for="category" class="edit-left">Category:</label>

                    <select  name="category" form="edit_form"  id="category" class="edit-right">
                        <option value="1">App</option>
                        <option value="2">Entrees</option>
                        <option value="3">Soup</option>
                    </select>

                <br>

                <label for="Price" class="edit-left">Price:</label>
                    <input id="Price" name="price" type="text" size="40" value="<?/*= $price */?>" required="" class="edit-right">

                <br>

                <label for="Description" class="edit-left">Description:</label>
                    <textarea id="Description" name="description" rows="8" cols="100"><?/*= $description */?></textarea class="edit-right">
            </fieldset>

            <br>

            <input class="edit-buttons" type="submit" name="action" value=" Update ">
            <input class="edit-buttons" type="button" value=" Cancel " onclick='window.location.href = "<?/*= BASE_URL . "/menu/detail/$id" */?>"'>
        </form>
        -->













        <?php
        //display page footer
        parent::displayFooter();
    }
//end of display method
}