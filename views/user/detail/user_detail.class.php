<?php
/*** Author: your name*
 * Date: 4/7/2022*
 * File: user_detail.class.php*
 * Description: */

class UserDetail extends UserIndexView{
    public function display($user_id, $user, $confirm = ""){
        //display page header
        parent::displayHeader("Display User Details");

        //retrieve user details by calling get methods
        $id = $user->getId();
        $username = $user->getUsername();
        $firstname = $user->getFirstname();
        $lastname = $user->getLastname();
        $email = $user->getEmail();
        ?>

        <!--<div id="main-header">User Details</div>-->
        <br><br><br><br>
        <!-- display user details in a table -->
        <table id="menu-detail">
            <tr class="detail-labels">
                <th>Username:</th>
                <th>First Name:</th>
                <th>Last Name:</th>
                <th>Email:</th>
            </tr>
            <tr class="detail-info">
                <td><?= $username ?></td>
                <td><?= $firstname ?></td>
                <td><?= $lastname ?></td>
                <td><?= $email ?></td>
            </tr>
        </table>
        <div id="confirm-message"><?= $confirm ?></div>
        <div id="button-group">
            <input class="edit-buttons" type="button" id="edit-button" value="   Edit   " onclick="window.location.href = '<?= BASE_URL ?>/user/edit/<?= $id ?>'">&nbsp;|
            
            <input class="edit-buttons" type="button" id="delete-button" value="   Delete Account   " onclick="window.location.href = '<?= BASE_URL ?>/user/deleteDisplay/<?= $id ?>'">&nbsp;|
            
            <input class="edit-buttons" type="button" id="cancel-button" value="  Return to Account  " onclick="window.location.href = '<?= BASE_URL ?>/user/login/'">
        </div>
        
        <div id="confirm-message"><?= $confirm ?></div>
        <?php
        //display page footer
        parent::displayFooter();
    }
//end of display method
}