<?php
/*** Author: Alex Weber and James Ritter*
 * Date: 4/11/2022*
 * File: menu_index_view.class.php*
 * Description: displays the menu, includes honor features such as paginator, advanced search and more to come!*/

class MenuIndexView extends IndexView
{
    public static function displayHeader($title)
    {
        parent::displayHeader($title)
        ?>
        <?php
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        if (isset($_SESSION['role'])) {
            $role = $_SESSION['role'];
        }
        if (isset($_SESSION['login_status'])) {
            $login_status = $_SESSION['login_status'];
        }
        echo $login_status;
        ?>

        <!-- Script and media type, forms, suggestions and search box would go here. -->
        <script xmlns="http://www.w3.org/1999/html">
            var media = 'menu';
            var base_url = '<?= BASE_URL ?>';
            console.log(base_url);
        </script>
        <!--create the search bar -->
        <div id="searchbar">
            <form id="searchbar-form" method="get" action="<?= BASE_URL ?>/menu/search/">
                <label id="searchtextbox" for="searchtextbox"></label>
                <input type="search" name="query-terms" id="searchtextbox" placeholder="Search Menu">
                <input id="search-button" type="submit" value=" Search ">
        </div>
        <?php
        /*************************************************************************************
         *         Below are honor project Implementations for search features               *
         ************************************************************************************/
        ?>

        <?php if ($login_status == 0) { ?>
        <div id="advanced-features">
            <h4><span style="color: red"><strong>ALERT: <br> You must be logged in or signed in as a guest account; <br>In order to send items to the cart!</strong></span>
            </h4>
        </div>
    <?php } ?>
        <div id="advanced-features">
            <a onclick="toggleText()">[ Advanced Search Features ]<br></a>
        </div>

        <!-- This div determines if the other elements are shown.-->
        <!-- revert to searchbar styles -->
        <div id="Myid" hidden>
            <div id="pagination">
                <!-- AND SEARCH --->
                <input type="radio" name="w" value="true">
                <label>Find all of my search terms (AND)</label>

                <!-- OR SEARCH, default search for users -->
                <input checked type="radio" name="w" value="false">
                <label>Find all of my search terms (OR)</label>
                <?php
                /*************************************************************************************
                 *         Limiting Search by Attribute [product, price or description]               *
                 ************************************************************************************/
                ?>
                <br><br>
                <!--Limiting the search more! -->
                <input checked type="checkbox" name="bool1" value="1"<?= (isset($_GET['bool1']) ? ' checked ' : '') ?>>
                <label>Product Name </label>

                <input type="checkbox" name="bool2" value="2"<?= (isset($_GET['bool2']) ? ' checked ' : '') ?>>
                <label> Price </label>

                <input type="checkbox" name="bool3" value="3"<?= (isset($_GET['bool3']) ? ' checked ' : '') ?>>
                <label>Description</label>

                </form>


                <?php
                /*************************************************************************************
                 *         Limiting results by category [All, Appetizers, Entrees or Soups]              *
                 ************************************************************************************/
                ?>
                <form action="<?= BASE_URL ?>/menu/index/" method="post">
                    <!--- Limiting search by cat-->
                    <input type="radio" name="cat" value="0" onchange="this.form.submit()">
                    <label>All Items</label>

                    <input type="radio" name="cat" value="1" onchange="this.form.submit()">
                    <label>Appetizers</label>

                    <input type="radio" name="cat" value="2" onchange="this.form.submit()">
                    <label>Entrees</label>

                    <input type="radio" name="cat" value="3" onchange="this.form.submit()">
                    <label>Soups</label>
                </form>
            </div>
        </div>
        <?php
        /*************************************************************************************
         *         The Paginator  - -  -  -  -  -  -  -  -  - Yay :) -   -  -  -             *
         ************************************************************************************/
        ?>
        <div id="pagination">
            <form id="per-page-form" action="<?= BASE_URL ?>/menu/index/" method="post">
                <h3 id="searchbar">Items Per Page</h3>
                <input type="radio" name="items" value="3" onchange="this.form.submit()">
                <label>3 Products</label>

                <input type="radio" name="items" value="5" onchange="this.form.submit()">
                <label>5 Products</label>

                <input type="radio" name="items" value="25" onchange="this.form.submit()">
                <label>All Products</label>
            </form>
        </div>

        <!-- Javascript goes here -->
        <script type="text/javascript">
            function toggleText() {
                var x = document.getElementById("Myid");
                if (x.style.display === "none") {
                    x.style.display = "block";
                } else {
                    x.style.display = "none";
                }
            }
        </script>
        <?php
    }

    public static function displayFooter()
    {
        parent::displayFooter();
    }
}