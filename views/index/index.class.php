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


        <br><br><br>
        <section>
            <p id="intro">
                At Lewie's Chinese Bistro we don't know what we are doing and probably never will.  Dining with us could be the worst decision ever made in your life.  Good luck!
            </p>

            <div id="featured">
                <div id="first-featured">
                    <img src="includes/images/General_Tso.jpg" alt="General Tso" >
                    <p>General Tso Chicken</p>
                </div>
                <div id="second-featured">
                    <img src="includes/images/chow_mein.jpg" alt="Chow Mein">
                    <p>Chow Mein</p>
                </div>
                <div id="third-featured">
                    <img src="includes/images/wonton_soup.jpg" alt="Wonton Soup">
                    <p>Wonton Soup</p>
                </div>
                <div id="fourth-featured">
                    <img src="includes/images/crab_rangoon.jpg" alt="Crab Rangoon">
                    <p>Crab Rangoon</p>
                </div>
            </div>
        </section>
        <?php
        //display page footer
        parent::displayFooter();
    }
}