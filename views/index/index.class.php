<?php

/*** Author: James Ritter and Alex Weber*
 * Date: 4/5/2022*
 * File: index.class.php*
 * Description: Base index, displays the homepage.*/
class Index extends IndexView
{

    public function display()
    {
        //display page header
        parent::displayHeader("Lewie's Chinese Bistro");
        //session
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        if (isset($_SESSION['role'])) {
            $role = $_SESSION['role'];
        }
        //$role;
        ?>


        <br><br><br>
        <section>
            <p id="intro">
                At Lewie's Chinese Bistro we don't know what we are doing and probably never will. Dining with us could
                be the worst decision ever made in your life. Good luck!
            </p>

            <div id="featured">
                <div id="first-featured">
                    <img src="www/images/General_Tso.jpg" alt="General Tso"
                         onclick="window.location.href='<?= BASE_URL ?>/menu/detail/45'">
                    <p>General Tso Chicken</p>
                </div>
                <div id="second-featured">
                    <img src="www/images/chow_mein.jpg" alt="Chow Mein"
                         onclick="window.location.href='<?= BASE_URL ?>/menu/detail/6'">
                    <p>Chow Mein</p>
                </div>
                <div id="third-featured">
                    <img src="www/images/wonton_soup.jpg" alt="Wonton Soup"
                         onclick="window.location.href='<?= BASE_URL ?>/menu/detail/3'">
                    <p>Wonton Soup</p>
                </div>
                <div id="fourth-featured">
                    <img src="www/images/crab_rangoon.jpg" alt="Crab Rangoon"
                         onclick="window.location.href='<?= BASE_URL ?>/menu/detail/12'">
                    <p>Crab Rangoon</p>
                </div>
            </div>
        </section>
        <?php
        //display page footer
        parent::displayFooter();
    }
}