<?php

/*** Author: your name*
 * Date: 4/5/2022*
 * File: index.class.php*
 * Description: */
class Index extends IndexView{

    public function display(){
        //display page header
        parent::displayHeader("Lewie's Chinese Bistro");

        ?>
            <p style="text-align: center">Possible introduction for this shit</p>


        <nav>
            <a href="<?= BASE_URL?>/menu/index">Click me</a>



        </nav>
        <?php
        //display page footer
        parent::displayFooter();
    }
}