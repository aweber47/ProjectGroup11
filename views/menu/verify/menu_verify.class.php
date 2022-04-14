<?php

/*** Author: your name*
 * Date: 4/5/2022*
 * File: menu_verify.class.php*
 * Description: */
class MenuVerify extends MenuIndexView{
    public function display($message){
        //display header
        parent::displayHeader("Error");
        ?>

        <!--<div id="main-header">Verification</div>-->
        
        <br>
        
        <table>
            <tr>
                <td style="text-align: left; vertical-align: top;">
                    <div>
                        <?= urldecode($message) ?>
                    </div>
                    <br>
                </td>
            </tr>
        </table>
        
        <br><br><br><br>
        
        <a href="<?= BASE_URL ?>/menu/index">Back to menu list</a>
        <?php
        //display footer
        parent::displayFooter();
    }
}