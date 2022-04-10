<?php

/*** Author: your name*
 * Date: 4/5/2022*
 * File: menu_index_view.class.php*
 * Description: */
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
            <form method="get" action="<?= BASE_URL ?>/menu/search/">
                <label for="searchtextbox"></label>
                <input type="search" name="query-terms" id="searchtextbox" placeholder="Search Menu" autocomplete="off" onkeyup="handleKeyUp(event)">
                <input id="search-button" type="submit" value="Search">
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