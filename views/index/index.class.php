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
        <nav>
            <a class="nav-left" href="<?= BASE_URL ?>">
                <img src="images/home.jpg" alt="Home Page" style="width: 50px">
            </a>
            <a class="nav-left" href="<?= BASE_URL ?>/menu/index">
                <img src="images/menu.jpg" alt="Menu Page" style="width: 50px">
            </a>
            <a class="nav-right" href="<?= BASE_URL ?>">
                <img src="images/login.jpg" alt="Login" style="width: 50px">
            </a>
            <a class="nav-right" href="<?= BASE_URL ?>">
                <img src="images/cart.jpg" alt="Shopping Cart" style="width: 50px">
            </a>
        </nav>

        <br><br><br>
        <section>
            <p id="intro">
                At Lewie's Chinese Bistro we don't know what we are doing and probably never will.  Dining with us could be the worst decision ever made in your life.  Good luck!
            </p>

            <div id="featured">
                <div id="first-featured">
                    <img src="images/General_Tso.jpg" alt="General Tso" >
                    <p>General Tso Chicken</p>
                </div>
                <div id="second-featured">
                    <img src="images/chow_mein.jpg" alt="Chow Mein">
                    <p>Chow Mein</p>
                </div>
                <div id="third-featured">
                    <img src="images/wonton_soup.jpg" alt="Wonton Soup">
                    <p>Wonton Soup</p>
                </div>
                <div id="fourth-featured">
                    <img src="images/crab_rangoon.jpg" alt="Crab Rangoon">
                    <p>Crab Rangoon</p>
                </div>
            </div>
        </section>
        <?php
        //display page footer
        parent::displayFooter();
    }
}