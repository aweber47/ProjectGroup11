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
        <div style="border: 1px solid black; margin: auto; padding: 10px; text-align: center; background-color: rgba(255, 215, 0, 0.85)">
        <table>
            <tr>
                <td style="text-align: left; vertical-align: top;">
                    <div style="background: linear-gradient(to right, #ef5350, #f48fb1, #7e57c2, #2196f3, #26c6da, #43a047, #eeff41, #f9a825, #ff5722)">
                        <?= urldecode($message) ?>
                    </div>
                    <br>
                </td>
            </tr>
        </table>
        
        <br><br><br><br>
        <div id="button-group">
            <input class="edit-buttons" type="button" value="Back to Menu" onclick='window.location.href = "<?= BASE_URL . "/menu/index/" ?>"'>
        </div>
        </div>
        <?php
        //display footer
        parent::displayFooter();
    }
}