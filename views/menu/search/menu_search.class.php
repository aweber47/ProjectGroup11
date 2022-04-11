<?php

/*** Author: your name*
 * Date: 4/5/2022*
 * File: menu_search.class.php*
 * Description: */
class MenuSearch extends MenuIndexView
{
    public function display($terms, $menuItems)
    {
        //display page header
        parent::displayHeader("Search Results");
        ?>
        <div id="main-header"> Search Results for <i><?= $terms ?></i></div>
        <span class="rcd-numbers">
            <?php
            echo((!is_array($menuItems)) ? "( 0 - 0 )" : "( 1 - " . count($menuItems) . " )");
            ?>
        </span>
        <hr>
        <?php
        if ($menuItems === 0) {
            echo "No menu items were found.<br><br><br><br><br>";
        } else {
            // display the menu items; 6 menu per row
            foreach ($menuItems as $i => $menuItem) {
                $id = $menuItem->getId();
                $product = $menuItem->getProduct();
                $image = $menuItem->getImage();

                if (strpos($image, "http://") === false and strpos($image, "https://") === false) {
                    $image = BASE_URL . $image;
                }

                $category = $menuItem->getCategory();
                $price = $menuItem->getPrice();
                $description = $menuItem->getDescription();

                if ($i % 6 == 0) {
                    echo "<div class='row'>";
                }

                echo "<div class='menu-detail'>
                            <p class='box-style-menu' ><a href='", BASE_URL, "/menu/detail/$id'><p class='product'>$product</p><br><img class='menu-pic' alt='Food Item' src='" . $image . "'></a><br><p class='category'>Category: $category</p><br> Price: $price<br> Description: $description . " . "</p>
                        </div>"; ?>

                <?php
                if ($i % 6 == 5 || $i == count($menuItems) - 1) {
                    echo "</div>";
                }
            }
        }
        ?>
        <?php
        //display page footer
        parent::displayFooter();

    } //end of display method
}