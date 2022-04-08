<?php

/*** Author: your name*
 * Date: 4/7/2022*
 * File: user_index_view.class.php*
 * Description: */
class UserIndexView extends IndexView
{

    public static function displayHeader($title) {
        parent::displayHeader($title)
        ?>
        <script>
            //the media type
            var media = "users";
        </script>
        <!--create the search bar -->
        <div id="searchbar">
            <form method="get" action="<?= BASE_URL ?>/user/search">
                <input type="text" name="query-terms" id="searchtextbox" placeholder="Search users by name" autocomplete="off" onkeyup="handleKeyUp(event)">
                <input type="submit" value="Go" />
            </form>
            <div id="suggestionDiv"></div>
        </div>
        <?php
    }

    public static function displayFooter() {
        parent::displayFooter();
    }

}