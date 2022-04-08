<?php

/*** Author: your name*
 * Date: 4/7/2022*
 * File: user_detail.class.php*
 * Description: */
class UserDetail extends UserIndexView
{
    public function display($user_id, $user, $reviews, $confirm = "") {
        //display page header
        parent::displayHeader("Display User Details");

        //retrieve user details by calling get methods
        $id = $user->getId();
        $username = $user->getUsername();
        $email = $user->getEmail();
        ?>

        <div id="main-header">User Details</div>
        <hr>
        <!-- display user details in a table -->
        <table id="detail">
            <tr>
                <td style="width: 150px;">
                    <img src="<?= $image ?>" alt="<?= $title ?>" />
                </td>
                <td style="width: 130px;">
                    <p><strong>Username:</strong></p>
                    <p><strong>Email:</strong></p>
                    <div id="review-list">

                    </div>
                </td>
                <td>
                    <p><?= $username ?></p>
                    <p><?= $email ?></p>
                    <div id="confirm-message"><?= $confirm ?></div>
                </td>
            </tr>
        </table>
        <?php
        //echo $reviewlist;
        ?>
        <a href="<?= BASE_URL ?>/user/index">Go to game list</a>

        <?php
        $reviewList = new UserReviewIndex();
        $reviewList->display($user_id, $reviews);
        //display page footer
        parent::displayFooter();
    }
//end of display method
}