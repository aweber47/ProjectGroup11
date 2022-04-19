<?php

/*** Author: your name*
 * Date: 4/8/2022*
 * File: user_error.class.php*
 * Description: */
class UserError extends UserIndexView
{
    public function display($message)
    {
        // header
        //parent::displayHeader("Error");
        ?>
        <div id="main-header">ERROR</div>
        <hr>
        <table style="width: 100%; border: none">
            <tr>
                <td style="text-align: left; vertical-align: top;">
                    <h3> An error has occurred: </h3>
                    <div style="color: red">
                        <?= urldecode($message) ?>
                    </div>
                    <br>
                </td>
            </tr>
        </table>
        <br><br><br><br><hr>
        <a href="<?= BASE_URL ?>/user/register">Back to Register Account</a>
        <?php
        //display page footer
        //parent::displayFooter();
    }

}