<?php

/*** Author: Alex Weber*
 * Date: 4/11/2022*
 * File: menu_index_view.class.php*
 * Description: displays the menu, includes honor features such as paginator, advanced search and more to come!*/
class MenuIndexView extends IndexView
{
    public static function displayHeader($title)
    {
        parent::displayHeader($title)
        ?>
        <!-- Script and media type, forms, suggestions and search box would go here. -->
        <script>
            var media = 'menuItem';
        </script>
        <!--create the search bar -->
        <div id="searchbar">
            <!--paginator-->
            <form action="" method="post">
                <p>How many products would you like displayed?</p>
                <label style="color:goldenrod; background-color: black;">
                    <input type="radio" name="items" value="3" onchange="this.form.submit()"> 3 Products
                </label>
                <label style="color:goldenrod; background-color: black;">
                    <input type="radio" name="items" value="5" onchange="this.form.submit()"> 5 Products
                </label>
                <label style="color:goldenrod; background-color: black;">
                    <input type="radio" name="items" value="25" onchange="this.form.submit()"> All Products
                </label>
            </form>

            <br>

            <form method="get" action="<?= BASE_URL ?>/menu/search/">
                <label id="searchtextbox"></label>

                <input type="search" name="query-terms" id="searchtextbox" placeholder="Search Menu" autocomplete="off"
                       onkeyup="handleKeyUp(event)">
                <input id="search-button" type="submit" value="Search"><br>

                <?php
                /*************************************************************************************
                 *         Below are honor project Implementations for search features                        *
                 ************************************************************************************/
                ?>
                <!-- AND SEARCH -->
                <input style="color:goldenrod; background-color: black;" type="radio" name="w" value="true">
                <label style="color:goldenrod; background-color: black;">Find all of my search terms (AND) </label>

                <!-- OR SEARCH -->
                <input style="color:goldenrod" type="radio" name="w" value="false">
                <label style="color:goldenrod; background-color: black;">Find all of my search terms (OR) </label><br>

                <!---Limiting the search more!-->

                <input type="checkbox" name="bool1" value="1"<?= (isset($_GET['bool1']) ? ' checked ' : '') ?>>
                <label style="color:goldenrod; background-color: black;">Product Name</label>

                <input type="checkbox" name="bool2" value="2"<?= (isset($_GET['bool2']) ? ' checked ' : '') ?>>
                <label style="color:goldenrod; background-color: black;">Price</label>

                <input type="checkbox" name="bool3" value="3"<?= (isset($_GET['bool3']) ? ' checked ' : '') ?>>
                <label style="color:goldenrod; background-color: black;">Description</label>


            </form>
            <div id="suggestionDiv"></div>
        </div>
        <?php
    }

    public static function displayFooter()
    {
        parent::displayFooter();
    }

}