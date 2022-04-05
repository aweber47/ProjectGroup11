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
                $category = $menuItem->getCategory();
                $price = $menuItem->getPrice();
                $description = $menuItem->getDescription();
                if ($i % 6 == 0) {
                    echo "<div class='row'>";
                }
                echo "<div class='col'><p><a href='", BASE_URL, "/menu/detail/$id'></a><span>$product<br>Category: $category<br> Price: $price<br> Description: $description . " . "</span></p></div>";
                ?>
                <?php
                if ($i % 6 == 5 || $i == count($menuItems) - 1) {
                    echo "</div>";
                }
            }
        }
        ?>
        </div>
        <a href="<?= BASE_URL ?>/menu/index">Add an Item</a>

        <?php
        //display page footer
        parent::displayFooter();

    } //end of display method
}