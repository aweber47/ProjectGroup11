<?php

/*** Author: your name*
 * Date: 4/5/2022*
 * File: welcome_index.class.php*
 * Description: */
class WelcomeIndex extends IndexView{

    public function display(){
        //display page header
        parent::displayHeader("Lewie's Chinese Bistro");

        ?>
            <p style="text-align: center">Possible introduction for this shit</p>
        <?php
        //display page footer
        parent::displayFooter();
    }
}