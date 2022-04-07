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
                <input type="text" name="query-terms" id="searchtextbox"  placeholder="Search menu items by name"
                       autocomplete="off" onkeyup="handleKeyUp(event)">
                <input id="search-button" type="submit" value="Go"/>
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